@php    $link = $_SERVER['REQUEST_URI']; @endphp
@php    $link_array = explode('/',$link); @endphp
@php    $page = end($link_array); @endphp
<style>
.user-dp {
    width: 100%;
    cursor: pointer;
}
.user-dp .info {
    vertical-align: middle;
}
.user-panel ul.dp-mn {
    width: 100%;
    clear: both;
    display: none;
    margin-top: 15px;
    border-top: 1px solid #4f5962;
}
.user-panel ul.dp-mn .far, .user-panel ul.dp-mn p {
    display: inline-block;
    margin-right: 7px;
    margin-bottom: 0;
}
nav.mt-2 {
    font-size: 14px;
}
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="javascript:;" class="brand-link">
    <img src="{{ asset('/backend/dist/img/AdminLTELogo1.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Pergola Dashboard</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3">
    <div class="user-dp">
      <div class="image">
        <img src="{{ asset('/backend/dist/img/Satirtha.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="javascript: ;" class="d-block">Super Admin</a>
        
      </div>
      
        
      </div>
      <ul class="nav nav-treeview dp-mn">
            <li class="nav-item">
              <a href="{{ route('admin.changePassword') }}"  class="nav-link @if($page == 'change-password') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Change Password</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Logout</p>
              </a>
            </li>
        </ul>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
          <a href="{{ route('admin.dashboard') }}" class="nav-link @if($page == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>


        <!-- master view -->

        <li class="nav-item has-treeview">
          <a href="javascript: ;" class="nav-link @if($page == 'add-posts' || $page == 'master-height' || $page == 'master-width') active @endif">
            <i class="nav-icon fas fa-edit"></i>
            <p>
            Master Panel
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
              <a href="{{ route('admin.add-posts') }}" class="nav-link @if($page == 'add-posts') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>View Master Posts</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.master-height') }}" class="nav-link @if($page == 'master-height') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>View Master Heights</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.master-width') }}" class="nav-link @if($page == 'master-width') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>View Master Widths</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.master-overhead-shades-show') }}" class="nav-link @if($page == 'master-overhead-shades') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>View Master Overhead Shades</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.master-post-length-show') }}" class="nav-link @if($page == 'master-post-length') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>View Master Post Lengths</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.master-wood') }}" class="nav-link @if($page == 'master-wood') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>View Master Wood</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- master view -->
       
        <li class="nav-item has-treeview">
          <a href="javascript: ;" class="nav-link @if($page == 'pick-a-footprint' || $page == 'view-pick-a-footprint') active @endif">
            <i class="nav-icon fas fa-edit"></i>
            <p>
            Pick a Footprint
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.view-pick-a-footprint') }}" class="nav-link @if($page == 'view-pick-a-footprint') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>View Outside Post to Post</p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item has-treeview">
          <a href="javascript: ;" class="nav-link @if($page == 'add-pick-overhead-shades') active @endif">
            <i class="nav-icon fas fa-edit"></i>
            <p>
            Pick Overhead Shades
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.add-pick-overhead-shades') }}" class="nav-link @if($page == 'add-pick-overhead-shades') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>View Pick Overhead Shades</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="javascript: ;" class="nav-link @if($page == 'panel-for-3D-view') active @endif">
            <i class="nav-icon fas fa-edit"></i>
            <p>
            3D View Panel
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.panel-for-3d-view') }}" class="nav-link @if($page == 'panel-for-3D-view') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>View 3D Panel</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="javascript: ;" class="nav-link @if($page == 'add-pick-post-length') active @endif">
            <i class="nav-icon fas fa-edit"></i>
            <p>
            Pick Post Length
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.add-pick-post-length') }}" class="nav-link @if($page == 'add-pick-post-length') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>View Pick Post Length</p>
              </a>
            </li>
          </ul>
        </li>

        <!--<li class="nav-item has-treeview">-->
        <!--  <a href="javascript: ;" class="nav-link @if($page == 'add-pick-post-slap') active @endif">-->
        <!--    <i class="nav-icon fas fa-edit"></i>-->
        <!--    <p>-->
        <!--    Pick Post Slap-->
        <!--      <i class="fas fa-angle-left right"></i>-->
        <!--    </p>-->
        <!--  </a>-->
        <!--  <ul class="nav nav-treeview">-->
        <!--    <li class="nav-item">-->
        <!--      <a href="{{ route('admin.add-pick-post-slap') }}" class="nav-link @if($page == 'add-pick-post-slap') active @endif">-->
        <!--        <i class="far fa-circle nav-icon"></i>-->
        <!--        <p>View Pick Post Slap</p>-->
        <!--      </a>-->
        <!--    </li>-->
        <!--  </ul>-->
        <!--</li>-->

        <!--<li class="nav-item has-treeview">-->
        <!--  <a href="javascript: ;" class="nav-link @if($page == 'add-pick-canopy') active @endif">-->
        <!--    <i class="nav-icon fas fa-edit"></i>-->
        <!--    <p>-->
        <!--    Pick Retactable Canopy-->
        <!--      <i class="fas fa-angle-left right"></i>-->
        <!--    </p>-->
        <!--  </a>-->
        <!--  <ul class="nav nav-treeview">-->
        <!--    <li class="nav-item">-->
        <!--      <a href="{{ route('admin.add-pick-canopy') }}" class="nav-link @if($page == 'add-pick-canopy') active @endif">-->
        <!--        <i class="far fa-circle nav-icon"></i>-->
        <!--        <p>View Pick Retactable Canopy</p>-->
        <!--      </a>-->
        <!--    </li>-->
        <!--  </ul>-->
        <!--</li>-->

        <!--<li class="nav-item has-treeview">-->
        <!--  <a href="javascript: ;" class="nav-link @if($page == 'add-pick-panel') active @endif">-->
        <!--    <i class="nav-icon fas fa-edit"></i>-->
        <!--    <p>-->
        <!--    Pick Louvered Panel-->
        <!--      <i class="fas fa-angle-left right"></i>-->
        <!--    </p>-->
        <!--  </a>-->
        <!--  <ul class="nav nav-treeview">-->
        <!--    <li class="nav-item">-->
        <!--      <a href="{{ route('admin.add-pick-panel') }}" class="nav-link @if($page == 'add-pick-panel') active @endif">-->
        <!--        <i class="far fa-circle nav-icon"></i>-->
        <!--        <p>View Pick Louvered Panel</p>-->
        <!--      </a>-->
        <!--    </li>-->
        <!--  </ul>-->
        <!--</li>-->

        <li class="nav-item has-treeview">
          <a href="javascript: ;" class="nav-link @if($page == 'combination-panel') active @endif">
            <i class="nav-icon fas fa-edit"></i>
            <p>
            Combination Panel
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.combination-panel') }}" class="nav-link @if($page == 'combination-panel') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>View Combination Panel</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="javascript: ;" class="nav-link @if($page == 'add-final-product') active @endif">
            <i class="nav-icon fas fa-edit"></i>
            <p>
            Final Product Image
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.add-final-product') }}" class="nav-link @if($page == 'add-final-product') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>View Final Product Image</p>
              </a>
            </li>
          </ul>
        </li>
        
        <li class="nav-item has-treeview">
          <a href="javascript: ;" class="nav-link @if($page == 'order-details') active @endif">
            <i class="nav-icon fas fa-edit"></i>
            <p>
            Payment State
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.order-details') }}" class="nav-link @if($page == 'order-details') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>View Payment State</p>
              </a>
            </li>
          </ul>
        </li>
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->

  <!-- logout functions -->
  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
  <!-- end of logout function -->
</aside>
    