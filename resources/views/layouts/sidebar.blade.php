<style>
    #kt_app_sidebar_user .user-card {
        background: rgba(255, 255, 255, 0.03);
        border: none;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }

    #kt_app_sidebar_user .user-card:hover {
        background: rgba(255, 255, 255, 0.08) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
        background: rgba(255, 255, 255, 0.04) !important;
        border: none !important;
        color: rgba(255, 255, 255, 0.8) !important;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
        font-weight: 600;
        padding: 0.75rem 1rem;
    }

    #kt_app_sidebar_footer .btn i {
        color: rgba(255, 255, 255, 0.8) !important;
        transition: all 0.3s ease;
    }

    #kt_app_sidebar_footer .btn:hover {
        background: rgba(220, 53, 69, 0.85) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.25);
        transform: translateY(-1px);
    }

    #kt_app_sidebar_footer .btn:hover i {
        color: #ffffff !important;
        transform: translateX(3px);
    }

    #kt_app_sidebar_menu_scroll::-webkit-scrollbar {
        width: 4px;
    }

    #kt_app_sidebar_menu_scroll::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
    }

    #kt_app_sidebar_menu_scroll:hover::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.25);
    }

    #kt_app_sidebar_logo .app-sidebar-logo-default {
        height: 48px !important;
        width: auto !important;
        max-width: 100%;
        object-fit: contain;
    }

    #kt_app_sidebar_logo .app-sidebar-logo-minimize {
        height: 28px !important;
        width: auto !important;
        object-fit: contain;
        object-position: center;
    }

    @media (min-width: 992px) {
        #kt_app_sidebar_logo {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #kt_app_sidebar_logo>a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 100%;
        }
    }

    @media (max-width: 991.98px) {
        #kt_app_sidebar_logo .app-sidebar-logo-default {
            height: 40px !important;
            max-width: 100%;
        }

        #kt_app_sidebar_logo .app-sidebar-logo-minimize {
            height: 24px !important;
        }
    }
</style>

@php
    $currentUser = Auth::user();
    $isAdmin = $currentUser?->role === 'admin';
    $isUnit = $currentUser?->role === 'unit';
    $isPimpinan = $currentUser?->role === 'pimpinan';
@endphp

<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <a href="#">
            <img alt="Logo" src="{{ asset('assets/media/logos/logo-elapor.png') }}"
                class="app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('assets/media/logos/unuja.png') }}" class="app-sidebar-logo-minimize" />
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
                <img src="{{ asset('assets/media/avatars/profile.png') }}" alt="avatar"
                    class="w-30 h-30 object-fit-cover" />
                <span
                    class="position-absolute translate-middle bottom-0 start-100 bg-success rounded-circle border-2 border-white"
                    style="width:10px;height:10px;"></span>
            </div>

            <div class="sidebar-minimize-hide mt-2 w-100">
                <div class="text-white fw-semibold text-truncate">{{ $currentUser?->nama ?? 'User' }}</div>
                <div class="text-gray-400 fs-8 text-truncate">
                    {{ $isAdmin ? 'Administrator' : $currentUser?->unit?->singkatan ?? 'Unit' }}
                </div>
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
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-8">Main</span>
                        </div>
                    </div>

                    @if ($isAdmin)
                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                        <span class="path3"></span><span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/users*') ? 'active' : '' }}"
                                href="{{ route('admin.users.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-user fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Pengguna</span>
                            </a>
                        </div>

                        <div class="menu-item pt-1">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-8">Master</span>
                            </div>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/panduan*') ? 'active' : '' }}"
                                href="{{ route('admin.panduan.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-book fs-2">
                                        <span class="path1"></span><span class="path2"></span><span
                                            class="path3"></span><span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Panduan</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/unit*') ? 'active' : '' }}"
                                href="{{ route('admin.unit.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-bank fs-2">
                                        <span class="path1"></span><span class="path2"></span><span
                                            class="path3"></span><span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Unit</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/kategori*') ? 'active' : '' }}"
                                href="{{ route('admin.kategori.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-abstract-26 fs-2">
                                        <span class="path1"></span><span class="path2"></span><span
                                            class="path3"></span><span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Kategori</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/sub-kategori*') ? 'active' : '' }}"
                                href="{{ route('admin.sub-kategori.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-folder fs-2">
                                        <span class="path1"></span><span class="path2"></span><span
                                            class="path3"></span><span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Sub Kategori</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/gedung*') ? 'active' : '' }}"
                                href="{{ route('admin.gedung.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-home fs-2">
                                        <span class="path1"></span><span class="path2"></span><span
                                            class="path3"></span><span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Gedung</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/lantai*') ? 'active' : '' }}"
                                href="{{ route('admin.lantai.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-row-horizontal fs-2">
                                        <span class="path1"></span><span class="path2"></span><span
                                            class="path3"></span><span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Lantai</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/fungsi-ruangan*') ? 'active' : '' }}"
                                href="{{ route('admin.fungsi-ruangan.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-setting-2 fs-2">
                                        <span class="path1"></span><span class="path2"></span><span
                                            class="path3"></span><span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Fungsi Ruangan</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/ruangan*') ? 'active' : '' }}"
                                href="{{ route('admin.ruangan.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-shop fs-2">
                                        <span class="path1"></span><span class="path2"></span><span
                                            class="path3"></span><span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Ruangan</span>
                            </a>
                        </div>

                        <div class="menu-item pt-1">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-8">Lapor</span>
                            </div>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/laporan*') ? 'active' : '' }}"
                                href="{{ route('admin.laporan.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-message-text-2 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Kelola Laporan</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/history-laporan*') ? 'active' : '' }}"
                                href="{{ route('admin.history-laporan.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-time fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">History Laporan</span>
                            </a>
                        </div>

                        <div class="menu-item pt-1">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-8">Statistik</span>
                            </div>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/statistik-unit*') ? 'active' : '' }}"
                                href="{{ route('admin.statistik-unit.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-chart-pie-4 fs-2">
                                        <span class="path1"></span><span class="path2"></span><span
                                            class="path3"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Statistik Laporan</span>
                            </a>
                        </div>
                    @elseif ($isUnit)
                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('unit/dashboard*') ? 'active' : '' }}"
                                href="{{ route('unit.dashboard.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                        <span class="path3"></span><span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('unit/panduan*') ? 'active' : '' }}"
                                href="{{ route('unit.panduan.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-book fs-2">
                                        <span class="path1"></span><span class="path2"></span><span
                                            class="path3"></span><span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Panduan</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('unit/history-laporan*') ? 'active' : '' }}"
                                href="{{ route('unit.history-laporan.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-time fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">History Laporan</span>
                            </a>
                        </div>
                    @elseif ($isPimpinan)
                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('pimpinan/dashboard*') ? 'active' : '' }}"
                                href="{{ route('pimpinan.dashboard.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                        <span class="path3"></span><span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('pimpinan/panduan*') ? 'active' : '' }}"
                                href="{{ route('pimpinan.panduan.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-book fs-2">
                                        <span class="path1"></span><span class="path2"></span><span
                                            class="path3"></span><span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Panduan</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('pimpinan/history-laporan*') ? 'active' : '' }}"
                                href="{{ route('pimpinan.history-laporan.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-time fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">History Laporan</span>
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="app-sidebar-footer px-4 pb-4 mt-auto" id="kt_app_sidebar_footer">
        <form action="{{ route('logout') }}" method="POST" class="w-100">
            @csrf
            <button type="submit"
                class="btn btn-sm btn-light w-100 d-flex align-items-center justify-content-center gap-2">
                <i class="ki-duotone ki-exit-right fs-4">
                    <span class="path1"></span><span class="path2"></span>
                </i>
                <span class="sidebar-minimize-hide fw-semibold">Logout</span>
            </button>
        </form>
    </div>
</div>
