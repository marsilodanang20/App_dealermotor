<?php
include("../controllers/Transaksi.php");
include("../controllers/Customer.php");
include("../controllers/Produk.php");
include("../lib/functions.php");

$obj = new TransaksiController();
$customer = new CustomerController();
$produk = new ProdukController();

$list_customer = $customer->getCustomerList();
$list_produk = $produk->getProdukList();

$msg = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $nomor_transaksi = $_POST['nomor_transaksi'];
    $nomor_customer = $_POST['nomor_customer'];
    $kode_produk = $_POST['kode_produk'];
    $tanggal_transaksi = $_POST['tanggal_transaksi'];
    $jumlah = $_POST['jumlah'];
    $total_harga = $_POST['total_harga'];

    // Insert the database record using your controller's method
    $dat = $obj->addtransaksi($nomor_transaksi, $nomor_customer, $kode_produk, $tanggal_transaksi, $jumlah, $total_harga);
    $msg = getJSON($dat);
}

$theme = setTheme();
getHeader($theme);
$nomor_transaksi = generateRandomString();
?>

<?php 
if ($msg === true) { 
    echo '<div class="alert alert-success" style="display: block" id="message_success">Insert Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url='.base_url().'transaksi/">';
} elseif ($msg === false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Insert Gagal</div>'; 
}
?>

<div class="header icon-and-heading fs-1">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x"></i>
    <h2><strong>Transaksi</strong> <small>Add New Data</small> </h2>
</div>
<hr/>
<form name="formAdd" method="POST" action="">

    <div class="form-group col-md-3">
        <label>Nomor Transaksi:</label>
        <div class="input-group">
            <input type="text" class="form-control" name="nomor_transaksi" value="<?php echo $nomor_transaksi; ?>" readonly="readonly" />
        </div>
    </div>

    <div class="form-group mt-3">
        <label>Nomor Customer:</label>
        <select class="form-control" name="nomor_customer" id="nomor_customer">
            <option value="">Pilih Customer...</option>
            <?php foreach ($list_customer as $cust): ?>
                <option value="<?php echo htmlspecialchars($cust['nomor_customer']); ?>">
                    <?php echo htmlspecialchars($cust['nomor_customer']) . ' - ' . htmlspecialchars($cust['nama_customer']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group mt-3">
        <label>Kode Produk:</label>
        <select class="form-control" name="kode_produk" id="kode_produk" onchange="updateHargaProduk()">
            <option value="">Pilih Produk...</option>
            <?php foreach ($list_produk as $prod): ?>
                <option value="<?php echo htmlspecialchars($prod['kode_produk']); ?>" data-harga="<?php echo htmlspecialchars($prod['harga']); ?>">
                    <?php echo htmlspecialchars($prod['kode_produk']) . ' - ' . htmlspecialchars($prod['nama_produk']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group mt-3">
        <label>Tanggal Transaksi:</label>
        <input type="date" class="form-control" name="tanggal_transaksi" />
    </div>

    <div class="form-group mt-3">
        <label>Jumlah:</label>
        <input type="number" class="form-control" name="jumlah" id="jumlah" oninput="updateTotalHarga()" />
    </div>

    <div class="form-group mt-3">
        <label>Total Harga:</label>
        <input type="text" class="form-control" name="total_harga" id="total_harga" readonly="readonly" />
    </div>

    <button class="save btn btn-large btn-info mt-3" type="submit">Save</button>
    <a href="#index" class="btn btn-large btn-default">Cancel</a>
</form>

<script>
    // Function to update the total price dynamically
    function updateTotalHarga() {
        const jumlah = document.getElementById('jumlah').value || 0;
        const kodeProduk = document.getElementById('kode_produk');
        const selectedOption = kodeProduk.options[kodeProduk.selectedIndex];
        const hargaProduk = selectedOption.getAttribute('data-harga') || 0;

        const totalHarga = jumlah * hargaProduk;
        document.getElementById('total_harga').value = totalHarga;
    }

    // Function to reset total harga when product changes
    function updateHargaProduk() {
        document.getElementById('jumlah').value = '';
        document.getElementById('total_harga').value = '';
    }
</script>

<?php
getFooter($theme, "<script src='../lib/forms.js'></script>");
?>
</body>
</html>
