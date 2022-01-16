<?php require('services/transaksi-pembelian.php'); ?>
<?php require('header.php'); ?>
<?php require('sidebar.php'); ?>
<?php

$barang = query('SELECT * FROM barang');
if (isset($_GET['id'])) {
    $transaksi = query('SELECT * FROM transaksi_pembelian WHERE id="' . $_GET['id'] . '"')[0];
} else {
    $transaksi = array(
        "id" => '',
        "no_faktur" => '',
        "kode_barang" => '',
        "tgl_transaksi" => '',
        "jumlah_beli" => '',
        "jumlah_harga" => ''
    );
}
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-2">
                <form method="POST" class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">Transaksi Pembelian</h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= $transaksi['id']; ?>" />
                        <div class="form-group">
                            <label for="no_faktur">Nomor Faktur</label>
                            <input type="text" class="form-control" name="no_faktur" value="<?= $transaksi['no_faktur'] ?>" id="no_faktur" placeholder="Enter invoice number">
                        </div>
                        <div class="form-group">
                            <label>Barang</label>
                            <select class="form-control" name="kode_barang" value="<?= $transaksi['kode_barang']; ?>" onchange="selectItem(event)">
                                <option>Pilih barang</option>
                                <?php foreach ($barang as $_barang) : ?>
                                    <option <?= $_barang['kode_barang'] == $transaksi['kode_barang'] ? 'selected' : ''; ?> value="<?= $_barang['kode_barang'] ?>" stok="<?= $_barang['stok'] ?>" harga-barang="<?= $_barang['harga_barang'] ?>">
                                        <?= "[" . $_barang['kode_barang'] . "] " . $_barang['nama_barang'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok Barang</label>
                            <input type="number" class="form-control" name="stok" id="stok" value="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="harga_barang">Harga Barang</label>
                            <input type="number" class="form-control" name="harga_barang" id="harga_barang" value="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tgl_transaksi">Tanggal Transaksi</label>
                            <input type="date" class="form-control" name="tgl_transaksi" value="<?= $transaksi['tgl_transaksi']; ?>" id="tgl_transaksi" placeholder="Enter invoice date">
                        </div>
                        <div class="form-group">
                            <label for="jumlah_beli">Jumlah Beli</label>
                            <input type="number" class="form-control" name="jumlah_beli" id="jumlah_beli" value="<?= $transaksi['jumlah_beli']; ?>" onchange="changeJumlahJual(event)" placeholder="Enter quantity item">
                        </div>
                        <div class="form-group">
                            <label for="jumlah_harga">Jumlah Harga</label>
                            <input type="number" class="form-control" name="jumlah_harga" value="<?= $transaksi['jumlah_harga']; ?>" id="jumlah_harga" placeholder="Enter price amount" readonly>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="simpan" disabled>SIMPAN</button>
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
    $('a.nav-link[href="transaksi-pembelian.php"]').addClass('active')

    function selectItem(ev) {
        const stok = $(ev.target.selectedOptions).attr("stok")
        const harga_barang = $(ev.target.selectedOptions).attr("harga-barang")

        $("#stok").val(stok)
        $("#harga_barang").val(harga_barang)
    }

    function changeJumlahJual(ev) {
        const stok = $("#stok").val()
        const harga_barang = $("#harga_barang").val()

        if (Number(ev.target.value) > Number(stok)) {
            alert('Stok tidak cukup')
            $("button[name='simpan']").attr('disabled')
        } else {
            $("button[name='simpan']").removeAttr('disabled')
        }

        $("#jumlah_harga").val(Number(ev.target.value) * Number(harga_barang))
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
				document.location.href = 'transaksi-pembelian.php'
			</script>
			";
    } else {
        echo ("<script>
				alert('Data Gagal disimoan.')
				document.location.href = 'form_transaksi-pembelian.php'
			</script>
			");
    }
}

?>