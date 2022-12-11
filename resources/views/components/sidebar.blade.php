<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Simapro</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">ST</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="{{ Request::is('*home*') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('home') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a>
            </li>
            <li class="{{ Request::is('*projects*') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('projects') }}"><i class="fas fa-briefcase"></i> <span>Project</span></a>
            </li>
            <li class="{{ Request::is('*designators*') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('designators.index') }}"><i class="fas fa-list-check"></i> <span>Designator</span></a>
            </li>
            <li class="{{ Request::is('*vendors*') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('vendors.index') }}"><i class="fas fa-user-tie"></i> <span>Vendor</span></a>
            </li>
            <li class="{{ Request::is('*units*') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('units.index') }}"><i class="fas fa-star-of-life"></i> <span>Unit</span></a>
            </li>
            <li class="{{ Request::is('*users*') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('users') }}"><i class="fas fa-users"></i> <span>Manajemen User</span></a>
            </li>
        </ul>

        <!-- <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a href="https://getstisla.com/docs"
                class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div> -->
    </aside>
</div>
