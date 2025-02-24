<style>
    /* Sidebar Styling */
    .sidebar {
        width: 250px;
        background-color: #1f2937; /* Warna latar belakang sidebar */
        color: white;
        height: 100vh;
        position: fixed;
        padding-top: 1rem;
        transition: width 0.3s ease-in-out;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
    }

    .sidebar-header {
        text-align: center;
        font-size: 1.5rem;
        font-weight: bold;
        padding-bottom: 1rem;
        border-bottom: 1px solid #374151;
    }

    .sidebar ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .sidebar li {
        margin: 0;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        color: white;
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 5px;
        transition: all 0.3s ease-in-out;
        font-size: 1rem;
    }

    .sidebar a i {
        margin-right: 10px;
        font-size: 1.2rem;
    }

    .sidebar a:hover {
        background-color: #374151; /* Warna saat hover */
        transform: translateX(5px);
    }

    .sidebar a.active {
        background-color: #4a5568; /* Warna item aktif */
        font-weight: bold;
    }

    /* Icon Customization */
    .nav-icon {
        width: 20px;
        height: 20px;
    }

</style>

<nav class="sidebar">
    <div class="sidebar-header">Stockify</div>
    <ul>
        <li><a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.index') ? 'active' : '' }}"><i class="fas fa-box"></i> Produk</a></li>
        <li><a href="{{ route('suppliers.index') }}" class="{{ request()->routeIs('suppliers.index') ? 'active' : '' }}"><i class="fas fa-truck"></i> Supplier</a></li>
        <li><a href="{{ route('stock_transactions.index') }}" class="{{ request()->routeIs('stock_transactions.index') ? 'active' : '' }}"><i class="fas fa-exchange-alt"></i> Transaksi</a></li>
        <li><a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index') ? 'active' : '' }}"><i class="fas fa-users"></i> Pengguna</a></li>
        <li><a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.index') ? 'active' : '' }}"><i class="fas fa-tags"></i> Kategori</a></li>
        <li><a href="{{ route('product_attributes.index') }}" class="{{ request()->routeIs('product_attributes.index') ? 'active' : '' }}"><i class="fas fa-cogs"></i> Atribut Produk</a></li>
    </ul>
</nav>

<!-- Font Awesome untuk ikon -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
