<x-layout>

<div class= "container-background-solo container-fluid p-5 bg-info text-center text-white">
    <div class= "row justify-content-center">
        <h1 class= "display-1">
            < Lavora con noi >
        </h1>
    </div>
</div>
<div class="container my-5 text-careers">
    <div class=" row justify-content-center align-items-center border rounded p-2 shadow">
        <div class="col-12 col-md-6">
            <h2>Lavora come amministratore</h2>
            <p>Controlla le richieste della sezione "lavora con noi", i tag e categorie degli articoli della piattaforma.</p>
            <h2>Lavora come revisore</h2>
            <p>Controlla gli articoli scritti e decidi se possono essere pubblicati in piattaforma.</p>
            <h2>Lavora come redattore</h2>
            <p>Se sei appassionato di giornalismo e ami scrivere, fai sicuramente al caso nostro.</p>
        </div>
        <div class="col-12 col-md-6">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors ->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('careers.submit')}}" method="POST" class="p-5">
            @csrf
            <div class="mb-3">
                <label for="role" class="form-label">Per quale ruolo ti stai candidando?</label>
                <select name="role" id="role" class="form-control">
                    <option value="">Scegli qui:</option>
                    <option value="admin">Amministratore</option>
                    <option value="revisor">Revisore</option>
                    <option value="writer">Redattore</option>
                </select>
            </div>
            <div class="mb-3">
            <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') ?? Auth::user()->email }}">
            </div>
            <div class="mb-3">
            <label for="message" class="form-label">Parlaci di te</label>
                <textarea name="message" id="message" cols="30" rows="7" class="form-control">{{ old('message') }}</textarea>
            </div>
            <div class="mt-2">
                <button class="btn btn-info text-white">Invia la tua candidatura</button>
            </div>
        </form>
        </div>
    </div>
</div>


</x-layout>