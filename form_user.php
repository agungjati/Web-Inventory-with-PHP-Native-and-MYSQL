<?php require('services/user.php'); ?>
<?php require('header.php'); ?>
<?php require('sidebar.php'); ?>
<?php
if (isset($_GET['id'])) {
    $user = query('SELECT * FROM users WHERE id="' . $_GET['id'] . '"')[0];
} else {
    $user = array(
        "id" => '',
        "full_name" => '',
        "foto" => '',
        "username" => '',
        "password" => '',
    );
}
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-2">
                <form method="POST" class="card card-primary card-outline" enctype="multipart/form-data">
                    <div class="card-header">
                        <h5 class="m-0">Pemasok</h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= $user['id']; ?>" />
                        <input type="hidden" name="fotoLama" value="<?= $user["foto"] ?>" />
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" class="form-control" name="full_name" id="full_name" value="<?= $user['full_name']; ?>" placeholder="Enter full name">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control" name="username" id="username" value="<?= $user['username']; ?>" placeholder="Enter username" />
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <?php if (isset($_GET['id'])) {
                                echo '<br /><img src="foto/' . $user["foto"] . '" alt="" width="60" />';
                            }
                            ?>
                            <input type="file" class="form-control" name="foto" id="foto">
                        </div>
                        <div class="form-group">
                            <label for="password">Password <?= isset($_GET['id']) ? '<small>Optional</small>' : '' ?></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password <?= isset($_GET['id']) ? '<small>Optional</small>' : '' ?></label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" onchange="changeConfirmPassword(event)" placeholder="Enter confirm password">
                            <span id="confirm_password-error" class="error invalid-feedback">Please enter a password exactly</span>
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
    $('a.nav-link[href="user.php"]').addClass('active')

    function changeConfirmPassword(ev) {
        if ($('#password').val() !== ev.target.value) {
            $('#confirm_password-error').show()
        } else {
            $('#confirm_password-error').hide()
        }
    }
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
				 document.location.href = 'user.php'
			</script>
			";
    } else {
        echo ("<script>
				 alert('Data Gagal disimpan.')
				 document.location.href = 'form_user.php'
			</script>
			");
    }
} elseif (isset($_POST['hapus'])) {
    $count = hapus($_POST['id']);

    if ($count > 0) {
        echo "<script>
				alert('Data Berhasil dihapus.')
				document.location.href = 'user.php'
			</script>
			";
    } else {
        echo ("<script>
				alert('Data Gagal dihapus.')
				document.location.href = 'form_user.php'
			</script>
			");
    }
}

?>