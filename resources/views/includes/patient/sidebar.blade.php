@php
  $current_route = request()->route()->getName();
@endphp 
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar"> 
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('patientProfile') }}" class="nav-link {{ $current_route == 'patientProfile'?'active':''}}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Dashboard
                </p>
            </a>
          </li> 
            <li class="nav-item">
              <a href="{{ route('getPatientRecords') }}" class="nav-link {{ $current_route == 'getPatientRecords'?'active':''}}">
                <i class="nav-icon fas fa-book"></i>
                <p>Medical records</p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ route('patientProfile') }}" class="nav-link {{ $current_route == ''?'active':''}}">
                <i class="nav-icon fas fa-user"></i>
                <p>Profile details</p>
              </a>
            </li> 
              
            <li class="nav-item">
              <a href="{{ route('patientProfile') }}" class="nav-link {{ $current_route == ''?'active':''}}">
                <i class="fa-fw fas fa-key nav-icon"></i>
                <p>Change password</p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ route('patientLogout') }}" class="nav-link {{ $current_route == 'patientLogout'?'active':''}}">
                <i class="nav-icon fas fa-power-off"></i>
                <p>Sign out</p>
              </a>
            </li>
        </ul>
      </nav>
    </div>
</aside>
