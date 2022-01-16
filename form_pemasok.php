<?php require('services/pemasok.php'); ?>
<?php require('header.php'); ?>
<?php require('sidebar.php'); ?>
<?php
if (isset($_GET['id'])) {
    $pemasok = query('SELECT * FROM pemasok WHERE id="' . $_GET['id'] . '"')[0];
} else {
    $pemasok = array(
        "id" => '',
        "nama_pemasok" => '',
        "alamat_pemasok" => '',
        "no_telpon_pemasok" => '',
    );
}
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-2">
                <form method="POST" class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">Pemasok</h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= $pemasok['id']; ?>" />
                        <div class="form-group">
                            <label for="nama_pemasok">Nama Pemasok</label>
                            <input type="text" class="form-control" name="nama_pemasok" id="nama_pemasok" value="<?= $pemasok['nama_pemasok']; ?>" placeholder="Enter name supplier">
                        </div>
                        <div class="form-group">
                            <label for="alamat_pemasok">Alamat Pemasok</label>
                            <textarea class="form-control" name="alamat_pemasok" id="alamat_pemasok" placeholder="Enter address supplier"><?= $pemasok['alamat_pemasok']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="no_telp_pemasok">Nomor Telpon Pemasok</label>
                            <input type="text" class="form-control" id="no_telp_pemasok" name="no_telp_pemasok" value="<?= $pemasok['no_telpon_pemasok']; ?>" placeholder="Enter contact supplier">
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
    $('a.nav-link[href="pemasok.php"]').addClass('active')
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
				document.location.href = 'pemasok.php'
			</script>
			";
    } else {
        echo ("<script>
				alert('Data Gagal disimoan.')
				document.location.href = 'form_pemasok.php'
			</script>
			");
    }
} elseif (isset($_POST['hapus'])) {
    $count = hapus($_POST['id']);

    if ($count > 0) {
        echo "<script>
				alert('Data Berhasil dihapus.')
				document.location.href = 'pemasok.php'
			</script>
			";
    } else {
        echo ("<script>
				alert('Data Gagal dihapus.')
				document.location.href = 'form_pemasok.php'
			</script>
			");
    }
}

?>