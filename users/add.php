<?php
include("../controllers/Users.php");
include("../lib/functions.php");
$obj = new UsersController();
$msg=null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $sandi = $_POST['sandi'];
    $level = $_POST['level'];
    // Insert the database record using your controller's method
$dat = $obj->addusers($nip, $nama, $sandi, $level);
$msg = getJSON($dat);
}
$theme=setTheme();
getHeader($theme);
?>

<?php 
if($msg===true){ 
    echo '<div class="alert alert-success" style="display: block" id="message_success">Insert Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url='.base_url().'users/">';
} elseif($msg===false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Insert Gagal</div>'; 
} else {

}

?>
        <div class="header icon-and-heading fs-1">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x"></i>
            <h2><strong>users</strong> <small>Add New Data</small> </h2>
        </div>
        <hr/>
        <form name="formAdd" method="POST" action="">
            
                <div class="form-group">
                    <label>Nip:</label>
                    <input type="text" class="form-control" name="nip"  />
                </div>
            
                <div class="form-group">
                    <label>Nama:</label>
                    <input type="text" class="form-control" name="nama"  />
                </div>
            
                <div class="form-group">
                    <label>Sandi:</label>
                    <input type="text" class="form-control" name="sandi"  />
                </div>
            
                <div class="form-group">
                    <label>level:</label>
                    <select id="level" name="level" style="width:150px" class="form-control">
                        <option value="">--pilih--</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
            
            <button class="save btn btn-large btn-info" type="submit">Save</button>
            <a href="#index" class="btn btn-large btn-default">Cancel</a>
        </form>

<?php
getFooter($theme,"<script src='../lib/forms.js'></script>");
?>
</body>
</html>
