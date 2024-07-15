<div class="table-responsive"> <table class="table table-striped table-hover border">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Sottotitolo</th>
                <th scope="col">Redattore</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <th scope="row">{{ $article->id }}</th>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->subtitle }}</td>
                    <td>{{ $article->user->name }}</td>
                    <td>
                        <div class="d-flex flex-column flex-md-row align-items-center">
                            @if (is_null($article->is_accepted))
                                <form action="{{ route('article.show', compact('article')) }}" method="get" class="d-inline mb-1 mb-md-0">
                                    @csrf
                                    <button class="btn btn-sm btn-info text-white">Leggi</button>
                                </form>
                            @else
                                <form action="{{ route('revisor.undoArticle', compact('article')) }}" method="POST" class="d-inline mb-1 mb-md-0">
                                    @csrf
                                    <button class="btn btn-sm btn-info text-white">Riporta in revisione</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>