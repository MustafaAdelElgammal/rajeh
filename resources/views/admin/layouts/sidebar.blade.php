<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="index.html">
            <div class="logo-img">
                <!-- <img src="/admin/src/img/brand-white.svg" class="header-brand-img" alt="lavalite"> -->
            </div>
            <span class="text">APP</span>
        </a>
        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i>
        </button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-lavel">الروابط</div>
                <div class="nav-item active">
                    <a href="/dashboard"><i class="ik ik-bar-chart-2"></i><span>لوحة التحكم</span></a>
                </div>

                <div class="nav-item">
                    <a href="{{route('clients.index')}}"><i class="ik ik-users"></i><span>العملاء</span></a>
                </div>



                <div class="nav-item has-sub">
                    <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>الاعدادات</span> <!-- <span
                        class="badge badge-danger">150+</span> --></a>
                    <div class="submenu-content">
                        <a href="{{ route('countries.index') }}" class="menu-item">الدول</a>
                        <a href="{{ route('cities.index') }}" class="menu-item">المدن</a>
                    </div>
                </div>

            </nav>
        </div>
    </div>
</div>
