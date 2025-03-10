<div class="card bg-gradient">
    <img src="{{ Storage::url($image) }}" alt="immagine non disponibile" class="card-img-top"></img>
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <p class="card-text">{{ $subtitle }}</p>
        @if ($category)
            <a href="{{ $urlCategory }}" class=" small text-muted d-flex justify-content-center align-items-center">{{ $category }}</a>
        @else
            <p class="small text-muted fst-italic text-capitalize">
                Non categorizzato
            </p>
        @endif
        
        <span class="text-muted small fst-italic">tempo di lettura {{ $readDuration }} min</span>
        
        @if ($tags)
            <p class="small fst-italic text-capitalize">
                @foreach ($tags as $tag)
                    #{{ $tag->name }}
                @endforeach
            </p>
        @endif

    </div>
    
    <div class="card-footer text-muted d-flex justify-content-center align-items-center">
        <small class="text-muted">Articolo del {{ $data }} <br> Redatto da: <a href="{{ $urlAutore }}"> {{ $user }} </a></small>
    </div> 
    <a href="{{ $url }}" class="btn btn-info text-white">Leggi</a>
</div>