<div class="card">
    <img src="{{ Storage::url($image) }}" alt="immagine non disponibile" class="card-img-top"></img>
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <p class="card-text">{{ $subtitle }}</p>
        <a href="{{ $urlCategory }}" class=" small text-muted d-flex justify-content-center align-items-center">{{ $category }}</a>
        <a href="{{ $urlAutore }}" class=" small text-muted d-flex justify-content-center align-items-center">{{ $user }}</a>
    </div>
    <div class="card-footer text-muted d-flex justify-content-center align-items-center">
        Redatto il {{ $data }} da {{ $user }}
        <a href="{{ $url }}" class="btn btn-info text-white">Leggi</a>
    </div>
</div>