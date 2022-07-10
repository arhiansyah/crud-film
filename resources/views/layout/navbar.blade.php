<nav class="navbar navbar-expand-lg bg-dark navbar-dark" >
    <div class="container">
      <a class="navbar-brand" href="#">Film Crud Sederhana</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/video">Film</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/series">Series</a>
          </li> --}}
        </ul>
        {{-- <div class="d-flex">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown d-flex flex-row-reverse">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="#"> <i class="fas fa-user me-2"></i> {{ Auth::user()->name }}</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="{{ route('actionlogout') }}"> <i class="fas fa-sign-out me-2"></i>Logout</a></li>
                    </ul>
                </li>

            </ul>
            {{-- <button class="btn btn-outline-success">{{Auth::user()->name}}</button> --}}
        {{-- </div>  --}}
      </div>
    </div>
</nav>