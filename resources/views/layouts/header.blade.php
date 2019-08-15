<div class="layout-header">
    <div class="navbar navbar-default">
        <div class="navbar-header">
            <a class="navbar-brand navbar-brand-center">
                <span style="font-weight: bold; color: #fff; font-family: Ramadhan; font-size: 20px;">{{ mosqueName() }}</span>
            </a>
            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse"
                    data-target="#sidenav">
                <span class="sr-only">Toggle navigation</span>
                <span class="bars">
              <span class="bar-line bar-line-1 out"></span>
              <span class="bar-line bar-line-2 out"></span>
              <span class="bar-line bar-line-3 out"></span>
            </span>
                <span class="bars bars-x">
              <span class="bar-line bar-line-4"></span>
              <span class="bar-line bar-line-5"></span>
            </span>
            </button>
            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse"
                    data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="arrow-up"></span>
                <span class="ellipsis ellipsis-vertical">
                    @if(Auth::guard('pengurus')->check())
                        @if(!is_null(Auth::user()->id_pengurus))
                            @php ($name = Auth::user()->pengurus->nama)
                            @if(!is_null(Auth::user()->pengurus->foto))
                                @php ($photo = url('storage/'.Auth::user()->pengurus->foto))
                            @else
                                @php ($photo = Avatar::create(Auth::user()->pengurus->nama)->toBase64())
                            @endif
                        @else
                            @php ($name = Auth::user()->username)
                            @php ($photo = Avatar::create(Auth::user()->username)->toBase64())
                        @endif
                    @endif
                    <img class="ellipsis-object" width="32" height="32" src="{{ $photo }}" alt="Profile">
            </span>
            </button>
        </div>
        <div class="navbar-toggleable">
            <nav id="navbar" class="navbar-collapse collapse">
                <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true"
                        type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="bars">
                <span class="bar-line bar-line-1 out"></span>
                <span class="bar-line bar-line-2 out"></span>
                <span class="bar-line bar-line-3 out"></span>
                <span class="bar-line bar-line-4 in"></span>
                <span class="bar-line bar-line-5 in"></span>
                <span class="bar-line bar-line-6 in"></span>
              </span>
                </button>
                <ul class="nav navbar-nav navbar-right">
                    <li class="visible-xs-block">
                        <h4 class="navbar-text text-center">Hi, {{ Auth::user()->pengurus->nama }}</h4>
                    </li>
                    <li class="dropdown hidden-xs">
                        <button class="navbar-account-btn" data-toggle="dropdown" aria-haspopup="true">
                            @if(Auth::guard('pengurus')->check())
                                @if(!is_null(Auth::user()->id_pengurus))
                                    @php ($name = Auth::user()->pengurus->nama)
                                    @if(!is_null(Auth::user()->pengurus->foto))
                                        @php ($photo = url('storage/'.Auth::user()->pengurus->foto))
                                    @else
                                        @php ($photo = Avatar::create(Auth::user()->pengurus->nama)->toBase64())
                                    @endif
                                @else
                                    @php ($name = Auth::user()->username)
                                    @php ($photo = Avatar::create(Auth::user()->username)->toBase64())
                                @endif
                            @endif
                            <img class="circle" width="36" height="36" src="{{ $photo }}" alt="test">  @php ($name = Auth::user()->pengurus->nama)
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="navbar-upgrade-version"> Version {{ versionApp() }}</li>
                            <li class="divider"></li>
                            @if(Session::get('count') > 1)
                                <li><a href="{{ URL('role') }}">Pilih Hak Akses</a></li>
                                <li><a href="{{ URL('profile') }}">Profile</a></li>
                                <li><a href="{{ URL('logout') }}">Sign out</a></li>
                            @else
                                <li><a href="{{ URL('profile') }}">Profile</a></li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out-alt"></i> Log out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </li>
                    @if(Session::get('count') > 1)
                        <li class="visible-xs-block">
                            <a href="{{ URL('role') }}">
                                <span class="icon icon-user icon-lg icon-fw"></span>
                                Pilih Hak Akses
                            </a>
                        </li>
                        <li class="visible-xs-block">
                            <a href="{{ URL('profile') }}">
                                <span class="icon icon-user icon-lg icon-fw"></span>
                                Profile
                            </a>
                        </li>
                        <li class="visible-xs-block">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out-alt"></i> Log out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        <li class="visible-xs-block">
                            <a href="">
                                <span class="icon icon-level-up icon-lg icon-fw"></span>
                                Version {{ versionApp() }}
                            </a>
                        </li>
                    @else
                        <li class="visible-xs-block">
                            <a href="{{ URL('profile') }}">
                                <span class="icon icon-user icon-lg icon-fw"></span>
                                Profile
                            </a>
                        </li>
                        <li class="visible-xs-block">
                            <a href="{{ URL('logout') }}">
                                <span class="icon icon-power-off icon-lg icon-fw"></span>
                                Sign out
                            </a>
                        </li>
                        <li class="visible-xs-block">
                            <a href="">
                                <span class="icon icon-level-up icon-lg icon-fw"></span>
                                Version {{ versionApp() }}
                            </a>
                        </li>
                    @endif
                </ul>
                <div class="title-bar">
                    <h1 class="title-bar-title">
                        <span class="d-ib">{{ mosqueName() }}</span>
                        <span class="d-ib">
                </span>
                    </h1>
                    <p class="title-bar-description">
                        <small>Sistem Informasi Manajemen {{ mosqueName() }}</small>
                    </p>
                </div>
            </nav>
        </div>
    </div>
</div>
