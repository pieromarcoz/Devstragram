<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('styles')
    <title>DevStagram - @yield('titulo')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    @livewireStyles
</head>
<body class="bg-gray-100">
    <header class="p-5 border-b bg-white shadow">
        <div class="conatiner mx-auto flex justify-between items-center">
            <a href="{{ route('home')}}" class="text-3xl font-black">Devstagram</a>

            @auth
                <nav class="flex gap-2 items-center">
                    <a
                    class="flex items-center gap-2 bg-white p-2 border text-gray-600 rounded text-sm uppercase font-bold cursor-pointer"
                    href="{{ route('posts.create') }}"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>
                        Crear
                    </a>
                    <a class="font-bold text-gray-600" href="{{ route('posts.index', auth()->user()->username) }}">
                        Hola:
                        <span class="font-normal">
                            {{ Auth::user()->username }}
                        </span>
                    </a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-gray-600" >
                            Cerrar Sesión
                        </button>
                    </form>
                </nav>
            @endauth

            @guest
                <nav class="flex gap-2 items-center">
                    <a class="font-bold uppercase text-gray-600" href="{{ route('login') }}">Login</a>
                    <a href="{{route('register')}}" class="font-bold uppercase text-gray-600" >Crear cuenta</a>
                </nav>
            @endguest
        </div>
    </header>
    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('titulo')
        </h2>
        @yield('contenido')
    </main>

    <footer class="text-center p-5 text-gray-500 font-bold uppercase mt-10">
        DevStagram - Todos los derechos reservados {{ now()->year }}
    </footer>
@livewireScripts
</body>
</html>
