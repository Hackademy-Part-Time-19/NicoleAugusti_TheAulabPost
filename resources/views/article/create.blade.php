<x-layout>
    <div class="container-background-solo container-fluid p-5 bg-info text-center text-white">
        <div class="row justify-content-center">
            <h1 class="display-1">
                < Inserisci un articolo >
            </h1>
        </div>
    </div>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('article.store') }}" method="POST" class="text-careers border rounded p-5 shadow" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo:</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}"> 
                    </div>
                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Sottotitolo:</label>
                        <input type="text" name="subtitle" class="form-control" id="subtitle" value="{{ old('subtitle') }}"> 
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Immagine:</label>
                        <input type="file" name="image" class="form-control" id="image" value="{{ old('image') }}"> 
                    </div>
                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags:</label>
                        <input name="tags" class="form-control" id="tags" value="{{ old('tags') }}">
                        <span class="small fst-italic">Dividi ogni tag con una virogola</span> 
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Categoria:</label>
                        <select name="category" id="category" class="form-control text-capitalize"> 
                            @foreach ($categories as $category)
                                <option value=" {{ $category->id}}">{{ $category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Corpo del testo:</label>
                        <textarea name="body" id="body" cols="30" rows="7" class="form-control">{{ old('body') }}</textarea>
                    </div>
                    <div class="mt-2 d-flex justify-content-center">
                        <button class="btn btn-info text-white">Inserisci un articolo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>