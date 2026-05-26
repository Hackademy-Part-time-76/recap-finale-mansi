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
        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- protected $fillable = ['title', 'body', 'image', 'user_id']; --}}
            <div class="mb-3">
                <label class="form-label">Titolo Articolo</label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                    aria-describedby="emailHelp">
                @error('title')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                @foreach ($tags as $tag)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" name="tags[]"
                            id="checkDefault-{{ $tag->id }}">
                        <label class="form-check-label" for="checkDefault-{{ $tag->id }}">
                            {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Corpo Articolo</label>

                <textarea class="form-control" name="body" id="" cols="30" rows="10">{{ old('body') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Immagine Libro</label>
                <input class="form-control" type="file" name="image" id="">
            </div>

            <button type="submit" class="btn btn-primary">Salva</button>
        </form>
    </div>
</x-layout>
