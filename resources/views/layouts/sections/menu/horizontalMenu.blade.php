@php
    $configData = Helper::appClasses();
@endphp
<!-- Horizontal Menu -->
<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal  menu bg-menu-theme flex-grow-0">
    <div class="{{ $containerNav }} d-flex h-100">
        <ul class="menu-inner">
            <li class="menu-item text-danger">
                <a href="{{ route('home') }}" class="menu-link text-danger">
                    <i class="menu-icon tf-icons mdi mdi-chart-arc "></i>
                    <div>Home</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('portal') }}" class="menu-link text-danger">
                    <i class="menu-icon tf-icons mdi mdi-home"></i>
                    <div>Portal</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('info/content') }}" class="menu-link text-danger">
                    <i class="menu-icon tf-icons mdi mdi-newspaper"></i>
                    <div>Berita dan Artikel</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('bank-data') }}" class="menu-link text-danger">
                    <i class="menu-icon tf-icons mdi mdi-folder-file-outline"></i>
                    <div>Bank Data</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('mcu') }}" class="menu-link text-danger">
                    <i class="menu-icon tf-icons mdi mdi-folder-file-outline"></i>
                    <div>MCU</div>
                </a>
            </li>

            {{-- <li class="menu-item">
                <a href="{{ route('portal') }}" class="menu-link ">
                    <i class="menu-icon tf-icons mdi mdi-account-details-outline"></i>
                    <div>Manage Agent</div>
                </a>
            </li> --}}
            {{-- @foreach ($menuData[1]->menu as $menu)
                @php
                    $activeClass = null;
                    $currentRouteName = Route::currentRouteName();

                    if ($currentRouteName === $menu->slug) {
                        $activeClass = 'active';
                    } elseif (isset($menu->submenu)) {
                        if (gettype($menu->slug) === 'array') {
                            foreach ($menu->slug as $slug) {
                                if (str_contains($currentRouteName, $slug) and strpos($currentRouteName, $slug) === 0) {
                                    $activeClass = 'active';
                                }
                            }
                        } else {
                            if (
                                str_contains($currentRouteName, $menu->slug) and
                                strpos($currentRouteName, $menu->slug) === 0
                            ) {
                                $activeClass = 'active';
                            }
                        }
                    }
                @endphp

                <li class="menu-item {{ $activeClass }}">
                    <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}"
                        class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}"
                        @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif>
                        @isset($menu->icon)
                            <i class="{{ $menu->icon }}"></i>
                        @endisset
                        <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
                    </a>

                    @isset($menu->submenu)
                        @include('layouts.sections.menu.submenu', ['menu' => $menu->submenu])
                    @endisset
                </li>
            @endforeach --}}
        </ul>
    </div>
</aside>
<!--/ Horizontal Menu -->
