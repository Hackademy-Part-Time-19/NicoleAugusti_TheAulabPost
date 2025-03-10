<x-layout>
    <div class="container-background-solo container-fluid p-5 bg-info text-center">
        <div class="raw justify-content-center">
            <h1 class="display-1">
                < Accedi >
            </h1>
        </div>
    </div>
    <div class="container my-5 text-dashboard">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                @if ($errors->any())
                    <div class=" alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="container my-5 text-careers" action="{{ route('login') }}" method="POST">
                    <div class=" row justify-content-center align-items-center border rounded p-2 shadow">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" name="password" class="form-control" id="password"
                                value="{{old('password')}}">
                        </div>
                        <div class="mb-3">
                            <button class="btn bg-info text-white ">Accedi</button>
                            <p class="small mt-2">Non sei registrato? <a href="{{ route('register') }}">Clicca qui</a>
                            </p>
                        </div>
                    </div>
                </form>




            </div>
        </div>

    </div>
</x-layout>