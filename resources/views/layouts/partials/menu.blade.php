<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['home']) ? '' : 'collapsed' }}" href="{{ route('home') }}">
    <i class="bi bi-grid"></i>
    <span>{{ __('menu.home') }}</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['child_index','child_show']) ? '' : 'collapsed' }}" href="{{ route('child_index') }}">
    <i class="bi bi-person-badge"></i>
    <span>{{ __('menu.child') }}</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['childLead_index','childLead_show']) ? '' : 'collapsed' }}" href="{{ route('childLead_index') }}">
    <i class="bi bi-person-plus"></i>
    <span>{{ __('menu.childLead') }}</span> 
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['groups_index','groups_show']) ? '' : 'collapsed' }}" href="{{ route('groups_index') }}">
    <i class="bi bi-people"></i>
    <span>{{ __('menu.groups') }}</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['groups_davomad','groups_davomad_show']) ? '' : 'collapsed' }}" href="{{ route('groups_davomad') }}">
    <i class="bi bi-calendar-check"></i>
    <span>{{ __('menu.group_davomad') }}</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['emploes_index','emploes_show']) ? '' : 'collapsed' }}" href="{{ route('emploes_index') }}">
    <i class="bi bi-person-workspace"></i>
    <span>{{ __('menu.emploes') }}</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['emploes_indexww','emploes_showww']) ? '' : 'collapsed' }}" href="#">
    <i class="bi bi-clipboard-check"></i>
    <span>{{ __('menu.emploes_davomad') }}</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['emploesLead_index','emploesLead_show']) ? '' : 'collapsed' }}" href="{{ route('emploesLead_index') }}">
    <i class="bi bi-person-plus-fill"></i>
    <span>{{ __('menu.emploesLead') }}</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['kassa_index']) ? '' : 'collapsed' }}" href="{{ route('kassa_index') }}">
    <i class="bi bi-cash-stack"></i>
    <span>{{ __('menu.kassa') }}</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['moliya_index']) ? '' : 'collapsed' }}" href="{{ route('moliya_index') }}">
    <i class="bi bi-bank"></i>
    <span>{{ __('menu.moliya') }}</span>
  </a>
</li>


<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['reports','report01','report02']) ? '' : 'collapsed' }}" data-bs-target="#reports-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-file-earmark-bar-graph"></i><span>{{ __('menu.reports') }}</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="reports-nav" class="nav-content collapse {{ request()->routeIs(['reports']) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
    <li>
      <a href="#" class="nav-link {{ request()->routeIs(['report01']) ? '' : 'collapsed' }}">
        <i class="bi bi-circle"></i><span>{{ __('menu.report01') }}</span>
      </a>
    </li>
    <li>
      <a href="#" class="nav-link {{ request()->routeIs(['report2']) ? '' : 'collapsed' }}">
        <i class="bi bi-circle"></i><span>{{ __('menu.report2') }}</span>
      </a>
    </li>
  </ul>
</li>


<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['charts','charts01','charts02']) ? '' : 'collapsed' }}" data-bs-target="#chart-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-pie-chart"></i><span>{{ __('menu.charts') }}</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="chart-nav" class="nav-content collapse {{ request()->routeIs(['charts','charts01','charts02']) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
    <li>
      <a href="#" class="nav-link {{ request()->routeIs(['charts01']) ? '' : 'collapsed' }}">
        <i class="bi bi-circle"></i><span>{{ __('menu.charts01') }}</span>
      </a>
    </li>
    <li>
      <a href="#" class="nav-link {{ request()->routeIs(['charts02']) ? '' : 'collapsed' }}">
        <i class="bi bi-circle"></i><span>{{ __('menu.charts02') }}</span>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['setting_salary']) ? '' : 'collapsed' }}" data-bs-target="#setting-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-gear"></i><span>{{ __('menu.setting') }}</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="setting-nav" class="nav-content collapse {{ request()->routeIs(['setting_salary']) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
    <li>
      <a href="{{ route('setting_salary') }}" class="nav-link {{ request()->routeIs(['setting_salary']) ? '' : 'collapsed' }}">
        <i class="bi bi-circle"></i><span>{{ __('menu.salary') }}</span>
      </a>
    </li>
    <li>
      <a href="#" class="nav-link {{ request()->routeIs(['setting01']) ? '' : 'collapsed' }}">
        <i class="bi bi-circle"></i><span>{{ __('menu.setting01') }}</span>
      </a>
    </li>
  </ul>
</li>