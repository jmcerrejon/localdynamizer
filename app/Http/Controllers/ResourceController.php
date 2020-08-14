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
            $validated['path'] = $this->saveFile($request->file('resource_file')); // TODO Handle resize if image, etc...
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
                    <form action="'. route('establecimientos.show', $resource->id).'" method="get">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-default btn-sm" title="Editar">
                                <i class="fa fa-pen"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" onclick="modifyDeleteAction('.$resource->id.',\''. $resource->comercial_name .'\')" title="Eliminar">
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

        return $file->storeAs("public/resources/$mime", $fileName);
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
