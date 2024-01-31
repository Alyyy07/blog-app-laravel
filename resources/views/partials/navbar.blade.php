<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
      <a class="navbar-brand" href="/">Aly's Blog</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ $active === "home" ? 'active' : '' }}" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $active === "about" ? 'active' : '' }}" href="/about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $active === "blog" ? 'active' : '' }}" href="/blogs">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $active === "categories" ? 'active' : '' }}" href="/categories">Categories</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          @auth
          <li class="nav-item dropdown">
            <a href="/dashboard" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="navbarDropdown"><i class="bi bi-speedometer2"></i> Welcome back, {{ auth()->user()->username }}</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a href="/dashboard" class="dropdown-item"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="/logout" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
            </ul>
            @else
            <li class="nav-item">
              <a href="/login" class="nav-link {{ $active === "login" ? 'active' : '' }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
            </li>
            @endauth
        </ul>
      </div>
    </div>
  </nav>