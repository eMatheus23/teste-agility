<!DOCTYPE html>
<html lang="PT-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" type="text/css" href="{{ asset('css/global.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">

  <link rel="stylesheet" href="https://use.typekit.net/hbb7dva.css">

  <title>Listagem de Usuários</title>
</head>

<body>
  <div id="landing-page">
    <article class="page__hero">
      <div class="content-wrapper">
        <h1> <img src={{ asset('img/svgexport-7.svg') }} alt=""> Listagem de Usuários</h1>
      </div>

      {{-- <img src={{ asset('img/hero-img.jpg') }} alt=""> --}}
    </article>

    <main>
      <div class="content-wrapper">
        <div class="user-cards__container">
          @foreach ($users as $user)
            <div class="user__card @if ($user->customer == 'Agility') highlight @endif">
              <img class="profile__img" src={{ asset('img/svgexport-10.svg') }} alt="">


              <h3 class="user__name">{{ $user->name }}</h3>
              <a class="user__email" href="mailto:{{ $user->email }}">
                <span>{{ $user->email }}</span>
              </a>
              <p class="user__customer">
                <strong>
                  Empresa:
                </strong>

                {{ $user->customer }}
              </p>
              <p class="user__status">
                <strong>
                  Status:
                </strong>

                {{ $user->status }}
              </p>


            </div>
          @endforeach
        </div>


        <aside>
          <form class="page__filter">
            <h3>Deseja filtrar os resultados?</h3>

            <div class="input-container">
              <label for="name">Nome</label>
              <input type="text" name="name">
            </div>

            <div class="input-container">
              <label for="email">E-mail</label>
              <input type="email" name="email">
            </div>

            <div class="input-container">
              <label for="company">Empresa</label>
              <input type="text" name="costumer">
            </div>

            <button class="filter-button">FILTAR</button>
          </form>
        </aside>
      </div>
    </main>
  </div>
</body>

</html>
