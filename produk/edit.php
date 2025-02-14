<?php
include("../controllers/Produk.php");
include("../lib/functions.php");
$obj = new ProdukController();
if(isset($_GET["id"])){
    $id=$_GET["id"];
}

$msg=null;
if (isset($_POST["submitted"])==1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $id = $_POST['id'];
    $kode_produk = $_POST['kode_produk'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    // Update the database record using your controller's method
$dat = $obj->updateproduk($id, $kode_produk, $nama_produk, $harga, $stok);
$msg = getJSON($dat);
}
$rows = $obj->getProduk($id);
$theme=setTheme();
getHeader($theme);
?>

    <?php 
    if($msg===true){ 
        echo '<div class="alert alert-success" style="display: block" id="message_success">Update Data Berhasil</div>';
        echo '<meta http-equiv="refresh" content="2;url='.base_url().'produk/">';
    } elseif($msg===false) {
        echo '<div class="alert alert-danger" style="display: block" id="message_error">Update Gagal</div>'; 
    } else {

    }
    
    ?>
        <div class="header icon-and-heading">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
        <h2><strong>produk</strong> <small>Edit Data</small> </h2>
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
                        <label>kode_produk:</label>
                        <input type="text" class="form-control" id="kode_produk" name="kode_produk" 
                            value="<?php echo $row['kode_produk']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>nama_produk:</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" 
                            value="<?php echo $row['nama_produk']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>harga:</label>
                        <input type="text" class="form-control" id="harga" name="harga" 
                            value="<?php echo $row['harga']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>stok:</label>
                        <input type="text" class="form-control" id="stok" name="stok" 
                            value="<?php echo $row['stok']; ?>" />
                    </div>
                
            
            <?php endforeach; ?>
            <button class="save btn btn-large btn-info" type="submit">Save</button>
            <a href="#index" class="btn btn-large btn-default">Cancel</a>
        </form>
                                        
<?php
getFooter($theme,"<script src='../lib/forms.js'></script>");
?>
</body>
</html>
