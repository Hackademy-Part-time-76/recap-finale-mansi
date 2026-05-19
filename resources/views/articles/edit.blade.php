<x-layout>
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('articles.update', ['article' => $article]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- protected $fillable = ['title', 'body', 'image', 'user_id']; --}}
            <div class="mb-3">
                <label class="form-label">Titolo Articolo</label>
                <input type="text" name="title" value="{{ $article->title }}" class="form-control"
                    aria-describedby="emailHelp">
                @error('title')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Corpo Articolo</label>

                <textarea class="form-control" name="body" id="" cols="30" rows="10">{{ $article->body }}</textarea>
            </div>
            <div class="mb-3">
                <img style="height:40px;" src="{{ Storage::url($article->image) }}" alt="" srcset="">
                <label for="exampleInputEmail1" class="form-label">Immagine Libro</label>
                <input class="form-control" type="file" name="image" id="">
            </div>

            <button type="submit" class="btn btn-primary">Aggiorna</button>
        </form>
    </div>
</x-layout>
