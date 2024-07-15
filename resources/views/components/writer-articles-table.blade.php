<div class="table-responsive">
    <table class="table table-striped table-hover border">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Sottotitolo</th>
                <th scope="col">Categoria</th>
                <th scope="col">Tags</th>
                <th scope="col">Creato il</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <th scope="row">{{ $article->id }}</th>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->subtitle }}</td>
                    <td>{{ $article->category->name ?? 'Non categorizzato' }}</td>
                    <td>
                        @foreach ($article->tags as $tag)
                            {{ $tag->name }}
                        @endforeach
                    </td>
                    <td>{{ $article->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="d-flex flex-column flex-md-row"> <a href="{{ route('article.show', compact('article')) }}" class="btn btn-sm btn-info text-white mb-1 mb-md-0">Leggi</a>
                            <a href="{{ route('article.edit', compact('article')) }}" class="btn btn-sm btn-warning text-white mx-md-1 mb-1 mb-md-0">Modifica</a>
                            <form action="{{ route('article.destroy', compact('article')) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger">Elimina</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>