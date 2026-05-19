<x-layout>
    Homepage
    @auth
        <div>
            <p>Ciao {{ Auth::user()->name }}, {{ Auth::user()->email }}</p>
            <hr>
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
