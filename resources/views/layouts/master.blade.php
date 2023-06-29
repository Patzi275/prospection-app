<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <title>@yield('title')</title>
</head>

<body>
  <div class="d-flex">
    <div class="sidebar-container" id="sidebar-container">
      <div class="d-flex flex-column p-3 h-100 w-100 text-light bg-dark sidebar">
        <div class="d-flex align-items-center justify-content-between mb-3 link-light text-decoration-none">
          <span class="fs-4">Prospection</span>
          <button type="button" class="btn btn-light btn-sm d-md-none" id="nav-closer">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
          </button>
        </div>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a href="{{ route('prospections.create') }}"
              class="nav-link {{ in_array(Route::currentRouteName(), ['prospections.create']) ? 'active' : 'link-light' }}"
              aria-current="page">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-file-text me-2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
              </svg>
              Formulaire
            </a>
          </li>
          <li>
            <a href="{{ route('prospections.index') }}"
              class="nav-link {{ in_array(Route::currentRouteName(), ['prospections.index', 'prospections.show', 'prospections.edit']) ? 'active' : 'link-light' }}">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-table me-2">
                <path
                  d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2V9M9 21H5a2 2 0 0 1-2-2V9m0 0h18">
                </path>
              </svg>
              Données
            </a>
          </li>
        </ul>
        <hr>
        <div class="text-center dropdown">
          <a href="#" class="link-light text-decoration-none dropdown-toggle" id="userDropdown"
            data-bs-toggle="dropdown" aria-expanded="false">
            <strong>{{ Auth::user()->name }}</strong>
          </a>
          <ul class="dropdown-menu text-small shadow" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="{{ route('logout') }}">Deconnexion</a></li>
          </ul>
        </div>
      </div>
    </div>
    <main class="p-4 w-100">
      <div class="pb-4 d-md-none">
        <button class="btn btn-light" id="nav-opener">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-menu">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
          </svg>
        </button>
      </div>
      @yield('content')
    </main>
  </div>


  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  <script>
    const opener = document.getElementById('nav-opener');
    const closer = document.getElementById('nav-closer');
    const sidebar_container = document.getElementById('sidebar-container');

    opener.addEventListener('click', () => {
      sidebar_container.classList.add('sidebar-container--open');
    });

    closer.addEventListener('click', () => {
      sidebar_container.classList.remove('sidebar-container--open');
    });

  </script>
  @yield('script')
</body>

</html>