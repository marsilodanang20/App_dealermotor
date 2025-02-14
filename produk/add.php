<?php
include("../controllers/Produk.php");
include("../lib/functions.php");
$obj = new ProdukController();
$msg=null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $kode_produk = $_POST['kode_produk'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    // Insert the database record using your controller's method
$dat = $obj->addproduk($kode_produk, $nama_produk, $harga, $stok);
$msg = getJSON($dat);
}
$theme=setTheme();
getHeader($theme);
?>

<?php 
if($msg===true){ 
    echo '<div class="alert alert-success" style="display: block" id="message_success">Insert Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url='.base_url().'produk/">';
} elseif($msg===false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Insert Gagal</div>'; 
} else {

}

?>
        <div class="header icon-and-heading fs-1">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x"></i>
            <h2><strong>produk</strong> <small>Add New Data</small> </h2>
        </div>
        <hr/>
        <form name="formAdd" method="POST" action="">
            
                <div class="form-group">
                    <label>Kode_produk:</label>
                    <input type="text" class="form-control" name="kode_produk"  />
                </div>
            
                <div class="form-group">
                    <label>Nama_produk:</label>
                    <input type="text" class="form-control" name="nama_produk"  />
                </div>
            
                <div class="form-group">
                    <label>Harga:</label>
                    <input type="text" class="form-control" name="harga"  />
                </div>
            
                <div class="form-group">
                    <label>Stok:</label>
                    <input type="text" class="form-control" name="stok"  />
                </div>
            
            <button class="save btn btn-large btn-info" type="submit">Save</button>
            <a href="#index" class="btn btn-large btn-default">Cancel</a>
        </form>

<?php
getFooter($theme,"<script src='../lib/forms.js'></script>");
?>
</body>
</html>
