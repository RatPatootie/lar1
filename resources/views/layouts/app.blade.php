<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="uk">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="icon" href="{{asset('main.png')}}">

    </head>
    <body>
        <header>
            <div class="desktop">
            <div class="div-left">
                <a href="{{route('main')}}" id="logo" type="index"></a>
                <div class="hidden">
                    <a target="_blank" href="https://icons8.com/icon/nUSghnQkEncw/clapperboard">Clapperboard</a> icon by <a target="_blank" href="https://icons8.com">Icons8</a>
                    </div>
                <ul>
                    <li><a href="{{route('movie')}}">Фільми</a></li>
                    <li><a href="{{route('schedule')}}">Розклад</a></li>
                </ul>
            </div>
            <div class="div-right">
                @if (Auth::check())
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <a href="{{route('tickets.get')}}">Квитки</a>|
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Вихід</a>
                @else
                    <a href='{{ route("login") }}'>Вхід</a>
                    |
                    <a href='{{ route("register") }}'>Реєстрація</a>
                @endif
            </div>
            </div>
            <div class="dropdown-menu">
                <a href="{{route('main')}}"  class="logo" type="index"></a>
                <div class="h-m__bars" style="float:right;margin: 12px" onclick="barcilick()">
                    <span class="h-m__bar"></span>
                    <span class="h-m__bar"></span>
                    <span class="h-m__bar"></span>
                </div>
                <ul class="hidden bar">

                       <li><a href="{{route('movie')}}">Фільми</a></li>
                       <li><a href="{{route('schedule')}}">Розклад</a></li>
                @if (Auth::check())
                       <li> <a href="{{route('tickets.get')}}">Квитки</a>|
                       <li> <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Вихід</a>
                    @else
                       <li> <a href='{{ route("login") }}'>Вхід</a>
                       <li> <a href='{{ route("register") }}'>Реєстрація</a>
                    @endif
                </ul>
            </div>
        </header>

        <div class="container">
            @yield('content')
        </div>

        <footer>
            <div class="f-container">
                <h3>addres</h3>
                <div>м.Львів  </div>
            </div>
            <div class="f-container">
                <h3>Phone</h3>
                <div>0676971243</div>
            </div>
            <div class="f-container">
                <h3>sosial media</h3>
                <div>email@example.com</div>
            </div>
        </footer>
    </body>
<script>function barcilick() {
        let hiddens = document.querySelectorAll('.bar');
        if (window.innerWidth <= 768) {
            hiddens.forEach(hidden => {
                hidden.classList.toggle('hidden');
            });
        }
    }</script>
</html>
