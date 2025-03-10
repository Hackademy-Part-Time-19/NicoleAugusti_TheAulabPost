@php
    use Illuminate\Support\Facades\Auth;
@endphp
<nav class="navbar navbar-expand-lg navAndFoot">
  <div class="container-fluid">
    <a class="navbar-brand text-dashboard" href="{{ route ('homepage') }}">The Aulab Post</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-dashboard" href="{{ route('article.create')}}">Inserisci un articolo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dashboard" href="{{ route('article.index')}}">Tutti gli articoli</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dashboard" href="{{ route('careers')}}">Lavora con noi</a>
        </li>
        @auth
        @if (Auth::user()->is_admin)
          <li class="nav-item">
          <a class="nav-link text-dashboard" href="{{ route('admin.dashboard' )}}">Dashboard Admin</a> 
          </li>
        @endif
        @if (Auth::user()->is_revisor)
          <li class="nav-item">
          <a class="nav-link text-dashboard" href="{{ route('revisor.dashboard' )}}">Dashboard Revisore</a> 
          </li>
        @endif
        @if (Auth::user()->is_writer)
          <li class="nav-item">
          <a class="nav-link text-dashboard" href="{{ route('writer.dashboard' )}}">Dashboard Redattore</a> 
          </li>
        @endif
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dashboard" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Benvenuto {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu text-dashboard">
            <li class="nav-item">
              <form action=" {{ route('logout') }}" id="logout-form" method="POST">
                @csrf
                <button type="submit" class="btn nav-link">Logout</button>
              </form>
            </li> 
          </ul>
        </li>
        @endauth
        @guest
        <li class="nav-item dropdown text-dashboard">
          <a class="nav-link dropdown-toggle text-dashboard" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Benvenuto ospite
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href=" {{ route ('register') }}">Registrati</a>
            <li><a class="dropdown-item" href=" {{ route ('login') }}">Accedi</a>
            </li> 
          </ul>
        </li>
        @endguest
      </ul>
      <form class="d-flex" method="GET" action="{{ route ('article.search') }}">
        <input class="form-control me-2" type="search" placeholder="Cosa stai cercando?" aria-label="Search" name="query">
        <button class="btn btn-outline-info" type="submit">Cerca</button>
      </form>  
    </div>
  </div>
</nav>