<nav class="navbar navbar-expand-lg navbar-light bg-dark">


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-white" href="{{ route('visitantes.index') }}"><i class="fa-solid fa-user-tie"></i>
                    Controle de
                    visitantes</a>
            </li>

        </ul>
        <form method="POST" action="{{ route('logout') }}" class="d-flex">
            @csrf
            <button type="submit" class="btn btn-danger ms-2">Logout</button>
        </form>
    </div>
</nav>
