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
  <a class="nav-link {{ request()->routeIs(['emploes_index','emploes_show']) ? '' : 'collapsed' }}" href="{{ route('emploes_index') }}">
    <i class="bi bi-person-workspace"></i>
    <span>{{ __('menu.emploes') }}</span>
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
  <a class="nav-link {{ request()->routeIs(['report']) ? '' : 'collapsed' }}" href="{{ route('report') }}">
    <i class="bi bi-file-earmark-bar-graph"></i>
    <span>{{ __('menu.reports') }}</span>
  </a>
</li>


<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['chart_lead','chart_child','chart_payment','chart_moliya']) ? '' : 'collapsed' }}" data-bs-target="#chart-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-pie-chart"></i><span>{{ __('menu.charts') }}</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="chart-nav" class="nav-content collapse {{ request()->routeIs(['chart_lead','chart_child','chart_payment','chart_moliya']) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
    <li>
      <a href="{{ route('chart_lead') }}" class="nav-link {{ request()->routeIs(['chart_lead']) ? '' : 'collapsed' }}">
        <i class="bi bi-circle"></i><span>{{ __('menu.chart_lead') }}</span>
      </a>
    </li>
    <li>
      <a href="{{ route('chart_child') }}" class="nav-link {{ request()->routeIs(['chart_child']) ? '' : 'collapsed' }}">
        <i class="bi bi-circle"></i><span>{{ __('menu.chart_child') }}</span>
      </a>
    </li>
    <li>
      <a href="{{ route('chart_payment') }}" class="nav-link {{ request()->routeIs(['chart_payment']) ? '' : 'collapsed' }}">
        <i class="bi bi-circle"></i><span>{{ __('menu.chart_payment') }}</span>
      </a>
    </li>
    <li>
      <a href="{{ route('chart_moliya') }}" class="nav-link {{ request()->routeIs(['chart_moliya']) ? '' : 'collapsed' }}">
        <i class="bi bi-circle"></i><span>{{ __('menu.chart_moliya') }}</span>
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
  </ul>
</li>