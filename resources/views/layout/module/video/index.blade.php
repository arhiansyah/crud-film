@extends('master')

@section('content')
  <div class="row">
      <div class="d-flex justify-content-between">
        <div class="">
            <h3 class="mb-3 text-light">Daftar Film Lengkap</h3>
        </div>  
        <div class="">
            <a href="{{ route('video.create') }}" class="btn btn-light">Insert New Film</a>
        </div>
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
                </div>
            </div>
        </div>
        @endforeach
    </div>
  </div>
@endsection