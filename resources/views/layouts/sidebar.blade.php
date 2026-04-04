<style>
    #kt_app_sidebar_user .user-card {
        background: rgba(255, 255, 255, .06);
        border: 1px solid rgba(255, 255, 255, .10);
        transition: .2s ease
    }

    #kt_app_sidebar_user .user-card:hover {
        background: rgba(255, 255, 255, .10) !important;
        border-color: rgba(255, 255, 255, .16) !important;
        transform: translateY(-1px)
    }

    body[data-kt-app-sidebar-minimize="on"] #kt_app_sidebar_user .sidebar-minimize-hide,
    html[data-kt-app-sidebar-minimize="on"] #kt_app_sidebar_user .sidebar-minimize-hide,
    body.app-sidebar-minimize #kt_app_sidebar_user .sidebar-minimize-hide,
    html.app-sidebar-minimize #kt_app_sidebar_user .sidebar-minimize-hide {
        display: none !important
    }

    body[data-kt-app-sidebar-minimize="on"] #kt_app_sidebar_user,
    html[data-kt-app-sidebar-minimize="on"] #kt_app_sidebar_user,
    body.app-sidebar-minimize #kt_app_sidebar_user,
    html.app-sidebar-minimize #kt_app_sidebar_user {
        padding-left: .5rem !important;
        padding-right: .5rem !important
    }

    body[data-kt-app-sidebar-minimize="on"] #kt_app_sidebar_user .user-card,
    html[data-kt-app-sidebar-minimize="on"] #kt_app_sidebar_user .user-card,
    body.app-sidebar-minimize #kt_app_sidebar_user .user-card,
    html.app-sidebar-minimize #kt_app_sidebar_user .user-card {
        padding: .5rem !important
    }

    body[data-kt-app-sidebar-minimize="on"] #kt_app_sidebar_footer .sidebar-minimize-hide,
    html[data-kt-app-sidebar-minimize="on"] #kt_app_sidebar_footer .sidebar-minimize-hide,
    body.app-sidebar-minimize #kt_app_sidebar_footer .sidebar-minimize-hide,
    html.app-sidebar-minimize #kt_app_sidebar_footer .sidebar-minimize-hide {
        display: none !important
    }

    body[data-kt-app-sidebar-minimize="on"] #kt_app_sidebar_footer .btn,
    html[data-kt-app-sidebar-minimize="on"] #kt_app_sidebar_footer .btn,
    body.app-sidebar-minimize #kt_app_sidebar_footer .btn,
    html.app-sidebar-minimize #kt_app_sidebar_footer .btn {
        padding-left: .75rem !important;
        padding-right: .75rem !important;
        justify-content: center !important
    }

    #kt_app_sidebar_footer .btn {
        background: rgba(255, 255, 255, .06) !important;
        border: 1px solid rgba(255, 255, 255, .10) !important;
        color: rgba(255, 255, 255, .75) !important;
    }

    #kt_app_sidebar_footer .btn i {
        color: rgba(255, 255, 255, .75) !important;
    }

    #kt_app_sidebar_footer .btn:hover {
        background: rgba(255, 255, 255, .10) !important;
        border-color: rgba(255, 255, 255, .16) !important;
        color: #ffffff !important;
    }

    #kt_app_sidebar_footer .btn:hover i {
        color: #ffffff !important;
    }
</style>

<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <a href="#">
            <img alt="Logo" src="assets/media/logos/default-dark.svg" class="h-25px app-sidebar-logo-default" />
            <img alt="Logo" src="assets/media/logos/default-small.svg" class="h-20px app-sidebar-logo-minimize" />
        </a>

        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span><span class="path2"></span>
            </i>
        </div>
    </div>

    <div class="px-4 pt-4 pb-3" id="kt_app_sidebar_user">
        <a href="#"
            class="user-card d-flex flex-column align-items-center text-center w-100 rounded-3 p-3 text-decoration-none">
            <div class="symbol symbol-42px symbol-circle position-relative">
                <img src="assets/media/avatars/300-1.jpg" alt="avatar" class="w-30 h-30 object-fit-cover" />
                <span
                    class="position-absolute translate-middle bottom-0 start-100 bg-success rounded-circle border border-2 border-white"
                    style="width:10px;height:10px;"></span>
            </div>

            <div class="sidebar-minimize-hide mt-2 w-100">
                <div class="text-white fw-semibold text-truncate">Research User</div>
                <div class="text-gray-400 fs-8 text-truncate">Administrator</div>
            </div>
        </a>
    </div>

    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_user, #kt_app_sidebar_footer"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true">

                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="false">

                    <div class="menu-item">
                        {{-- <div class="menu-item pt-1">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-8">Main</span>
                            </div>
                        </div> --}}

                        <a class="menu-link {{ Request::is('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-11 fs-2">
                                    <span class="path1"></span><span class="path2"></span>
                                    <span class="path3"></span><span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </div>

                    {{-- <div class="menu-item pt-1">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-8">Master</span>
                        </div>
                    </div> --}}

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-switch fs-2">
                                    <span class="path1"></span><span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Data Master</span>
                            <span class="menu-arrow"></span>
                        </span>

                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link" href="#">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Master Mahasiswa</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="#">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Master Penduduk</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Request::is('mitra') || Request::is('mitra/*') ? 'active' : '' }}"
                                    href="{{ route('mitra.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Master Mitra</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="menu-item pt-1">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-8">Account</span>
                        </div>
                    </div> --}}

                    <div class="menu-item">
                        <a class="menu-link {{ Request::is('users') || Request::is('users/*') ? 'active' : '' }}"
                            href="{{ route('users.index') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Users</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="app-sidebar-footer px-4 pb-4 mt-auto" id="kt_app_sidebar_footer">
        <a href="#" class="btn btn-sm btn-light w-100 d-flex align-items-center justify-content-center gap-2">
            <i class="ki-duotone ki-exit-right fs-4">
                <span class="path1"></span><span class="path2"></span>
            </i>
            <span class="sidebar-minimize-hide fw-semibold">Logout</span>
        </a>
    </div>
</div>
