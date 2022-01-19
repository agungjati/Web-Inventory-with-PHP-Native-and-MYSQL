<?php require('services/transaksi-penjualan.php'); ?>
<?php require('header.php'); ?>
<?php require('sidebar.php'); ?>
<?php

$transaksi = [];
if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $transaksi = query("SELECT transaksi_penjualan.id, transaksi_penjualan.no_faktur, name_customer, transaksi_penjualan.kode_barang, transaksi_penjualan.tgl_transaksi, barang.nama_barang, jumlah_jual, jumlah_harga
        FROM transaksi_penjualan 
        LEFT JOIN barang ON barang.kode_barang = transaksi_penjualan.kode_barang 
        LEFT JOIN customers ON customers.id = transaksi_penjualan.customer_id WHERE 
        transaksi_penjualan.kode_barang LIKE '%$keyword%' OR 
        barang.nama_barang LIKE '%$keyword%' ");
} else {
    $transaksi = query("SELECT transaksi_penjualan.id, transaksi_penjualan.no_faktur, name_customer, transaksi_penjualan.tgl_transaksi, transaksi_penjualan.kode_barang, barang.nama_barang, jumlah_jual, jumlah_harga
                    FROM transaksi_penjualan 
                    LEFT JOIN barang ON barang.kode_barang = transaksi_penjualan.kode_barang
                    LEFT JOIN customers ON customers.id = transaksi_penjualan.customer_id");
}

if (isset($_GET['hapus'])) {
    $count = hapus($_GET['id']);

    if ($count > 0) {
        echo "<script>
				alert('Data Berhasil dihapus.')
				document.location.href = 'transaksi-penjualan.php'
			</script>
			";
    } else {
        echo ("<script>
				alert('Data Gagal dihapus.')
				document.location.href = 'transaksi-penjualan.php'
			</script>
			");
    }
}

?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Penjualan</h3>
                        <form method="POST" class="card-tools d-flex align-items-center">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="keyword" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" name="cari" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <a href="javascript:window.print()" onclick="printPage()" class="btn btn-sm btn-primary ml-2">Print</a>
                            <a href="form_transaksi-penjualan.php" class="btn btn-sm btn-primary ml-2">Tambah</a>
                        </form>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>No. Faktur</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Nama Customer</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($transaksi as $data) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $data['no_faktur'] ?></td>
                                        <td><?= $data['kode_barang'] ?></td>
                                        <td><?= $data['nama_barang'] ?></td>
                                        <td><?= $data['name_customer'] ?></td>
                                        <td><?= $data['tgl_transaksi'] ?></td>
                                        <td><?= $data['jumlah_jual'] ?></td>
                                        <td><?= $data['jumlah_harga'] ?></td>
                                        <td><a href="?hapus=&id=<?= $data['id'] ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>

<script>
    $('a.nav-link[href="transaksi-penjualan.php"]').addClass('active')
</script>