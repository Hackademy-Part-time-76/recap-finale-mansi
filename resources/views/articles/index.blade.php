<x-layout>
    @if (session('success'))
        {{ session('success') }}
    @endif
    <ul>
        @forelse ($articles as $article)
            <li>
                <a href="{{ route('articles.show', ['article' => $article]) }}">Dettagli</a>
                <a href="{{ route('articles.edit', ['article' => $article]) }}">Modifica</a>
                <form action="{{ route('articles.destroy', ['article' => $article]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Elimina</button>
                </form>
                <img style="height:40px;" src="{{ Storage::url($article->image) }}" alt="">{{ $article->title }}
            </li>
        @empty
            <li>Nessun articolo inserito. <a href="{{ route('articles.create') }}">Creane uno nuovo subito!</a></li>
        @endforelse
    </ul>
</x-layout>
