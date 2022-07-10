@extends('master')
@yield('style')
<style>
    #showID{
        color: #000;
    }
</style>
@section('content')
<div class="row">
    <div class="col-12">
        <a href="{{ route('video.index') }}"><button class="btn btn-primary mb-3">Back</button></a>
        <div class="card">
            <div class="card-header">
                <h3 class="text-dark">Detail {{ $video->title }}</h3>
                <div>
                    <a href="{{ route('video.edit', $video->id) }}" class="btn btn-warning mr-2">Edit</a>
                    <form action="{{ route('video.destroy', $video->id) }}" class="d-inline mb-0" method="post">
                        @csrf @method('delete')
                        <button type="submit" class="btn btn-danger" 
                        onclick="if(!confirm('Are you sure?')) return false;">Delete</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3" id="showID">
                    <div class="col-12">
                        <video class="w-100 mb-3" controls>
                            <source src="{{ route('showimage', $video->videoMedia->path) }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="col-6">
                        <span>Judul Film</span>
                        <h1 class="h1 fw-bold">{{ $video->title  }}</h1>
                    </div>
                    <div class="col-6">
                        <span>Code Uniq Video</span>
                        <h1 class="h1 fw-bold">{{ $video->video_code }}</h1>
                    </div>
                    <div class="col-6">
                        <span>Deskripsi</span>
                        <h1 class="h1 fw-bold">{!! $video->description !!}</h1>
                    </div>
                    <div class="col-6">
                        <span>Tag</span>
                        <h1 class="h1 fw-bold">{{ $video->tag }}</h1>
                    </div>
                    <div class="col-6">
                        <span>Category Film</span>
                        <h1 class="h1 fw-bold">{{ $video->category->name }}</h1>
                    </div>
                    <div class="col-6">
                        <span>Genre</span>
                        <h1 class="h1 fw-bold">{{ $video->genre }}</h1>
                    </div>
                    <div class="col-6">
                        <span>Author</span>
                        <h1 class="h1 fw-bold">{{ $video->author }}</h1>
                    </div>
                    <div class="col-6">
                        <span>Studio</span>
                        <h1 class="h1 fw-bold">{{ $video->studio }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection