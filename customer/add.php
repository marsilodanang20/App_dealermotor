<?php
include("../controllers/Customer.php");
include("../lib/functions.php");
$obj = new CustomerController();
$msg=null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $nomor_customer = $_POST['nomor_customer'];
    $nama_customer = $_POST['nama_customer'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    // Insert the database record using your controller's method
$dat = $obj->addcustomer($nomor_customer, $nama_customer, $alamat, $telepon);
$msg = getJSON($dat);
}
$theme=setTheme();
getHeader($theme);
?>

<?php 
if($msg===true){ 
    echo '<div class="alert alert-success" style="display: block" id="message_success">Insert Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url='.base_url().'customer/">';
} elseif($msg===false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Insert Gagal</div>'; 
} else {

}

?>
        <div class="header icon-and-heading fs-1">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x"></i>
            <h2><strong>customer</strong> <small>Add New Data</small> </h2>
        </div>
        <hr/>
        <form name="formAdd" method="POST" action="">
            
                <div class="form-group">
                    <label>Nomor_customer:</label>
                    <input type="text" class="form-control" name="nomor_customer"  />
                </div>
            
                <div class="form-group">
                    <label>Nama_customer:</label>
                    <input type="text" class="form-control" name="nama_customer"  />
                </div>
            
                <div class="form-group">
                    <label>Alamat:</label>
                    <input type="text" class="form-control" name="alamat"  />
                </div>
            
                <div class="form-group">
                    <label>Telepon:</label>
                    <input type="text" class="form-control" name="telepon"  />
                </div>
            
            <button class="save btn btn-large btn-info" type="submit">Save</button>
            <a href="#index" class="btn btn-large btn-default">Cancel</a>
        </form>

<?php
getFooter($theme,"<script src='../lib/forms.js'></script>");
?>
</body>
</html>
