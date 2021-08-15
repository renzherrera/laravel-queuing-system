<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
      {{-- <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
        <use xlink:href="assets/brand/coreui.svg#full"></use>
      </svg>
      <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
        <use xlink:href="assets/brand/coreui.svg#signet"></use>
      </svg> --}}
      <h3><strong>QMS</strong></h3>
    </div>
    <ul class="c-sidebar-nav">
      {{-- <li class="c-sidebar-nav-item">
          <a class="c-sidebar-nav-link" href="{{route('home')}}">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-speedometer')}}"></use>
          </svg> Dashboard
          </a>
       </li>

       @if (auth()->user()->counter_id)
       <li class="c-sidebar-nav-title">{{__('BROADCAST')}}</li>

       <li class="c-sidebar-nav-item">
           <a class="c-sidebar-nav-link" href="{{route('admin.calls.create')}}">
           <svg class="c-sidebar-nav-icon">
             <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-bullhorn')}}"></use>
           </svg> Call
           </a>
        </li>
        @endif
      <li class="c-sidebar-nav-title">{{__('Admin')}}</li>
     
       @if (auth()->user()->is_admin)
       <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('admin.queues.index')}}">
        <svg class="c-sidebar-nav-icon">
          <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-list-high-priority')}}"></use>
        </svg> {{__('Queues')}}
        </a>
        </li>

       <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('admin.departments.create')}}">
        <svg class="c-sidebar-nav-icon">
          <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-institution')}}"></use>
        </svg> {{__('Department')}}
        </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('admin.services.index')}}">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-truck')}}"></use>
              </svg> Services
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('admin.counters.index')}}">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-window')}}"></use>
            </svg> Counter
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('admin.users.index')}}">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-wc')}}"></use>
            </svg> Users
            </a>
        </li>
      <li class="c-sidebar-nav-title">{{__('Preferences')}}</li>

      <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('admin.settings.index')}}">
        <svg class="c-sidebar-nav-icon">
          <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-settings')}}"></use>
        </svg>Settings
        </a>
    </li>
    @endif --}}
    <li class="c-sidebar-nav-item"> 
      <a class="c-sidebar-nav-link {{request()->is('/') ? 'c-active' : ''}}" href="{{route('home')}}">
      <svg class="c-sidebar-nav-icon">
        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-speedometer')}}"></use>
      </svg> Dashboard
      </a>
   </li>
   @if (auth()->user()->counter_id)
   <li class="c-sidebar-nav-title">{{__('BROADCAST')}}</li>

   <li class="c-sidebar-nav-item">
       <a class="c-sidebar-nav-link" href="{{route('admin.calls')}}">
       <svg class="c-sidebar-nav-icon">
         <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-bullhorn')}}"></use>
       </svg> Call
       </a>
    </li>
    @endif
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="{{route('admin.counters')}}">
      <svg class="c-sidebar-nav-icon">
        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-window')}}"></use>
      </svg> Counter
      </a>
    </li>
    
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="{{route('admin.departments')}}">
      <svg class="c-sidebar-nav-icon">
        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-institution')}}"></use>
      </svg> {{__('Department')}}
      </a>
    </li>

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('admin.services')}}">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-truck')}}"></use>
          </svg> Services
        </a>
    </li>
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="{{route('admin.users')}}">
      <svg class="c-sidebar-nav-icon">
        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-wc')}}"></use>
      </svg> Users
      </a>
  </li>
  <li class="c-sidebar-nav-title">{{__('Preferences')}}</li>

  <li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{route('admin.settings.index')}}">
    <svg class="c-sidebar-nav-icon">
      <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-settings')}}"></use>
    </svg>Settings
    </a>
</li>

    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
  </div>