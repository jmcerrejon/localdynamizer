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
    private const MAX_RESOLUTION_WIDTH = 1024;
    private const HAS_SIGNATURE_STAMP = true;

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
            $validated['path'] = $this->saveFile($request->file('resource_file')); // TODO Handle resize if image, etc...
        }
        
        unset($validated['hashtags'], $validated['resource_file']);

        try {
            $this->resource->create($validated);
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        $this->saveHashtags($hashtags);

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
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('destroy');
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

        return $file->storeAs("public/resources/$mime", $fileName);
    }

    /**
     * Get an array and transform each elements into hashtags
     *
     * @param  String  $hashtags
     * @return  void
     */
    private function saveHashtags($hashtags)
    {
        $tagsNames = explode(',', str_replace(' ','', $hashtags));

        foreach($tagsNames as $tagName){
            $normalizedHashtag = strtolower(($tagName[0] != '#') ? '#'.$tagName : $tagName);
            Hashtag::firstOrCreate(['name' => $normalizedHashtag])->save();
        }
    }
}
