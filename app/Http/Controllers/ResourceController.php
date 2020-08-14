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

    public function index()
    {
        $totalResources = $this->resource->limit(10)->get();
        return view('resources.index', compact('totalResources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mimes = Mime::get();
        return view('resources.edit', compact('mimes'));
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
        if ($request->has('resource_file')) {
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
        $resource['hashtags'] = $resource->hashtags->pluck('name')->implode(', ');
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
        if ($request->has('resource_file')) {
            $oldResourceFilePath = $resource['path'];
            $validated['path'] = $this->saveFile($request->file('resource_file'));
        }
        unset($validated['resource_file']);

        try {
            $resource
                ->fill($validated)
                ->save();
            $hashtagIds = $this->saveHashtags($hashtags);
            $resource->hashtags()->sync($hashtagIds);

            if ($validated['path'] !== null) {
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

        return redirect()->back()->with('message', 'Recurso eliminado.');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $userId = Auth::user()->id;

        return datatables()->eloquent($this->resource->query())
            ->addColumn('hashtags', function (Resource $resource) {
                $hashtags = $resource->hashtags->pluck('name')->implode(', ');
                return "<span class='label'>$hashtags</span>";
            })
            ->addColumn('actions', function (Resource $resource) use ($userId) {
                if ($userId === $resource->user->id) {
                    return '<div class="btn-group">
                    <form action="'. route('recursos.show', $resource->id).'" method="get">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-default btn-sm" title="Editar">
                                <i class="fa fa-pen"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" onclick="modifyDeleteAction('.$resource->id.')" title="Eliminar">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </form>
                </div>';
                } else {
                    return '<div class="btn-group"></div>';
                }
            })
            ->rawColumns(['actions', 'hashtags'])
            ->toJson();
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
     * @return  Array
     */
    private function saveHashtags($hashtags)
    {
        $tagsNames = explode(',', str_replace(' ','', $hashtags));
        $tagsIds = [];

        foreach($tagsNames as $tagName) {
            $normalizedHashtag = strtolower(($tagName[0] != '#') ? '#'.$tagName : $tagName);
            $result = Hashtag::firstOrCreate(['name' => $normalizedHashtag]);
            $tagsIds[] = $result->id;
        }

        return $tagsIds;
    }
}
