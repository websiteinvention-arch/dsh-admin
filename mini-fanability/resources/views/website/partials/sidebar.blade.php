  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Website Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Ramzan Developer</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <li class="nav-item menu-open">
            <a href="{{route('website.settings')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
           
          </li>

          <li class="nav-item">
    <a href="{{ url('/laravel-filemanager?type=Files') }}"
       class="nav-link"
       target="_blank">

        <i class="nav-icon fas fa-folder"></i>

        <p>
            File Manager
        </p>

    </a>
</li>

 <li class="nav-item">
            <a href="{{ route('website.pages') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Pages
                
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{route('website.code-snippets')}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Code Blocks</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('website.entities') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Entities
                
              </p>
            </a>
           
          </li>

          <li class="nav-item">


    <ul class="nav ">

        @foreach($sidebarEntities as $entity)

            <li class="nav-item">

                <a href="{{ route('website.entity-records', $entity->id) }}"
                   class="nav-link">

                    <i class="far fa-circle nav-icon"></i>

                    <p>{{ $entity->name }}</p>

                </a>

            </li>

        @endforeach

    </ul>

</li>
      
         

          <li class="nav-item">
    <a href="{{ route('website.preview', ['websiteId' => Session::get('website_id'), 'slug' => 'home']) }}"
       class="nav-link"
       target="_blank">
        <i class="nav-icon fas fa-eye"></i>
        <p>Preview Site</p>
    </a>
</li>



        
          
          <li class="nav-item">
              <form action="{{ route('website.logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="nav-link btn btn-link" style="width:100%; text-align:left; color: white">
                      <i class="nav-icon fas fa-sign-out-alt"></i>
                      <p style="display:inline;">Logout</p>
                  </button>
              </form>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li>
          
          <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="iframe.html" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Tabbed IFrame Plugin</p>
            </a>
          </li>
          
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>