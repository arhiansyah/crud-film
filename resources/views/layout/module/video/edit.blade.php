@extends('master')

@section('content')
    <div class="row">
        <div class="col-12 mb-4 mt-2">
            <h3>Update Data Film</h3>
        </div>
        <div class="col-12">
            <form action="{{ route('video.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="exampleFormControlInput1" class="form-label">Judul Film</label>
                            <input type="text" class="form-control" name="title" id="exampleFormControlInput1" value="{{ old('title', $video->title) }}" placeholder="input your title film">       
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group @error('title_alt') has-error @enderror">
                            <label for="exampleFormControlInput1" class="form-label">Judul Film - ENG/JPN/KOREA</label>
                            <input type="text" class="form-control" name="title_alt" id="exampleFormControlInput1" value="{{ old('title_alt', $video->title_alt) }}" placeholder="input your title film">
                        </div>
                    </div>
                    <div class="col-3 mt-3">
                        <div class="form-group @error('genre') has-error @enderror">
                            <label for="tag" class="d-block mb-2">Genre Film</label>
                            <input type="text"  name="genre" class="form-control tagsinput" data-role="tagsinput" value="{{ old('genre', $video->genre) }}">
                        </div>
                    </div>
                    <div class="col-3 mt-3">
                        <div class="form-group @error('author') has-error @enderror">
                            <label for="tag" class="d-block mb-2">Author Film</label>
                            <input type="text" name="author" autofocus id="author" value="{{ old('author', $video->author) }}"
                                placeholder="Input author your film" class="form-control tagsinput w-100 h-100"
                                data-role="tagsinput">
                        </div>
                    </div>
                    <div class="col-3 mt-3">
                        <div class="form-group @error('studio') has-error @enderror">
                            <label for="tag" class="d-block mb-2">Studio Film</label>
                            <input type="text" name="studio" autofocus id="studio" value="{{ old('studio', $video->studio) }}"
                                placeholder="Input studio your film" class="form-control tagsinput w-100 h-100"
                                data-role="tagsinput">
                        </div>
                    </div>
                    <div class="col-3 mt-3">
                        <div class="form-group @error('tag') has-error @enderror">
                            <label for="tag" class="d-block mb-2">Hastag</label>
                            <input type="text" name="tag" autofocus id="tag" value="{{ old('tag', $video->tag) }}"
                                placeholder="Input tag your film" class="form-control tagsinput w-100 h-100"
                                data-role="tagsinput">
                        </div>
                    </div> 
                    <div class="col-6 mt-3">
                        <div class="form-group @error('category_video') has-error @enderror">
                            <label for="category" class="d-block mb-2">Category Film</label>
                            <select class="form-control" name="category_video" id="" value="{{ old('category_video', $video->category_video) }}">
                                <option selected>Select Your Option</option>
                                @foreach ($category as $ct)
                                    @if ($ct->id == $video->category_video)
                                        <option selected value="{{ $ct->id }}">{{ $video->category->name }}</option>
                                    @endif
                                    <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6 mt-3">
                        <div class="form-group @error('channel_id') has-error @enderror">
                            <label for="channel" class="d-block mb-2">Channel Film</label>
                            <select class="form-control" name="channel_id" id="" value="{{ old('channel_id', $video->channel_id) }}">
                                <option selected>Select Your Option</option>
                                @foreach ($channel as $ct)
                                    @if ($ct->id == $video->channel_id)
                                        <option selected value="{{ $ct->id }}">{{ $video->channel->name }}</option>
                                    @endif
                                        <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group @error('description') has-error @enderror">
                            <label for="description" class="d-block mb-3">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="5">{{ old('description', $video->description) }}</textarea>
                        </div>
                    </div>
                    <div class="col-6 mt-3">
                        <div class="form-group @error('tahunFilm') has-error @enderror">
                            <label for="tahunFilm" class="d-block mb-2">Years</label>
                            <input type="text" name="tahunFilm" autofocus id="tahunFilm" value="{{ old('tahunFilm', $video->tahunFilm) }}"
                                placeholder="Input tahun film" class="form-control">
                        </div>
                    </div>
                    <div class="col-6 mt-3">
                        <div class="form-group @error('rating') has-error @enderror">
                            <label for="rating" class="d-block mb-2">Rate</label>
                            <input type="number" name="rating" autofocus id="rating" value="{{ old('rating', $video->rating) }}"
                                placeholder="Input rating film" class="form-control">
                        </div>
                    </div>
                    <div class="col-6 mt-3">
                        <div class="form-group @error('thumbnail') has-error @enderror">
                            @if ($video->thumbnail)
                                <img src="{{ route('showimage', $video->thumbnail) }}" class="w-25" alt="{{ $video->slug }}">
                            @endif
                            <label for="thumbnail" class="d-block mb-2">Thumbnail Img</label>
                            <input type="file" name="thumbnail" class="form-control" value="{{ old('thumbnail') }}" id="thumbnail">
                        </div>
                    </div>
                    <div class="col-6 mt-3">
                        <div class="form-group @error('video_id') has-error @enderror">
                            @if ($video->videoMedia)
                                <video src="{{ route('showimage', $video->videoMedia->path) }}" class="w-50 text-center" controls></video>
                            @endif
                            <label for="video_id" class="d-block mb-2">Video</label>
                            <input type="file" name="video_id" class="form-control" value="{{ old('video_id') }}" id="thumbnail">
                        </div>
                    </div>
                </div>
                <button class="w-100 btn btn-primary mt-5 mb-5" type="submit">Submit Data</button>
            </form>
        </div>
    </div>
@endsection
@yield('script')
<script>
    $('.tagsinput').tagsinput({
        tagClass: 'badge-danger'
    });
</script>

