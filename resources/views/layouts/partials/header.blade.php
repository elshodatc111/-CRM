<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center list-unstyled mb-0">
        <!--
        <li class="nav-item dropdown">
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-bell"></i>
                <span class="badge bg-primary badge-number">1</span>
            </a>
        </li>
        -->
        <li class="nav-item">
            <a class="nav-link nav-icon" href="#">
                <i class="bi bi-cake2"></i>
                @if($birthdayCount > 0)
                    <span class="badge bg-success badge-number">{{ $birthdayCount }}</span>
                @endif
            </a>
        </li>
          
        <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-icon d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-translate text-primary"></i>
                <span class="ps-1 small text-uppercase">{{ app()->getLocale() }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a class="dropdown-item d-flex align-items-center" 
                           rel="alternate" 
                           hreflang="{{ $localeCode }}" 
                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            <span class="{{ app()->getLocale() == $localeCode ? 'fw-bold text-primary' : '' }}">
                                {{ $properties['native'] }}
                            </span>
                            @if(app()->getLocale() == $localeCode) 
                                <i class="bi bi-check ms-auto text-success"></i> 
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>

        <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle fs-4 text-secondary"></i>
                <span class="d-none d-md-block dropdown-toggle ps-2 fw-bold text-dark">
                    {{-- 'type' o'rniga 'role' ishlatildi --}}
                    {{ Str::upper(Auth::user()->role ?? 'User') }}
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile shadow mt-3 border-0">
                <li class="dropdown-header text-center p-3">
                    <h6 class="mb-1 text-dark">{{ Auth::user()->name }}</h6>
                    <small class="text-muted">{{ Auth::user()->phone }}</small>
                    <div class="badge bg-light text-primary border mt-2">{{ Auth::user()->role }}</div>
                </li>
                <li><hr class="dropdown-divider m-0"></li>
                
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2" href="#">
                        <i class="bi bi-person-vcard me-2 text-primary"></i>
                        <span>{{ __('header.my_profile') }}</span>
                    </a>
                </li>
                <li><hr class="dropdown-divider m-0"></li>
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2 text-danger" href="#" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        <span>{{ __('header.sign_out') }}</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li> 

    </ul>
</nav>