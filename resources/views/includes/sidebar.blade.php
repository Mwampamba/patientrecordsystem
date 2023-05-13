@php
  $current_route = request()->route()->getName();
@endphp
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar"> 
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link {{ $current_route == 'dashboard'?'active':''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  Dashboard
              </p>
          </a>
        </li> 
        @role('admin') 
        <li class="nav-item">
          <a href="{{ route('staffs') }}" class="nav-link {{ $current_route == 'staffs'?'active':''}}">
            <i class="nav-icon fas fa-user"></i>
            <p>Staffs</p>
          </a>
        </li>
        @endrole
        @role(['admin','receptionist']) 
        <li class="nav-item">
          <a href="{{ route('patients') }}" class="nav-link {{ $current_route == 'patients'?'active':''}}">
            <i class="fa-fw fas fa-users nav-icon"></i>
            <p>Patients</p>
          </a>
        </li> 
        @endrole 
        @role(['admin', 'doctor', 'pharmacist']) 
        <li class="nav-item">
          <a href="{{ route('prescriptions') }}" class="nav-link {{ $current_route == 'prescriptions'?'active':''}}">
            <i class="nav-icon fa fa-copy"></i>
            <p>Prescriptions</p>
          </a>
        </li> 
        @endrole 
        @role('admin')
        <li class="nav-item">
          <a href="{{ route('roles') }}" class="nav-link {{ $current_route == 'roles'?'active':''}}">
            <i class="fa-fw fas fa-briefcase nav-icon"></i>
            <p>Roles</p>
          </a>
        </li> 
        @endrole
        <li class="nav-item">
            <a href="{{ route('staffLogout')}}" class="nav-link {{ $current_route == 'staffLogout'?'active':''}}">
              <i class="nav-icon fa fa-power-off"></i>
              <p>Sign out</p>
            </a>
        </li>
      </nav>
    </div>
  </aside>
