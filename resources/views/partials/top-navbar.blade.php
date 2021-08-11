<div class="c-wrapper c-fixed-components">
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
      <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
        <svg class="c-icon c-icon-lg">
          <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-menu')}}"></use>
        </svg>
      </button><a class="c-header-brand d-lg-none" href="#">
        <svg width="118" height="46" alt="CoreUI Logo">
          <use xlink:href="assets/brand/coreui.svg#full"></use>
        </svg></a>
      <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
        <svg class="c-icon c-icon-lg">
          <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-menu')}}"></use>
        </svg>
      </button>
    
      <ul class="c-header-nav ml-auto mr-4">
       
        
        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <svg class="c-icon">
                    <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-media-play')}}"></use>
                </svg>
            </a>
          <div class="dropdown-menu dropdown-menu-right pt-0">
          
            <div class="dropdown-header bg-light py-2"><strong>Display on Screen</strong></div>
                <a class="dropdown-item" href="{{route('admin.displays.departments')}}"  target="_blank">
                <svg class="c-icon mr-2">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                </svg> Users View
                </a>
                <a class="dropdown-item" href="{{route('admin.queues-called.index')}}"  target="_blank">
                  <svg class="c-icon mr-2">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                  </svg> Display Queue
                  </a>
           

          </div>
        </li>
        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <div class="c-avatar-img">{{auth()->user()->email}}
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right pt-0">
          
            {{-- <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div>
            <a class="dropdown-item" href="#">
              <svg class="c-icon mr-2">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
              </svg> Profile
            </a> --}}
            <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
              <svg class="c-icon mr-2">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
              </svg> {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>

          </div>
        </li>
      </ul>
    </header>

    