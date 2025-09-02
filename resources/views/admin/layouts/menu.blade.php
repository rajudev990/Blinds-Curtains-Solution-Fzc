<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a target="_blank" href="{{ url('/') }}" class="nav-link"><i class="fa fa-globe"></i></a>
        </li>
    </ul>
    <div class="navbar-nav pl-2 m-auto">
        <!-- <ol class="breadcrumb p-0 m-0 bg-white">
			<li class="breadcrumb-item active">Dashboard</li>
		</ol> -->
        @canany(['Marketing access', 'Marketing create', 'Marketing edit', 'Marketing delete'])
        <div class="btn-group mr-2 menu-desktop">
            <button type="button" class="btn dropdown-toggle border" data-toggle="dropdown" aria-expanded="false">
                Marketing Team
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.role.book.marketing-list') }}">Marketing List</a>
            </div>
        </div>
        @endcanany

        @canany(['Installation access', 'Installation create', 'Installation edit', 'Installation delete'])
        <div class="btn-group mr-2 menu-desktop">
            <button type="button" class="btn dropdown-toggle border" data-toggle="dropdown" aria-expanded="false">
                Installetion Team
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.role.order.installation-list') }}">Installetion List</a>
            </div>
        </div>
        @endcanany

        @canany(['Production access', 'Production create', 'Production edit', 'Production delete'])
        <div class="btn-group mr-2 menu-desktop">
            <button type="button" class="btn dropdown-toggle border" data-toggle="dropdown" aria-expanded="false">
                Production Team
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.role.order.production-list') }}">Production List</a>
            </div>
        </div>
        @endcanany


    </div>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
                @if(Auth::guard('admin')->user()->image !=null)
                <img src="{{ Storage::url(Auth::guard('admin')->user()->image) }}" class='img-circle elevation-2' width="40" height="40" alt="">
                @else
                <img src="{{ asset('admin-assets/') }}/img/avatar5.png" class='img-circle elevation-2' width="40" height="40" alt="">
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
                <h4 class="h4 mb-0"><strong>{{ Auth::guard('admin')->user()->name }}</strong></h4>
                <div class="mb-3">{{ Auth::guard('admin')->user()->email }}</div>
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">
                    <i class="fas fa-user-cog mr-2"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.profile.passedit') }}" class="dropdown-item">
                    <i class="fas fa-lock mr-2"></i> Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" href="{{ route('admin.logout') }}" class="dropdown-item text-danger">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>
        </li>
    </ul>
</nav>