<?php require('services/customer.php'); ?>
<?php require('header.php'); ?>
<?php require('sidebar.php'); ?>
<?php
if (isset($_GET['id'])) {
    $customer = query('SELECT * FROM customers WHERE id="' . $_GET['id'] . '"')[0];
} else {
    $customer = array(
        "id" => '',
        "name_customer" => '',
        "no_telpon" => '',
        "email" => '',
        "alamat_customer" => '',
    );
}
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-2">
                <form method="POST" class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">Customer</h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= $customer['id']; ?>" />
                        <div class="form-group">
                            <label for="name_customer">Nama Customer</label>
                            <input type="text" class="form-control" name="name_customer" id="name_customer" value="<?= $customer['name_customer']; ?>" placeholder="Enter name customer">
                        </div>
                        <div class="form-group">
                            <label for="no_telpon">Nomor Telpon</label>
                            <input type="text" class="form-control" id="no_telpon" name="no_telpon" value="<?= $customer['no_telpon']; ?>" placeholder="Enter contact customer">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $customer['email']; ?>" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="alamat_customer">Alamat</label>
                            <textarea class="form-control" name="alamat_customer" id="alamat_customer" placeholder="Enter address customer"><?= $customer['alamat_customer']; ?></textarea>
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
    $('a.nav-link[href="customer.php"]').addClass('active')
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
				document.location.href = 'customer.php'
			</script>
			";
    } else {
        echo ("<script>
				alert('Data Gagal disimoan.')
				document.location.href = 'form_customer.php'
			</script>
			");
    }
} elseif (isset($_POST['hapus'])) {
    $count = hapus($_POST['id']);

    if ($count > 0) {
        echo "<script>
				alert('Data Berhasil dihapus.')
				document.location.href = 'customer.php'
			</script>
			";
    } else {
        echo ("<script>
				alert('Data Gagal dihapus.')
				document.location.href = 'form_customer.php'
			</script>
			");
    }
}

?>