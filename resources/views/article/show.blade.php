<x-layout>

<div class= "container-fluid p-5 bg-white text-center title">
    <div class= "raw justify-content-center">
        <h1 class= "display-1 text-article">
            Titolo : {{ $article->title }}
        </h1>
    </div>
</div>
<div class="container my-5 text-center paragrafoCard text-article">
    <div class=" row justify-content-center">
        <div class="col-12 col-md-8">      
                <img src="{{ Storage::url($article->image) }}" alt="immagine non disponibile" class="img-fluid my-3">   
                <div>
                    <h2>{{ $article->subtitle }}</h2>
                    @if ( $article->category)
                        <a class=" small text-article d-flex justify-content-center align-items-center">{{  $article->category->name }}</a>
                    @else
                        <p class="small text-article fst-italic text-capitalize">
                            Non categorizzato
                        </p>
                    @endif
                    <div class="my-3 text-article fst-italic">
                        <p>Redatto da {{ $article->user->name }} il {{ $article->created_at->format('d/m/Y')}} </p>
                    </div>
                </div>
                <hr>
                <p>{{ $article->body }}</p>
                <div class="text-center">
                    <a href="{{ route('article.index')}}" class="btn btn-info text-white my-5">Torna indietro</a>
                </div>
                <div class="d-flex justify-content-between">
                    @if (Auth::user() && Auth::user()->is_revisor && !$article->is_accepted)
                        <form action="{{ route('revisor.acceptArticle', compact('article')) }}" method="POST">
                            @csrf
                            <button class="btn btn-success text-white">Accetta articolo</button>
                        </form>
                        <form action="{{ route('revisor.rejectArticle', compact('article')) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger text-white">Rifiuta articolo</button>
                        </form>
                    @endif
                </div>
        </div>
    </div>
</div>

</x-layout>