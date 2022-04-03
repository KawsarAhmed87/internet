@php $admin = Auth::guard()->user(); @endphp
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-copy"></i>
          <p>
            Admin Elements
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">6</span>
          </p>
        </a>
        <ul class="nav nav-treeview">
        @if ($admin->can('user.create') || $admin->can('user.view') ||  $admin->can('user.edit') ||  $admin->can('user.delete'))
          <li class="nav-item">
            <a href="{{route('user.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>User</p>
            </a>
          </li>
          @endif
          @if ($admin->can('role.create') || $admin->can('role.view') ||  $admin->can('role.edit') ||  $admin->can('role.delete'))
          <li class="nav-item">
            <a href="{{route('role.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Role</p>
            </a>
          </li>    
          @endif
        </ul>
      </li>

      @if ($admin->can('subscriber.create') || $admin->can('subscriber.view') ||  $admin->can('subscriber.edit') ||  $admin->can('subscriber.delete'))
      <li class="nav-item">
        <a href="{{route('subscriber.index')}}" class="nav-link">
          <i class="nav-icon fas fa-file"></i>
          <p>Subscriber</p>
        </a>
      </li>
      @endif

      @if ($admin->can('product.create') || $admin->can('product.view') ||  $admin->can('product.edit') ||  $admin->can('product.delete'))
      <li class="nav-item">
        <a href="{{route('product.index')}}" class="nav-link">
          <i class="nav-icon fas fa-file"></i>
          <p>Product</p>
        </a>
      </li>
      @endif

      @if ($admin->can('connection.create') || $admin->can('connection.view') ||  $admin->can('connection.edit') ||  $admin->can('connection.delete'))
      <li class="nav-item">
        <a href="{{route('connection.index')}}" class="nav-link">
          <i class="nav-icon fas fa-file"></i>
          <p>Connection</p>
        </a>
      </li>
      @endif

      @if ($admin->can('accounting.create') || $admin->can('accounting.view') ||  $admin->can('accounting.edit') ||  $admin->can('accounting.delete'))
      <li class="nav-item">
        <a href="{{route('item-account.index')}}" class="nav-link">
          <i class="nav-icon fas fa-file"></i>
          <p>Item Account</p>
        </a>
      </li>
      @endif

      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
          <i class="fas fa-circle nav-icon text-danger"></i>
          <p>Logout</p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
       </form>
      </li>
    </ul>
  </nav>


