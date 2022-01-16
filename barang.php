<?php require('services/barang.php'); ?>
<?php require('header.php'); ?>
<?php require('sidebar.php'); ?>
<?php

$barang = [];
if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $barang = query("SELECT barang.id, `kode_barang`, pemasok.nama_pemasok, `nama_barang`, `stok`, `satuan`, `harga_barang`
        FROM barang LEFT JOIN pemasok ON barang.id_pemasok = pemasok.id WHERE 
        kode_barang LIKE '%$keyword%' OR 
        nama_barang LIKE '%$keyword%' ");
} else {
    $barang = query("SELECT barang.id, kode_barang, pemasok.nama_pemasok, `nama_barang`, `stok`, `satuan`, `harga_barang`
                    FROM barang LEFT JOIN pemasok ON barang.id_pemasok = pemasok.id");
}

?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Barang</h3>
                        <form method="POST" class="card-tools d-flex align-items-center">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="keyword" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" name="cari" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <a id="print-btn" href="javascript:window.print()" onclick="printPage()" class="btn btn-sm btn-primary ml-2">Print</a>
                            <a id="tambah-btn" href="form_barang.php" class="btn btn-sm btn-primary ml-2">Tambah</a>
                        </form>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Kode</th>
                                    <th>Pemasok</th>
                                    <th>Nama</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($barang as $data) : ?>
                                    <tr title="Click to edit" style="cursor: pointer;" onclick="gotoForm(<?= $data['id'] ?>)">
                                        <td><?= $i; ?></td>
                                        <td><?= $data['kode_barang'] ?></td>
                                        <td><?= $data['nama_pemasok'] ?></td>
                                        <td><?= $data['nama_barang'] ?></td>
                                        <td><?= $data['stok'] ?></td>
                                        <td><?= $data['satuan'] ?></td>
                                        <td><?= $data['harga_barang'] ?></td>
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
    $('a.nav-link[href="barang.php"]').addClass('active')

    function gotoForm(id) {
        window.location.href = 'form_barang.php?id=' + id
    }
</script>