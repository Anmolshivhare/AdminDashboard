<div class="sidebar">
    <div class="sidebar-inner">
        {{-- SideBar Logo section Start --}}
        <div
            class="logo-part pt-1 px-2 mb-3 d-flex align-items-center flex-column sticky-top border-bottom border-primary bg-white">
            <a href="url('/home ')" class="m-auto w-75">
                {{-- <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo"
                    class="img-fluid m-auto transition-x d-block" /> --}}
                {{-- <img src="{{ Vite::asset('resources/images/side-logo.png') }}" alt="Logo"
                    class="img-fluid partial-logo transition-x w-0 d-block" /> --}}
            </a>
            <div class="d-flex align-items-center flex-column py-1 sidebar-auth-profile w-100">
                @php
                    $user = auth()->user();
                @endphp
                @if (!empty($user->profile_pic))
                    <a href="{{ route('profile.update') }}" class="m-auto w-75">
                        <img src="{{ asset('uploads/profile/' . $user->profile_pic) }}" alt="User-Profile"
                            class="img-fluid m-auto transition-x d-block border border-primary rounded-circle partial-logo auth-img" />
                    </a>
                @else
                    <a href="{{ route('profile.update') }}" class="m-auto w-75">
                        <img src="" alt="User-Profile"
                            class="img-fluid m-auto transition-x d-block border border-primary rounded-circle partial-logo auth-img" />
                    </a>
                @endif
                <h4 class="user-name fs-5 text-primary mt-3 mb-0">{{ $user->name ? $user->name : '' }}</h4>
                <a href="javascript:void(0)"
                    class="fs-5 text-secondary user-email">{{ $user->email ? $user->email : '' }}
                </a>
            </div>
        </div>

        {{-- SideBar Logo section End --}}
        {{-- SideBar Menu Start --}}
        <ul class="sidebar-menus transition-x navbar-nav pb-5">
            {{-- Dashboard Menu Start --}}

            {{-- {{ isLinkActive('*/dashboard') }} --}}
            <li
                class="sidebar-menus-list-item d-flex align-items-start transition-x nav-item  p-3">
                <span class="sidebar-menus-list-item-img">
                    <i class="fa fa-dashboard fs-5"></i>
                </span>
                <div class="menu-with-icon transition-x">
                    <a class="sidebar-menus-list-item-link nav-link transition-x py-0" aria-current="page"
                        href="/home" title="Dashboard">
                        {{ __('Dashboard') }} </a>
                </div>
            </li>
            {{-- Dashboard Menu End --}}

            {{-- product Menu Start --}}
 
            <li
                class="sidebar-menus-list-item d-flex align-items-start transition-x nav-item  p-3">
                <span class="sidebar-menus-list-item-img">
                    <i class="fa fa-shopping-cart fs-5"></i>
                </span>
                <div class="menu-with-icon transition-x">
                    <a class="sidebar-menus-list-item-link nav-link transition-x py-0" aria-current="page"
                        href="{{ route('products.index') }}" title="Product">
                        {{ __('Product') }} </a>
                </div>
            </li>
            {{-- product Menu End --}}

            {{-- Users Menu Start --}}
                <li class="nav-item tansition-opacity p-3" id="usersMenu">
                    <a class="nav-link p-0  d-flex align-items-center dropdown-toggle" href="#"
                        data-bs-toggle="collapse" data-bs-target="#userSubmenu" aria-expanded="false"
                        aria-controls="userSubmenu">
                        <span class="sidebar-menus-list-item-img">
                            <i class="fa fa-dashboard fs-5"></i>
                        </span> <span
                            class="ms-4  d-lg-inline tansition-opacity">{{ __('labels.users') }}</span>
                    </a>
                    {{-- Users Dropdown Start --}}
                    <ul id="userSubmenu" class="accordion-collapse collapse list-group list-group-flush pt-2">
                        @can('role-list')
                        <li class="list-group-item bg-transparent"><a
                                class="dropdown-item   ms-2  tansition-opacity"
                                href="{{route('roles.index')}}">{{ __('labels.roles') }}</a></li>
                        @endcan
                        @can('permission-list')
                        <li class="list-group-item bg-transparent"><a
                                class="dropdown-item   ms-2  tansition-opacity"
                                href="{{ route('permissions.index') }}">{{ __('labels.permissions') }}</a></li>
                        @endcan
                        @can('user-list')
                        <li class="list-group-item bg-transparent"><a
                                class="dropdown-item   ms-2  tansition-opacity"
                                href="{{ route('users.index') }}">{{ __('labels.admin_user') }}</a></li>
                        @endcan
                    </ul>
                    {{-- Users Dropdown End --}}
                </li>
            {{-- Users Menu End --}}

            {{-- Shop Menu End --}}
 
            <li
                class="sidebar-menus-list-item d-flex align-items-start transition-x nav-item  p-3">
                <span class="sidebar-menus-list-item-img">
                    <i class="fa fa-shopping-cart fs-5"></i>
                </span>
                <div class="menu-with-icon transition-x">
                    <a class="sidebar-menus-list-item-link nav-link transition-x py-0" aria-current="page"
                        href="{{ route('shops.index') }}" title="Shop">
                        {{ __('Shop') }} </a>
                </div>
            </li>
            {{-- Shop Menu End --}}

            {{-- product profile --}}
 
            <li
                class="sidebar-menus-list-item d-flex align-items-start transition-x nav-item  p-3">
                <span class="sidebar-menus-list-item-img">
                    <i class="fa fa-shopping-cart fs-5"></i>
                </span>
                <div class="menu-with-icon transition-x">
                    <a class="sidebar-menus-list-item-link nav-link transition-x py-0" aria-current="page"
                        href="{{ route('product-prices.index') }}" title="Shop">
                        {{ __('Product Profile') }} </a>
                </div>
            </li>
            {{-- product profile --}}

            {{-- Shop Menu End --}}
            <li
                class="sidebar-menus-list-item d-flex align-items-start transition-x nav-item  p-3">
                <span class="sidebar-menus-list-item-img">
                    <i class="fa fa-user fs-5"></i>
                </span>
                <div class="menu-with-icon transition-x">
                    <a class="sidebar-menus-list-item-link nav-link transition-x py-0" aria-current="page"
                        href="{{ route('profile.update') }}" title="User">
                        {{ __('User') }} </a>
                </div>
            </li>
            {{-- Shop Menu End --}}
             
 
                <li
                    class="sidebar-menus-list-item d-flex align-items-start transition-x nav-item   p-3">
                    <span class="sidebar-menus-list-item-img">
                        <i class="fa fa-gear fs-5"></i>
                    </span>
                    <div class="menu-with-icon transition-x">
                        <a class="sidebar-menus-list-item-link nav-link transition-x py-0" aria-current="page"
                            href="javascript:void(0)" title="setting">
                            {{ __('Setting') }} </a>
                    </div>
                </li>
          
            {{-- Setting Management Menu End --}}
        </ul>
        {{-- SideBar Menu End --}}
        {{-- Logout Menu Start --}}
        <ul class="logout-menu sidebar-menus transition-x navbar-nav position-fixed bottom-0 m-0 mh-0 p-0">
            <li
                class="sidebar-menus-list-item d-flex align-items-start transition-x nav-item border-0 p-2 px-4 bg-dark mb-0">
                <span class="sidebar-menus-list-item-img">
                    <i class="fa fa-sign-out fs-5 text-white"></i>
                 </span>
                <div class="menu-with-icon transition-x">
                      
                    <a class="sidebar-menus-list-item-link nav-link transition-x py-0 text-white" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        {{-- Logout Menu End --}}
    </div>
</div>
