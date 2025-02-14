<?php
include("../controllers/Users.php");
include("../lib/functions.php");
$obj = new UsersController();
if(isset($_GET["id"])){
    $id=$_GET["id"];
}

$msg=null;
if (isset($_POST["submitted"])==1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $id = $_POST['id'];
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $sandi = $_POST['sandi'];
    $level = $_POST['level'];
    // Update the database record using your controller's method
$dat = $obj->updateusers($id, $nip, $nama, $sandi, $level);
$msg = getJSON($dat);
}
$rows = $obj->getUsers($id);
$theme=setTheme();
getHeader($theme);
?>

    <?php 
    if($msg===true){ 
        echo '<div class="alert alert-success" style="display: block" id="message_success">Update Data Berhasil</div>';
        echo '<meta http-equiv="refresh" content="2;url='.base_url().'users/">';
    } elseif($msg===false) {
        echo '<div class="alert alert-danger" style="display: block" id="message_error">Update Gagal</div>'; 
    } else {

    }
    
    ?>
        <div class="header icon-and-heading">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
        <h2><strong>users</strong> <small>Edit Data</small> </h2>
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
                        <label>nip:</label>
                        <input type="text" class="form-control" id="nip" name="nip" 
                            value="<?php echo $row['nip']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" 
                            value="<?php echo $row['nama']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>sandi:</label>
                        <input type="text" class="form-control" id="sandi" name="sandi" 
                            value="<?php echo $row['sandi']; ?>" />
                    </div>
                
                <div class="form-group">
                    <label>Level:</label>
                    <select id="level" name="level" style="width:150px" 
                        class="form-control show-tick" required>
                    <option value="<?php echo $row['level']; ?>">
                    <?php echo $row['level']; ?></option>
                        <option value="Admin">Admin</option>
                    </select>
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
