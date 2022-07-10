<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Models\Category;
use App\Models\Channel;
use App\Models\Video;
use App\Models\VideoInformation;
use Illuminate\Http\Request;
use getID3;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function apiShow($id)
    {
        $video = VideoInformation::with('category')->with('channel')->with('videoMedia')->where('id', $id)->get();
        return response()->json([
            'message' => 'Success get detail data video',
            'data' => $video
        ], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['video'] = VideoInformation::latest()->get();
        $data['category'] = Category::all();
        $data['channel'] = Channel::all();
        return view('layout.module.video.index', $data);
    }

    public function ajax(Request $request)
    {
        dd($request->all());
        $input = $request->all();
        $type = $input['type'];
        switch ($type) {
            case 'create':
                try {
                    $input['name'] = $input['title'];
                    $input['module'] = Category::find($input['category_video']);
                    $moduleName =  $input['module']->name;
                    $input['channelName'] = Channel::find($input['channel_id']);
                    $input['channelName'] = $input['channelName']->name;
                    $input['video_code'] = 'VID' . $moduleName . Str::random(4);
                    // Logic send imange thubnail
                    // dd($input['thumbnail']);
                    $image = $request->file('thumbnail');
                    $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
                    $pathImage =  'thumbnail/' . $input['name'] . '/' . $moduleName . '/' . $imageName;
                    $image->storeAs('thumbnail/' . $input['name'] . '/' . $moduleName . '/', $imageName, ['disk' => 'public']);
                    $input['thumbnail'] = $pathImage;
                    // Logic send video
                    //input new video
                    $video = $request->file('video_id');
                    //call function getID3
                    $getID3 = new getID3();
                    //name video
                    $videoName = date('YmdHis') . "." . $video->getClientOriginalExtension();
                    //path video
                    $path = 'video/' . $input['name'] . '/' .  $moduleName . '/' . $input['channelName'];

                    $video->storeAs($path . "/", $videoName, ['disk' => 'public']);
                    //duration video
                    $file = $getID3->analyze($video);
                    $duration = "00:" . $file['playtime_string'];
                    //extension video
                    $fileExt = $video->extension();
                    //size video
                    $fileSize = $video->getSize();

                    //add function/logic to input and create
                    $input['name'] = $videoName;
                    $input['path'] = $path . "/" . $videoName;
                    $input['size'] = $fileSize;
                    $input['ext'] = $fileExt;
                    $input['duration'] = $duration;
                    $vid = Video::create([
                        'name' => $input['name'],
                        'path' => $input['path'],
                        'size' => $input['size'],
                        'extension' => $input['ext'],
                        'duration' => $input['duration'],
                    ]);
                    $input['video_id'] = $vid->id;
                    VideoInformation::create($input);

                    return response()->json([
                        'message' => 'Success Create data'
                    ], 200);
                } catch (QueryException $e) {
                    return \response()->json([
                        'error' => 'Failed ' . $e->errorInfo[2]
                    ], 500);
                }
                break;
            case 'update':
                $id = $input['id'];
                try {
                    $videoDB = VideoInformation::find($id);
                    $input['name'] = $input['title'];
                    if ($request->hasFile("thumbnail")) {
                        Storage::disk('public')->delete($videoDB->thumbnail);
                        $image = $request->file('thumbnail');
                        $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
                        $pathImage =  $input['name'] . '/' . $input['module'] . '/' . $imageName;
                        // dd($pathImage);
                        $image->storeAs($input['name'] . '/' . $input['module'] . '/', $imageName, ['disk' => 'public']);
                    } else {
                        $pathImage = $videoDB->thumbnail;
                    }

                    if ($request->hasFile('video')) {
                        Storage::disk('public')->delete($videoDB->videoMedia->path);
                        // Logic send video
                        //input new video
                        $video = $request->file('video_id');
                        //call function getID3
                        $getID3 = new getID3();
                        //name video
                        $videoName = date('YmdHis') . "." . $video->getClientOriginalExtension();
                        //path video
                        $path = 'video/' . $input['module'] . '/' . $input['channelName'];

                        if (!File::isDirectory(public_path('storage/' . $path))) {
                            File::makeDirectory(public_path('storage/' . $path));
                        }
                        $video->storeAs($path . "/", $videoName, ['disk' => 'public']);
                        //duration video
                        $file = $getID3->analyze($video);
                        $duration = "00:" . $file['playtime_string'];
                        //extension video
                        $fileExt = $video->extension();
                        //size video
                        $fileSize = $video->getSize();

                        //add function/logic to input and create
                        $input['name'] = $videoName;
                        $input['path'] = $path . "/" . $videoName;
                        $input['size'] = $fileSize;
                        $input['ext'] = $fileExt;
                        $input['duration'] = $duration;

                        $vid = Video::where('id', $videoDB->video_id)->update([
                            'name' => $input['name'],
                            'path' => $input['path'],
                            'size' => $input['size'],
                            'extension' => $input['ext'],
                            'duration' => $input['duration'],
                        ]);
                        $input['video_id'] = $vid->id;
                    } else {
                        $input['video_id'] = $videoDB->video_id;
                    }
                    $result = VideoInformation::find($id)->update([
                        'title' => $input['title'],
                        'title-alt' => $input['title_alt'],
                        'genre' => $input['genre'],
                        'author' => $input['author'],
                        'studio' => $input['studio'],
                        'category_video' => $input['category_video'],
                        'description' => $input['description'],
                        'tag' => $input['tag'],
                        'tahunFilm' => $input['tahunFilm'],
                        'rating' => $input['rating'],
                        'thumbnail' => $pathImage,
                        'video_id' => $input['video_id'],
                        'channel_id' => $input['channel_id']
                    ]);
                    $videoDBResult = VideoInformation::find($id);
                    return response()->json([
                        'message' => 'Success update data'
                    ], 200);
                } catch (QueryException $e) {
                    return response()->json([
                        'error' => 'Failed ' . $e->errorInfo[2]
                    ], 500);
                }
                break;
            case 'delete':
                // dd($input);
                $videoDB = VideoInformation::find($input['id']);
                if (isset($videoDB->thumbnail)) {
                    Storage::disk('public')->delete($videoDB->thumbnail);
                }
                if (isset($videoDB->video_id)) {
                    if ($videoDB->videoMedia != null) {
                        Storage::disk('public')->delete($videoDB->videoMedia->path);
                        Video::where('id', $videoDB->video_id);
                    }
                }
                $videoDB->delete();

                return \response()->json([
                    'message' => 'Success Delete Data'
                ], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['category'] = Category::all();
        $data['channel'] = Channel::all();
        return view('layout.module.video.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {
        $input = $request->validated();
        $input['name'] = $input['title'];
        $input['module'] = Category::find($input['category_video']);
        $moduleName =  $input['module']->name;
        $input['channelName'] = Channel::find($input['channel_id']);
        $input['channelName'] = $input['channelName']->name;
        $input['video_code'] = 'VID' . $moduleName . Str::random(4);
        // Logic send imange thubnail
        // dd($input['thumbnail']);
        $image = $request->file('thumbnail');
        $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $pathImage =  'thumbnail/' . $input['name'] . '/' . $moduleName . '/' . $imageName;
        $image->storeAs('thumbnail/' . $input['name'] . '/' . $moduleName . '/', $imageName, ['disk' => 'public']);
        $input['thumbnail'] = $pathImage;
        // Logic send video
        //input new video
        $video = $request->file('video_id');
        //call function getID3
        $getID3 = new getID3();
        //name video
        $videoName = date('YmdHis') . "." . $video->getClientOriginalExtension();
        //path video
        $path = 'video/' . $input['name'] . '/' .  $moduleName . '/' . $input['channelName'];

        $video->storeAs($path . "/", $videoName, ['disk' => 'public']);
        //duration video
        $file = $getID3->analyze($video);
        $duration = "00:" . $file['playtime_string'];
        //extension video
        $fileExt = $video->extension();
        //size video
        $fileSize = $video->getSize();

        //add function/logic to input and create
        $input['name'] = $videoName;
        $input['path'] = $path . "/" . $videoName;
        $input['size'] = $fileSize;
        $input['ext'] = $fileExt;
        $input['duration'] = $duration;
        $vid = Video::create([
            'name' => $input['name'],
            'path' => $input['path'],
            'size' => $input['size'],
            'extension' => $input['ext'],
            'duration' => $input['duration'],
        ]);
        $input['video_id'] = $vid->id;
        VideoInformation::create($input);

        return redirect()->route('video.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['video'] = VideoInformation::find($id);
        return view('layout.module.video.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['video'] = VideoInformation::find($id);
        $data['category'] = Category::all();
        $data['channel'] = Channel::all();
        return view('layout.module.video.edit', $data);
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
        $input = $request->all();

        $videoDB = VideoInformation::find($id);

        $input['name'] = $input['title'];
        if ($request->hasFile("thumbnail")) {
            Storage::disk('public')->delete($videoDB->thumbnail);
            $image = $request->file('thumbnail');
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $pathImage =  $input['name'] . '/' . $input['module'] . '/' . $imageName;
            // dd($pathImage);
            $image->storeAs($input['name'] . '/' . $input['module'] . '/', $imageName, ['disk' => 'public']);
        } else {
            $pathImage = $videoDB->thumbnail;
        }

        if ($request->hasFile('video')) {
            Storage::disk('public')->delete($videoDB->videoMedia->path);
            // Logic send video
            //input new video
            $video = $request->file('video_id');
            //call function getID3
            $getID3 = new getID3();
            //name video
            $videoName = date('YmdHis') . "." . $video->getClientOriginalExtension();
            //path video
            $path = 'video/' . $input['module'] . '/' . $input['channelName'];

            if (!File::isDirectory(public_path('storage/' . $path))) {
                File::makeDirectory(public_path('storage/' . $path));
            }
            $video->storeAs($path . "/", $videoName, ['disk' => 'public']);
            //duration video
            $file = $getID3->analyze($video);
            $duration = "00:" . $file['playtime_string'];
            //extension video
            $fileExt = $video->extension();
            //size video
            $fileSize = $video->getSize();

            //add function/logic to input and create
            $input['name'] = $videoName;
            $input['path'] = $path . "/" . $videoName;
            $input['size'] = $fileSize;
            $input['ext'] = $fileExt;
            $input['duration'] = $duration;

            $vid = Video::where('id', $videoDB->video_id)->update([
                'name' => $input['name'],
                'path' => $input['path'],
                'size' => $input['size'],
                'extension' => $input['ext'],
                'duration' => $input['duration'],
            ]);
            $input['video_id'] = $vid->id;
        } else {
            $input['video_id'] = $videoDB->video_id;
        }
        $result = VideoInformation::find($id)->update([
            'title' => $input['title'],
            'title-alt' => $input['title_alt'],
            'genre' => $input['genre'],
            'author' => $input['author'],
            'studio' => $input['studio'],
            'category_video' => $input['category_video'],
            'description' => $input['description'],
            'tag' => $input['tag'],
            'tahunFilm' => $input['tahunFilm'],
            'rating' => $input['rating'],
            'thumbnail' => $pathImage,
            'video_id' => $input['video_id'],
            'channel_id' => $input['channel_id']
        ]);
        $videoDBResult = VideoInformation::find($id);
        return redirect()->route('video.show', $videoDBResult->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = VideoInformation::find($id);
        Storage::disk('public')->delete($video->thumbnail);
        Storage::disk('public')->delete($video->videoMedia->id);
        Video::find($video->id)->delete();
        $video->delete();

        return redirect()->route('video.index');
    }
}
