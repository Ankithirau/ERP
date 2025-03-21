<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href={{ route("dashboard") }}>
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-circle-outline menu-icon"></i>
        <span class="menu-title">UI Elements</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
        </ul>
      </div>
    </li> -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('student') }}">
        <i class="mdi mdi-account menu-icon"></i>
        <span class="menu-title">Student</span>
      </a>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link" href="pages/forms/basic_elements.html">
        <i class="mdi mdi-view-headline menu-icon"></i>
        <span class="menu-title">Form elements</span>
      </a>
    </li> -->
     <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-book-open-variant menu-icon"></i>
        <span class="menu-title">Manage Exams</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route("mark") }}">Marks</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route("co-scholastic") }}">Co-Scholastic Areas</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('result') }}">
        <i class="mdi mdi-file-chart menu-icon"></i>
        <span class="menu-title">Results</span>
      </a>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link" href="pages/tables/basic-table.html">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Tables</span>
      </a>
    </li> -->
    <li class="nav-item">
      <a class="nav-link {{ request()->is('index') ? 'active' : '' }}" data-bs-toggle="collapses" href={{ route('index') }} aria-expanded="false" aria-controls="auth">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">Manage User</span>
        <i class="menu-arrow d-none"></i>
      </a>
      <div class="collapse d-none" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href={{ route('index') }}> Users </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> User's Change Password </a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('receipts.index') }}">
        <i class="mdi mdi-file-pdf menu-icon"></i>
        <span class="menu-title">Generate PDF</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="mdi mdi-logout-variant menu-icon"></i>
        <span class="menu-title">Logout</span>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="mdi mdi-account menu-icon"></i>
        <span class="menu-title">User Pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="documentation/documentation.html">
        <i class="mdi mdi-file-document-box-outline menu-icon"></i>
        <span class="menu-title">Documentation</span>
      </a>
    </li> -->
  </ul>
</nav>
