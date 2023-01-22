<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                @if (!empty(Auth::guard('admin')->user()->image))
                    <img class="rounded-circle" src="{{ url('assets/admin/img/'.Auth::guard('admin')->user()->image) }}" style="width: 40px; height: 40px;" alt="profile">
                @else
                    <img class="rounded-circle" src="{{ url('assets/admin/img/no-img.png') }}" style="width: 40px; height: 40px;" alt="profile">
                @endif                         
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ Auth::guard('admin')->user()->name }}</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('dashboard') }}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Elements</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="button.html" class="dropdown-item">Buttons</a>
                    <a href="typography.html" class="dropdown-item">Typography</a>
                    <a href="element.html" class="dropdown-item">Other Elements</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#manage" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-tasks me-2"></i>Management</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('authors') }}" class="dropdown-item">Authors</a>
                    <a href="{{ route('categories') }}" class="dropdown-item">Categories</a>
                    <a href="{{ route('books') }}" class="dropdown-item">Books</a>
                    <a href="{{ route('books.download') }}" class="dropdown-item">Books For Downloading</a>
                    <a href="{{ route('banners') }}" class="dropdown-item">Banners</a>
                </div>
            </div>
            <a href="{{ url('admin/orders') }}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Orders</a>
            <a href="{{ url('admin/users') }}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Users</a>

            <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
            <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
            <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
            <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="signin.html" class="dropdown-item">Sign In</a>
                    <a href="signup.html" class="dropdown-item">Sign Up</a>
                    <a href="404.html" class="dropdown-item">404 Error</a>
                    <a href="blank.html" class="dropdown-item">Blank Page</a>
                </div>
            </div>
        </div>
    </nav>
</div>