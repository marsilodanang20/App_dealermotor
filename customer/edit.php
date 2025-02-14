<?php
include("../controllers/Customer.php");
include("../lib/functions.php");
$obj = new CustomerController();
if(isset($_GET["id"])){
    $id=$_GET["id"];
}

$msg=null;
if (isset($_POST["submitted"])==1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $id = $_POST['id'];
    $nomor_customer = $_POST['nomor_customer'];
    $nama_customer = $_POST['nama_customer'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    // Update the database record using your controller's method
$dat = $obj->updatecustomer($id, $nomor_customer, $nama_customer, $alamat, $telepon);
$msg = getJSON($dat);
}
$rows = $obj->getCustomer($id);
$theme=setTheme();
getHeader($theme);
?>

    <?php 
    if($msg===true){ 
        echo '<div class="alert alert-success" style="display: block" id="message_success">Update Data Berhasil</div>';
        echo '<meta http-equiv="refresh" content="2;url='.base_url().'customer/">';
    } elseif($msg===false) {
        echo '<div class="alert alert-danger" style="display: block" id="message_error">Update Gagal</div>'; 
    } else {

    }
    
    ?>
        <div class="header icon-and-heading">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
        <h2><strong>customer</strong> <small>Edit Data</small> </h2>
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
                        <label>nomor_customer:</label>
                        <input type="text" class="form-control" id="nomor_customer" name="nomor_customer" 
                            value="<?php echo $row['nomor_customer']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>nama_customer:</label>
                        <input type="text" class="form-control" id="nama_customer" name="nama_customer" 
                            value="<?php echo $row['nama_customer']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>alamat:</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" 
                            value="<?php echo $row['alamat']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>telepon:</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" 
                            value="<?php echo $row['telepon']; ?>" />
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
