<?php require('services/barang.php'); ?>
<?php require('header.php'); ?>
<?php require('sidebar.php'); ?>
<?php

$pemasok = query('SELECT id, nama_pemasok FROM pemasok');
if (isset($_GET['id'])) {
    $barang = query('SELECT * FROM barang WHERE id="' . $_GET['id'] . '"')[0];
} else {
    $barang = array(
        "id" => '',
        "kode_barang" => '',
        "id_pemasok" => '',
        "nama_barang" => '',
        "stok" => '',
        "satuan" => '',
        "harga_barang" => ''
    );
}
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-2">
                <form method="POST" class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">Barang</h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= $barang['id']; ?>" />
                        <div class="form-group">
                            <label for="kode_barang">Kode Barang</label>
                            <input type="text" class="form-control" name="kode_barang" value="<?= $barang['kode_barang']; ?>" id="kode_barang" placeholder="Enter code item">
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" value="<?= $barang['nama_barang']; ?>" id="nama_barang" placeholder="Enter name item">
                        </div>
                        <div class="form-group">
                            <label>Pemasok</label>
                            <select class="form-control" name="id_pemasok" value="<?= $barang['id_pemasok']; ?>">
                                <?php foreach ($pemasok as $_pemasok) : ?>
                                    <option <?= $_pemasok['id'] == $barang['id_pemasok'] ? 'selected' : ''; ?> value="<?= $_pemasok['id'] ?>">
                                        <?= $_pemasok['nama_pemasok'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" class="form-control" name="stok" id="stok" value="<?= $barang['stok']; ?>" placeholder="Enter quantity item">
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan Barang</label>
                            <input type="text" class="form-control" name="satuan" id="satuan" value="<?= $barang['satuan']; ?>" placeholder="Enter unit item">
                        </div>
                        <div class="form-group">
                            <label for="harga_barang">Harga Barang</label>
                            <input type="number" class="form-control" name="harga_barang" value="<?= $barang['harga_barang']; ?>" id="harga_barang" placeholder="Enter price item">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="simpan">SIMPAN</button>
                        <?php
                        if (isset($_GET['id'])) {
                            echo '<button type="submit" class="btn btn-danger" name="hapus">HAPUS</button>';
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require('footer.php'); ?>

<script>
    $('a.nav-link[href="barang.php"]').addClass('active')
</script>

<?php
if (isset($_POST['simpan'])) {
    if (isset($_GET['id'])) {
        $count = edit($_POST);
    } else {
        $count = tambah($_POST);
    }

    if ($count > 0) {
        echo "<script>
				alert('Data Berhasil disimpan.')
				document.location.href = 'barang.php'
			</script>
			";
    } else {
        echo ("<script>
				alert('Data Gagal disimoan.')
				document.location.href = 'form_barang.php'
			</script>
			");
    }
} elseif (isset($_POST['hapus'])) {
    $count = hapus($_POST['id']);

    if ($count > 0) {
        echo "<script>
				alert('Data Berhasil dihapus.')
				document.location.href = 'barang.php'
			</script>
			";
    } else {
        echo ("<script>
				alert('Data Gagal dihapus.')
				document.location.href = 'form_barang.php'
			</script>
			");
    }
}

?>