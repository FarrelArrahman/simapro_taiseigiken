<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Simapro</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">ST</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">{{ __('dashboard.Menu') }}</li>
            <li class="{{ Request::is('*home*') || Request::is('*profile*') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('home') }}"><i class="fas fa-home"></i> <span>{{ __('dashboard.Dashboard') }}</span></a>
            </li>
            <li class="{{ Request::is('*projects*') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('projects') }}"><i class="fas fa-briefcase"></i> <span>{{ __('dashboard.Project') }}</span></a>
            </li>
            <li class="{{ Request::is('*designators*') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('designators.index') }}"><i class="fas fa-list-check"></i> <span>{{ __('dashboard.Designator') }}</span></a>
            </li>
            <li class="{{ Request::is('*vendors*') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('vendors.index') }}"><i class="fas fa-user-tie"></i> <span>{{ __('dashboard.Vendor') }}</span></a>
            </li>
            <li class="{{ Request::is('*units*') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('units.index') }}"><i class="fas fa-star-of-life"></i> <span>{{ __('dashboard.Unit') }}</span></a>
            </li>
            @can('viewAny', \App\Models\User::class)
            <li class="{{ Request::is('*users*') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('users') }}"><i class="fas fa-users"></i> <span>{{ __('dashboard.User') }}</span></a>
            </li>
            @endcan
        </ul>

        <!-- <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a href="https://getstisla.com/docs"
                class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div> -->
    </aside>
</div>
