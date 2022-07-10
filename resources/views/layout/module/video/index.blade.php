@extends('master')

@section('content')
  <div class="row">
      <div class="d-flex justify-content-between">
        <div class="">
            <h3 class="mb-3 text-light">Daftar Film Lengkap</h3>
        </div>  
        <div class="">
            {{-- <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createModal"> --}}
                {{-- Create Film --}}
            {{-- </button> --}}
            <a href="{{ route('video.create') }}" class="btn btn-light">Insert New Film</a>
        </div>
        <!-- Button trigger modal -->
      </div>
    <div class="col-md-4">
        @foreach ($video as $vid)
        <div class="card p-3 mb-2" style="background-image: url('{{ route('showimage', $vid->thumbnail) }}'); background-repeat: no-repeat; background-size: 415px 300px;">
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-row align-items-center">
                    <div class="ms-2 c-details">
                        <h6 class="mb-0"><i class="fas fa-star" style="color: yellow"></i> {{ $vid->rating }}</h6>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <h3 class="heading text-dark">{{ $vid->title }}</h3>
                <h5 class="text-dark">{{ $vid->title_alt }}</h5>
                <div>
                    <div> <span class="text-dark"> {{ $vid->tahunFilm }} </span></div>
                </div>
                <div class="mt-3">
                    <div class=""> <a href="{{ route('video.show', $vid->id) }}" class="btn btn-danger">Watch</a></div>
                    {{-- <div class=""><span class="btn btn-danger btnShow" data-bs-toggle="modal" data-bs-target="#exampleModalShow" id="{{ $vid->id }}">Watch</span></div> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Modal Create -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content" style="background-color: #000">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Film - Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formModal" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="type" id="type" value="create">
                        <input type="hidden" name="id" id="idVideo" >
                        <div class="row">
                            <div class="col-12">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group @error('title') has-error @enderror">
                                                <label for="exampleFormControlInput1" class="form-label">Judul Film</label>
                                                <input type="text" class="form-control" name="title" id="exampleFormControlInput1" placeholder="input your title film">       
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group @error('title_alt') has-error @enderror">
                                                <label for="exampleFormControlInput1" class="form-label">Judul Film - ENG/JPN/KOREA</label>
                                                <input type="text" class="form-control" name="title_alt" id="exampleFormControlInput1" value="{{ old('title_alt') }}" placeholder="input your title film">
                                            </div>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <div class="form-group @error('genre') has-error @enderror">
                                                <label for="tag" class="d-block mb-2">Genre Film</label>
                                                <input type="text"  name="genre" id="genre" class="form-control tagsinput" data-role="tagsinput">
                                            </div>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <div class="form-group @error('author') has-error @enderror">
                                                <label for="tag" class="d-block mb-2">Author Film</label>
                                                <input type="text" name="author" autofocus id="author" value="{{ old('author') }}"
                                                    placeholder="Input author your film" class="form-control tagsinput w-100 h-100"
                                                    data-role="tagsinput">
                                            </div>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <div class="form-group @error('studio') has-error @enderror">
                                                <label for="tag" class="d-block mb-2">Studio Film</label>
                                                <input type="text" name="studio" autofocus id="studio" value="{{ old('studio') }}"
                                                    placeholder="Input studio your film" class="form-control tagsinput w-100 h-100"
                                                    data-role="tagsinput">
                                            </div>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <div class="form-group @error('tag') has-error @enderror">
                                                <label for="tag" class="d-block mb-2">Hastag</label>
                                                <input type="text" name="tag" autofocus id="tag" value="{{ old('tag') }}"
                                                    placeholder="Input tag your film" class="form-control tagsinput w-100 h-100"
                                                    data-role="tagsinput">
                                            </div>
                                        </div> 
                                        <div class="col-6 mt-3">
                                            <div class="form-group @error('category_video') has-error @enderror">
                                                <label for="category" class="d-block mb-2">Category Film</label>
                                                <select class="form-control" name="category_video" id="category_video">
                                                    <option selected>Select Your Option</option>
                                                    @foreach ($category as $ct)
                                                        <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <div class="form-group @error('channel_id') has-error @enderror">
                                                <label for="channel" class="d-block mb-2">Channel Film</label>
                                                <select class="form-control" name="channel_id" id="channel_id">
                                                    <option selected>Select Your Option</option>
                                                    @foreach ($channel as $ct)
                                                        <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="form-group @error('description') has-error @enderror">
                                                <label for="description" class="d-block mb-3">Deskripsi</label>
                                                <textarea name="description" id="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <div class="form-group @error('tahunFilm') has-error @enderror">
                                                <label for="tahunFilm" class="d-block mb-2">Years</label>
                                                <input type="text" name="tahunFilm" autofocus id="tahunFilm" value="{{ old('tahunFilm') }}"
                                                    placeholder="Input tahun film" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <div class="form-group @error('rating') has-error @enderror">
                                                <label for="rating" class="d-block mb-2">Rate</label>
                                                <input type="number" name="rating" autofocus id="rating" value="{{ old('rating') }}"
                                                    placeholder="Input rating film" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6 mt-3" id="thumbnailDIV">
                                            <div class="form-group @error('thumbnail') has-error @enderror">
                                                <label for="thumbnail" class="d-block mb-2">Thumbnail Img</label>
                                                <input id="thumbnail" type="file" name="thumbnail" class="form-control" value="{{ old('thumbnail') }}" id="thumbnail">
                                            </div>
                                        </div>
                                        <div class="col-6 mt-3" id="videoDIV">
                                            <div class="form-group @error('video_id') has-error @enderror">
                                                <label for="video_id" class="d-block mb-2">Video</label>
                                                <input type="file" id="video" name="video_id" class="form-control" value="{{ old('video_id') }}" id="thumbnail">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>        
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="btnSubmit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                
            </div>
        </div>
    </div>
    <!-- Modal Show -->
    <div class="modal fade" id="exampleModalShow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content" style="background-color: #000">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Film - Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12" id="videoField">
                        </div>
                        <div class="col-6" id="titleFilm">
                        </div>
                        <div class="col-6" id="tagFilm">
                        </div>
                        <div class="col-6" id="genreFilm">
                        </div>
                        <div class="col-6" id="authorFilm">
                        </div>
                        <div class="col-6" id="studioFilm">
                        </div>
                        <div class="col-6" id="tahunFilm">
                        </div>
                        <hr>
                        <div class="col-12" id="descFilm">
                        </div>
                        <hr>


                    </div>
                    <div class="d-flex justify-content-end">
                        <span class="btn btn-warning me-2 btnUpdate" data-bs-toggle="modal" data-bs-target="#createModal">Edit</span>
                        <span class="btn btn-danger ms-2 btnDelete">Delete</span>
                    </div>
                    
            </div>
        </div>
    </div>
  </div>
@endsection
@section('script')
<script>
    let thumbnail;
    let video;
    let title;
    let videoPath;
    $(".btnShow").click(function () {
        let id = $(this).attr('id')
        $('#idVideo').val(id)
        $('#type').val('update')
        $.get("{{ url('/api/video') }}/" + id, function (data, status) {
            title = data.data[0]['title']
            let tag = data.data[0]['tag']
            let genre = data.data[0]['genre']
            let author = data.data[0]['author']
            let studio = data.data[0]['studio']
            let year = data.data[0]['tahunFilm']
            let desc = data.data[0]['description']
            videoPath = data.data[0]['video_media']['path']    
            $('#titleFilm').html(
            `
                <div class="d-flex">
                    <span>Judul Film : </span>
                    <h5 class="fw-bold ms-3" id="title">`+ title +`</h5>
                </div>                
            `);
            $('#tagFilm').html(
            `
                <div class="d-flex">
                    <span>Hastag</span>
                    <h5 class="fw-bold ms-3">`+ tag +`</h5>
                </div>                
            `);
            $('#genreFilm').html(
            `
                <div class="d-flex">
                    <span>Genre :</span>
                    <h5 class="fw-bold ms-3">`+ genre +`</h5>
                </div>                
            `);
            $('#authorFilm').html(
            `
                <div class="d-flex">
                    <span>Author</span>
                    <h5 class="fw-bold ms-3">`+ author +`</h5>
                </div>                
            `);
            $('#studioFilm').html(
            `
                <div class="d-flex">
                    <span>Studio:</span>
                    <h5 class="fw-bold ms-3">`+ studio +`</h5>
                </div>                
            `);
            $('#tahunFilm').html(
            `
                <div class="d-flex">
                    <span>Tahun Rilis:</span>
                    <h5 class="fw-bold ms-3">`+ year +`</h5>
                </div>                
            `);
            $('#descFilm').html(
            `
                <div class="d-flex">
                    <span>Deskripsi :</span>
                    <h5 class="fw-bold ms-3">`+ desc +`</h5>
                </div>                
            `);
            $('#videoField').html(
            `
                <video class="w-100 mb-3" controls>
                    <source src="{{ url('image/`+ videoPath +`') }}" type="video/mp4">
                </video>
            `
            );
            // console.log(id);    
        });
        console.log(title);
        // console.log(title);
        // console.log(videoPath);
        

    })
    $(".btnUpdate").click(function () {
        let id = $('#idVideo').val()
        $.get("{{ url('/api/video') }}/" + id, function (data, status) {
            // console.log(data.data.document.name);
            $("#title").val(data.data[0]['title'])
            $("#title_alt").val(data.data[0]['title_alt'])
            $("#tag").val(data.data[0]['tag'])
            $("#genre").val(data.data[0]['genre'])
            $("#author").val(data.data[0]['author'])
            $("#studio").val(data.data[0]['studio'])
            $("#tahun").val(data.data[0]['tahunFilm'])
            $("#description").val(data.data[0]['description'])
            $("#category_video").val(data.data[0]['category_video'])
            $("#channel_id").val(data.data[0]['channel_id'])
            $("#rating").val(data.data[0]['rating'])
            thumbnail = data.data[0]['thumbnail']
            videoPath = data.data[0]['video_media']['path'] 
            $("#videoDIV").html(
            `
                <div class="form-group @error('video_id') has-error @enderror">
                    @if (`+$("#video_id").val()+` != null)
                        <video src="url('image/'`+ videoPath +`)" class="w-50 text-center" controls></video>
                    @endif
                    <label for="video_id" class="d-block mb-2">Video</label>
                    <input type="file" name="video_id" class="form-control" value="{{ old('video_id') }}" id="thumbnail">
                </div>
            `    
            )
            $("#thumbnailDIV").html(
            `
                <div class="form-group @error('thumbnail') has-error @enderror">
                    @if (`+ thumbnail +` != null)
                        <img src="url('image/'`+ thumbnail +`)" class="w-25" alt="`+ data.data[0]['slug'] +`">
                    @endif
                    <label for="thumbnail" class="d-block mb-2">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control" value="{{ old('thumbnail') }}" id="thumbnail">
                </div>    
            `    
            )
                
        });
    })
    $(".btnDelete").click(function () {
        $("#type").val('delete')
        let dataTr = $("#formModal").serializeArray()
        let dataForm = {
            id: dataTr[1].value,
            type: dataTr[0].value,
        }
        $.ajax({
            url: 'api/video',
            data: dataForm,
            type: "POST",
            success: function (response) {
                console.log(response)
            },
            error: function (error) {
                console.log(error)
            }
        });
                    
        $("#exampleModal").modal('hide')
    })
    $("#btnSubmit").click(function(){
        let dataTr = $("#formModal").serializeArray()
        let dataForm = {
            id: dataTr[1].value,
            type: dataTr[0].value,
            _token: dataTr[2].value,
            title: dataTr[3].value,
            title_alt: dataTr[4].value,
            genre: dataTr[5].value,
            author: dataTr[6].value,
            studio: dataTr[7].value,
            tag: dataTr[8].value,
            category_video: dataTr[9].value,
            channel_id: dataTr[10].value,
            description: dataTr[11].value,
            tahunFilm: dataTr[12].value,
            rating: dataTr[13].value,
            thumbnail: thumbnail,
            video_id: video
        }
        $.ajax({
            url: 'api/video',
            type: "POST",
            data: dataForm,
            processData: false,
            success: function (response) {
                console.log(response)
            },
            error: function (error) {
                console.log(error)
            }
        });
                    
        $("#exampleModal").modal('hide')
    })
    $("#thumbnail").on('change',function(event) {
        thumbnail = event.target.files[0];
        console.log(thumbnail);        
    })
    $("#video").on('change',function(event) {
        video = event.target.files[0];
        let postData = new FormData($("#formModal")[0])
        console.log(video);        
        console.log(postData);
    })
    console.log(thumbnail);        
    
</script>
@endsection