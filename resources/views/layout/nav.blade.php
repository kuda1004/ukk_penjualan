<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="#">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('breadcrumb', 'Dashboard')</li>
      </ol>
      <h6 class="font-weight-bolder mb-0">@yield('page_title', 'Dashboard')</h6>
    </nav>
    <ul class="navbar-nav justify-content-end">
      <li class="nav-item">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        <a href="#" onclick="event.preventDefault(); confirmLogout();">
          Logout
        </a>
      </li>
    </ul>
  </div>
</nav>

<script>
  function confirmLogout() {
    if (confirm("Are you sure you want to log out?")) {
      document.getElementById('logout-form').submit();
    }
  }
</script>
