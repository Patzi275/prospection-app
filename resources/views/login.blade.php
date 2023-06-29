<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <title>Connexion</title>
</head>

<body>
  <main class="vw-100 vh-100 d-flex justify-content-center align-items-center">
    <form action="{{ route('login.post') }}" method="POST" class="m-auto card p-5">
      @csrf
      <h1 class="h4 mb-4 text-center fw-normal">Connexion</h1>

      @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
        {{ $error.'. ' }}
        @endforeach
      </div>
      @endif

      <div class="mb-3">
        <label for="name" class="form-label">Nom d'utilisateur</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="John" required>
      </div>
      <div class="mb-5">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" required>
      </div>
      
      <button class="w-100 btn btn-primary" type="submit">Se connecter</button>
    </form>
  </main>

  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  @yield('script')
</body>

</html>