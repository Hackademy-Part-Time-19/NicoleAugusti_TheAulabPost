<x-layout>

<div class= "container-background-solo container-fluid p-5 bg-info text-center text-white">
    <div class= "raw justify-content-center">
        <h1 class= "display-1">
            Tutti gli articoli per: {{ $query }}
        </h1>
    </div>
</div>

<div class="container my-5">
    <div class=" row justify-content-center">
        @foreach ($articles as $article)
        <div class="col-12 col-md-3">
            <x-card
                title="{{ $article->title }}"
                subtitle="{{ $article->subtitle }}"
                image="{{ $article->image }}"
                category="{{ $article->category ? $article->category->name : ''}}"
                data="{{ $article->created_at->format('d/m/Y') }}"
                user="{{ $article->user->name }}"
                url="{{ route('article.show', compact('article'))}}"
                urlCategory="{{ $article->category ? route('article.byCategory' , ['category' => $article->category->id]) : '' }}"
                urlAutore="{{ route('article.byUser' , ['user' => $article->user->id]) }}"
                readDuration="{{ $article->readDuration() }}"
            />
        </div>
        @endforeach
    </div>
</div>

</x-layout>