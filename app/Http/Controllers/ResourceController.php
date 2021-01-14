<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Mime;
use App\Models\Hashtag;
use App\Models\Resource;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ResourceRequest;

class ResourceController extends Controller
{
    private $resource;

    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = $this->resource
            ->orderBy('created_at','desc')
            ->paginate(6);

        return view('resources.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mimes = Mime::get();
        return view('resources.new', compact('mimes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ResourceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResourceRequest $request)
    {
        $validated = $request->validated();
        $hashtags = $validated['hashtags'];
        $validated['user_id'] = Auth::user()->id;

        if ($request->has('resource_file') && !startWith($request->file('resource_file'), 'http')) {
            $validated['path'] = $this->saveFile($request->file('resource_file'));
        }
        unset($validated['hashtags'], $validated['resource_file']);

        try {
            $resourceCreated = $this->resource->create($validated);
            $hashtagIds = $this->saveHashtags($hashtags);
            // For the many to many relationship, we attach hashTagIds to $resourceCreated to fill the table hashtag_resource.
            $resourceCreated->hashtags()->attach($hashtagIds);
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('recursos.index')->with('message', 'Recurso guardado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resource = Resource::findOrFail($id);

        $resource->increment('views');

        $resource['hashtags'] = $resource->hashtags->pluck('name')->implode(', #');
        $resource['path'] = (startWith($resource->path, 'http')) ? $resource->path : asset("storage/$resource->path");

        $mimes = Mime::get();

        return view('resources.edit', compact('resource', 'mimes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ResourceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ResourceRequest $request, $id)
    {
        $validated = $request->validated();
        $hashtags = $validated['hashtags'];
        $validated['user_id'] = Auth::user()->id;
        $resource = $this->resource->findOrFail($id);
        $oldResourceFilePath = '';
        if ($request->has('resource_file') && !startWith($request->file('resource_file'), 'http')) {
            $oldResourceFilePath = $resource['path'];
            $validated['path'] = $this->saveFile($request->file('resource_file'));
        }
        unset($validated['resource_file']);

        try {
            $resource->fill($validated)->save();
            $hashtagIds = $this->saveHashtags($hashtags);
            $resource->hashtags()->sync($hashtagIds);
            if (isset($validated['path']) && $validated['path'] !== null) {
                $this->delFile($oldResourceFilePath);
            }
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('recursos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resource = $this->resource->findOrFail($id);

        $this->delFile($resource->path);

        $resource->delete();

        return redirect()->route('recursos.index');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  Integer  $id
     * @return  Blob
     */
    public function download($id)
    {
        $resource = $this->resource->findOrFail($id);

        // TODO Check if resource exists

        $resource->increment('downloads');

        if (startWith( $resource->path, 'http')) {
            return redirect()->to($resource->path);
        }

        return response()->download('storage/'.$resource->path);
    }

    /**
     * Filter Resource by Hashtags and return the result paginated
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterByHashtags(Request $request)
    {
        $hashtags = Hashtag::where('name', $request->get('q'))->pluck('id');

        $resources = Resource::whereHas('hashtags', function($query) use ($hashtags ) {
            $query->whereIn('hashtag_id', $hashtags );
        })
        ->orderBy('created_at','desc')
        ->paginate(6);

        return view('resources.index', compact('resources'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Object  $file
     * @return  String
     */
    private function saveFile($file)
    {
        $extension = $file->getClientOriginalExtension();
        $mime = $file->getMimeType();
        $signature = time();
        $tmpFileName = Str::slug(str_replace(".$extension", '', $file->getClientOriginalName()));
        $tmpFileName .= "_{$signature}";

        $fileName = strtolower("{$tmpFileName}.{$extension}");
        // We don't need save the public/ string 
        $savedPath = str_replace('public/', '', $file->storeAs("public/resources/$mime", $fileName));

        return $savedPath;
    }

    /**
     * Get an array and transform each elements into hashtags
     *
     * @param  String  $hashtags
     */
    private function saveHashtags($hashtags) : array
    {
        // We remove spaces and symbol #
        $tagsNames = explode(',', str_replace([' ', '#'], '', $hashtags));
        $tagsIds = [];

        foreach ($tagsNames as $tagName) {
            if ($tagName === '') {
                continue;
            }
            $normalizedHashtag = strtolower($tagName);
            $result = Hashtag::firstOrCreate(['name' => $normalizedHashtag]);
            $tagsIds[] = $result->id;
        }

        return $tagsIds;
    }

}
