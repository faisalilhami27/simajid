<div class="layout-main">
    <div class="layout-sidebar">
        <div class="layout-sidebar-backdrop"></div>
        <div class="layout-sidebar-body">
            <div class="custom-scrollbar">
                <nav id="sidenav" class="sidenav-collapse collapse">
                    <ul class="sidenav level-1 list-menu">
                        <li class="sidenav-search">
                            <form class="sidenav-form" action="{{ route('role.pick') }}" method="POST" id="pickRole" role="pickRole">
                                @csrf
                                <div class="form-group form-group-sm">
                                    @if(App\Models\RoleUserPengurus::where('id_pengurus', Auth::id())->count() > 1)
                                        <select name="id_user_level" id="demo-select2-1" class="form-control">
                                            @foreach(App\Models\RoleUserPengurus::where('id_pengurus', Auth::id())->with('role')->get() as $user)
                                                @if(!empty(session('id_user_level')) && session('id_user_level') == $user->role->id)
                                                    <option value="{!! $user->role->id !!}" selected>{!! $user->role->nama !!}</option>
                                                @else
                                                    <option value="{!! $user->role->id !!}">{!! $user->role->nama !!}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @else
                                        <div class="input-with-icon">
                                            <input class="form-control" type="text" placeholder="Search…">
                                            <span class="icon icon-search input-icon"></span>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </li>
                        <li class="sidenav-heading">Navigation</li>
                        <li class="sidenav-item {{ isActiveRoute('dashboard') }}">
                            <a href="{{ route('dashboard') }}">
                                <span class="sidenav-icon icon icon-dashboard"></span>
                                <span class="sidenav-label">Dashboard</span>
                            </a>
                        </li>
                        @if(!empty(session('navigations')))
                            @foreach(session('navigations') as $route)
                                @if(empty($route['child']))
                                    <li class='sidenav-item {!! isActiveRoute($route['url']) !!}'>
                                        <a href='{!! route($route['url']) !!}'>
                                            <span class='sidenav-icon {{ $route['icon'] }}'></span>
                                            <span class='sidenav-label'> {{ $route['title'] }}</span>
                                        </a>
                                    </li>
                                @else
                                    <li class='sidenav-item has-subnav'>
                                        <a href='{{ $route['url'] }}'>
                                            <span class='sidenav-icon {{ $route['icon'] }}'></span>
                                            <span class='sidenav-label'> {{ $route['title'] }}</span>
                                        </a>
                                        <ul class='sidenav level-2 sub-menu collapse'>
                                            <li class='sidenav-heading'>{{ $route['title'] }}</li>
                                            @foreach($route['child'] as $child)
                                                <li class='{{ isActiveRoute($child['url']) }}'>
                                                    <a href='{!! route($child['url']) !!}'  style='cursor: pointer'><span class="{{ $child['icon'] }}"></span>{{ $child['title'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        @else
                            <p>Anda belum dipilih</p>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    {{-- Content --}}
    @yield('content')

    <div class="layout-footer">
        <div class="layout-footer-body">
            <small class="version"> Version {{ versionApp() }}</small>
            <small class="copyright">{{ \Carbon\Carbon::now()->format('Y') }} &copy; Rental Mobil <a href="https://laravel.com" target="_blank">Powered By Laravel 5.8</a></small>
        </div>
    </div>
</div>
