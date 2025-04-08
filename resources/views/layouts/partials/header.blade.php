<header class="header" id="header">
    <nav class="navbar navbar-expand navbar-light position-sticky sticky-top" aria-label="">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <button class="btn btn-md shadow-none border-0 float-end sidebar-arrow ms-5">
                    <div class="hamburg-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
                <div class="search-bar-main w-25">
                    <button type="search" class="btn" onclick="">
                            <i class="fa fa-search"></i>
                    </button>
                    <input type="search" id="search-query" class="form-control text-dark" name="search"
                        placeholder="Search here" />
                </div>
 
                <ul class="navbar-nav ms-auto me-5 gap-3">
                    <li class="position-relative nav-item" data-bs-toggle="collapse" href="#multiCollapseExample1"
                        role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                        <a class="nav-link d-flex py-0" href="javascript:void(0)">
                            <span
                                class="text-primary position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                                
                                <span class="">0</span>
                            </span>
                            <i class="fa fa-bell text-danger fs-5"></i>
                        </a>
                        <div class="row position-absolute notification-collapse">
                            <div class="col">
                                <div class="card collapse multi-collapse overflow-hidden" id="multiCollapseExample1">
                                    <div class="bg-primary border-0 w-100 text-white fw-bold text-center py-1 text-sm">
                                        Notifilcation
                                    </div>
                                    <div class="card-body overflow-scroll" style="height:9rem;">
                                        {{ session('notification_admin') }}
                                        
                                    </div>
                                    <div class="bg-primary">
                                        <a href="javascript:void(0)"> <button
                                                class="bg-transparent border-0 w-100 text-white fw-bold py-2">{{ __('buttons.see_all') }}
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex py-0" href="javascript:void(0)"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @php
                                $user = auth()->user();
                            @endphp
                            @if (!empty($user->profile_pic))
                                <img src="{{ asset('uploads/profile/' . $user->profile_pic) }}" alt="auth-profile"
                                    class="img-fluid auth-img rounded-circle border border-white bg-white transition-x" />
                            @else
                                <img src="{{ Vite::asset(DEFAULT_PROFILE_IMAGE) }}" alt="auth-profile"
                                    class="img-fluid auth-img rounded-circle border border-white bg-white transition-x" />
                            @endif
                            <div class="d-none d-md-block">
                                <h5 class="mb-0 text-primary">{{ $user->name ? $user->name : '' }}</h5>
                             </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.update') }}">
                                    <i class="fa-regular fa-user"></i>
                                    <span>{{ __('Profile') }}</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="fa-solid fa-gears"></i>
                                    <span>{{ __('labels.setting') }}</span>
                                </a>
                            </li> -->
                            {{-- <li>
                                <a class="dropdown-item" href="">
                                    <i class="fa-solid fa-key"></i>
                                    <span>{{ __('labels.change_password') }}</span>
                                </a>
                            </li> --}}
                            <li> 
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                                 <i class="fa-solid fa-power-off"></i>
                                                 <span>
                                                    {{ __('Logout') }}
                                                 </span>
                             </a>
 
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

   