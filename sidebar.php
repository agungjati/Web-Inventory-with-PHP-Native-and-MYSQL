    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="index3.html" class="brand-link">
            <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
            <span class="brand-text font-weight-light text-center d-block"><i class="nav-icon fas fa-boxes"></i> Inventory</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="foto/<?= $_SESSION["foto"] ?>" class="img-circle elevation-2" style="width: 40px; height: 40px;" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= $_SESSION["full_name"]; ?></a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="barang.php" class="nav-link">
                            <i class="nav-icon fas fa-dolly-flatbed"></i>
                            <p>Barang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pemasok.php" class="nav-link">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>Pemasok</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="user.php" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="customer.php" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Customer</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="transaksi-penjualan.php" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>Transaksi Penjualan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="transaksi-pembelian.php" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice-dollar"></i>
                            <p>Transaksi Pembelian</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>