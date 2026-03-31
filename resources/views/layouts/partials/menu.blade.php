<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['emploes_index','emploes_show']) ? '' : 'collapsed' }}" href="{{ route('emploes_index') }}">
    <i class="bi bi-house-heart"></i>
    <span>{{ __('menu.emploes') }}</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['home']) ? '' : 'collapsed' }}" href="">
    <i class="bi bi-house-heart"></i>
    <span>{{ __('menu.dashboard') }}</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['emploes_davomad','kid_davomad_show_all_groups','kid_davomad_show']) ? '' : 'collapsed' }}" data-bs-target="#davomad-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-calendar2-check"></i><span>{{ __('menu.attendance') }}</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="davomad-nav" class="nav-content collapse {{ request()->routeIs(['emploes_davomad','kid_davomad_show','kid_davomad_show_all_groups']) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
    <li>
      <a href="#" class="nav-link {{ request()->routeIs(['emploes_davomad']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.staff_attendance') }}</span>
      </a>
    </li>
    <li>
      <a href="#" class="nav-link {{ request()->routeIs(['kid_davomad_show_all_groups','kid_davomad_show']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.child_attendance') }}</span>
      </a>
    </li>
  </ul>
</li>
