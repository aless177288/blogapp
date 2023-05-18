<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <li class="nav-item menu-open">
        <a href="{{route('dashboard')}}" class="nav-link {{ request()->is('admin') ? 'active': ''}}">
          <i class="nav-icon fa fa-home"></i>
          <p>
           Inicio
            <i class="right fa fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('admin.posts.index')}}" class="nav-link {{ request()->is('admin/posts') ? 'active': ''}}">
              <i class="far fa-eye nav-icon"></i>
              <p>Ver Todos Los Post</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.posts.create') }}"  class="nav-link {{ request()->is('admin/posts/create') ? 'active': ''}}">
              <i class="far fa-pencil nav-icon"></i>
              <p>Crear un Post</p>
            </a>
          </li>

      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-eye"></i>
          <p>
            Blog
            <span class="right badge badge-danger">New</span>
          </p>
        </a>
      </li>
    </ul>
  </nav>