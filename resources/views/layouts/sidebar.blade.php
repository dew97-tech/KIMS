@push('plugin-styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/solid.min.css">
@endpush
@push('header-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/solid.min.js" type="text/javascript"></script>
@endpush

<div class="c-sidebar-brand">
    <a href="{{ route('home') }}">
        <img class="c-sidebar-brand-full" src="{{ asset('assets/img/kandari_logo.png') }}" height="70"
            alt="Augmenta Logo">
    </a>
    <a href="{{ route('home') }}">
        <img class="c-sidebar-brand-minimized" src="{{ asset('assets/img/kandari_logo.png') }}"
            href="{{ route('home') }}" height="70" alt="Augmenta Logo">
    </a>
</div>
<ul class="c-sidebar-nav my-2">
    {{-- <li class="c-sidebar-nav-item">
        @role('admin')
        <a class="c-sidebar-nav-link" href="{{ route('users.index') }}">
    <i class="c-sidebar-nav-icon fas fa-user"></i>
    Users
    </a>
    @endrole
    </li> --}}
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('products.index') }}">
            <i class="c-sidebar-nav-icon fas fa-box"></i>
            Products
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('categories.index') }}">
            <i class="c-sidebar-nav-icon fas fa-tags"></i>
            Categories
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('brands.index') }}">
            <i class="c-sidebar-nav-icon fas fa-certificate"></i>
            Brands
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('units.index') }}">
            <i class="c-sidebar-nav-icon fas fa-weight-hanging"></i>
            Units
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('suppliers.index') }}">
            <i class="c-sidebar-nav-icon fas fa-parachute-box"></i>
            Suppliers
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('stocks.index') }}">
            <i class="c-sidebar-nav-icon fas fa-cubes"></i>
            Stocks
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('purchases.index') }}">
            <i class="c-sidebar-nav-icon fas fa-shopping-cart"></i>
            Purchases
        </a>
    </li>
</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
    data-class="c-sidebar-minimized">
</button>
</div>
