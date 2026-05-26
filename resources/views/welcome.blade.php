<x-layout>
    Homepage
    @auth

        <div>
            <p>Ciao {{ Auth::user()->name }}, {{ Auth::user()->email }}</p>
            <hr>
            <div>
                <h4>Lista Articoli scritti</h4>
                <ul>
                    @foreach (Auth::user()->articles as $article)
                        <li>{{ $article->title }}</li>
                    @endforeach
                </ul>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    @endauth

    @guest
        <ul>
            <li><a href="{{ route('login') }}">Accedi</a></li>
            <li><a href="{{ route('register') }}">Registrati</a></li>
        </ul>
    @endguest
</x-layout>
