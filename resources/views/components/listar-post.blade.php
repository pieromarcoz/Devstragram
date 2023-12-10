@php
    $currentUserId = auth()->id();
    $users = \App\Models\User::where('id', '!=', $currentUserId)->take(5)->get();
@endphp

<div>
    <!-- Well begun is half done. - Aristotle -->
    @if($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3  xl:grid-cols-4 gap-6 ">
            @foreach ( $posts as $post )
                <div class="">
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>
        <div class="my-10">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-center mb-12">Sin publications</p>
    @endif
    @if ($users->count() > 1)
    <div class="flex flex-col">
        <h4 class="text-center mb-8 text-3xl font-black">Cuentas recomendadas</h4>
        <div class="grid md:grid-flow-col gap-4">
            @foreach ( $users as $user )
                <div class="card-sugerencias-perfiles-instagram border-2 rounded-md p-5 flex items-center flex-col justify-center">
                    <a href="{{ route('posts.index', $user->username) }}">
                        <img class="rounded-full w-14 h-14 object-cover"  src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}">
                    </a>
                    <a href="{{ route('posts.index', $user->username) }}">
                        <span class="text-sm font-bold">{{ $user->username }}</span>
                    </a>
                    @if ($user->id !== auth()->user()->id)
                        @if (!$user->siguiendo(auth()->user()))
                        <form action="{{ route('users.follow', $user) }}" method="POST">
                            @csrf
                            <input type="submit"
                                class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                value="Seguir">
                        </form>
                        @else
                        <form action="{{ route('users.unfollow', $user) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="submit"
                                class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                value="Dejar de Seguir">
                        </form>
                        @endif
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
