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
if(isset($_GET["id"])){
    $id=$_GET["id"];
}

if (isset($_POST["submitted"])==1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $id = $_POST['id'];
    $nomor_transaksi = $_POST['nomor_transaksi'];
    $nomor_customer = $_POST['nomor_customer'];
    $kode_produk = $_POST['kode_produk'];
    $tanggal_transaksi = $_POST['tanggal_transaksi'];
    $jumlah = $_POST['jumlah'];
    $total_harga = $_POST['total_harga'];
    
    // Update the database record using your controller's method
    $dat = $obj->updatetransaksi($id, $nomor_transaksi, $nomor_customer, $kode_produk, $tanggal_transaksi, $jumlah, $total_harga);
    $msg = getJSON($dat);
}

$rows = $obj->getTransaksi($id);
$theme = setTheme();
getHeader($theme);
?>

<?php 
if($msg === true) { 
    echo '<div class="alert alert-success" style="display: block" id="message_success">Update Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url='.base_url().'transaksi/">';
} elseif($msg === false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Update Gagal</div>'; 
}
?>

<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Transaksi</strong> <small>Edit Data</small> </h2>
</div>
<hr style="margin-bottom:-2px;"/>
<form name="formEdit" method="POST" action="">
    <input type="hidden" class="form-control" name="submitted" value="1"/>
    <?php foreach ($rows as $row): ?>
        <div class="form-group">
            <label>id:</label>
            <input type="text" class="form-control" id="id" name="id" 
                value="<?php echo $row['id']; ?>" readonly/>
        </div>
        
        <div class="form-group">
            <label>Nomor Transaksi:</label>
            <input type="text" class="form-control" id="nomor_transaksi" name="nomor_transaksi" 
                value="<?php echo $row['nomor_transaksi']; ?>" readonly/>
        </div>
        
        <div class="form-group">
            <label>Nomor Customer:</label>
            <select class="form-control" name="nomor_customer" id="nomor_customer">
                <?php foreach ($list_customer as $cust): ?>
                    <option value="<?php echo htmlspecialchars($cust['nomor_customer']); ?>" 
                        <?php echo $row['nomor_customer'] == $cust['nomor_customer'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cust['nomor_customer']) . ' - ' . htmlspecialchars($cust['nama_customer']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Kode Produk:</label>
            <select class="form-control" name="kode_produk" id="kode_produk" onchange="updateHargaProduk()">
                <?php foreach ($list_produk as $prod): ?>
                    <option value="<?php echo htmlspecialchars($prod['kode_produk']); ?>" 
                        data-harga="<?php echo htmlspecialchars($prod['harga']); ?>"
                        <?php echo $row['kode_produk'] == $prod['kode_produk'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($prod['kode_produk']) . ' - ' . htmlspecialchars($prod['nama_produk']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>Tanggal Transaksi:</label>
            <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" 
                value="<?php echo $row['tanggal_transaksi']; ?>" />
        </div>
        
        <div class="form-group">
            <label>Jumlah:</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" 
                value="<?php echo $row['jumlah']; ?>" oninput="updateTotalHarga()"/>
        </div>
        
        <div class="form-group">
            <label>Total Harga:</label>
            <input type="text" class="form-control" id="total_harga" name="total_harga" 
                value="<?php echo $row['total_harga']; ?>" readonly/>
        </div>
    <?php endforeach; ?>
    
    <button class="save btn btn-large btn-info" type="submit">Save</button>
    <a href="#index" class="btn btn-large btn-default">Cancel</a>
</form>

<script>
    // Function to update total price dynamically based on jumlah and selected product price
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
