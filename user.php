<?php require('services/user.php'); ?>
<?php require('header.php'); ?>
<?php require('sidebar.php'); ?>
<?php

$users = [];
if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $users = query("SELECT * FROM  users WHERE 
        full_name LIKE '%$keyword%' OR 
        username LIKE '%$keyword%' ");
} else {
    $users = query("SELECT * FROM  users");
}

?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data User</h3>
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
                            <a href="form_user.php" class="btn btn-sm btn-primary ml-2">Tambah</a>
                        </form>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Full Name</th>
                                    <th>Username</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($users as $data) : ?>
                                    <tr title="Click to edit" style="cursor: pointer;" onclick="gotoForm(<?= $data['id'] ?>)">
                                        <td><?= $i; ?></td>
                                        <td><?= $data['full_name'] ?></td>
                                        <td><?= $data['username'] ?></td>
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
    $('a.nav-link[href="user.php"]').addClass('active')

    function gotoForm(id) {
        window.location.href = 'form_user.php?id=' + id
    }
</script>