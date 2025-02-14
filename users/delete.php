<?php
include("../controllers/Users.php");

include("../lib/functions.php");
$obj = new UsersController();

if(isset($_GET["id"])){
    $id=$_GET["id"];
}

$msg=null;
if (isset($_POST['submitted'])==1 && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // Form was submitted, process the update here
    $id = $_POST['id'];
    
    // delete the database record using your controller's method
    $dat = $obj->deleteUsers($id);
    $msg = getJSON($dat);
    
}
$rows = $obj->getUsers($id);
$theme=setTheme();
getHeader($theme);
?>

    <?php 
    if($msg===true){ 
        echo '<div class="alert alert-success" style="display: block" id="message_success">Delete Data Berhasil</div>';
        echo '<meta http-equiv="refresh" content="3;url='.base_url().'users/">';
    } elseif($msg===false) {
        echo '<div class="alert alert-danger" style="display: block" id="message_error">Delete Gagal</div>'; 
    } else {

    }
    
    ?>
    <div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>users</strong> <small>Delete Data</small> </h2>
    </div>
    <hr/>
    <form name="formDelete" method="POST" action="">
        <input type="hidden" class="form-control" name="submitted" value="1"/>
        <dl class="row mt-1">
        <?php foreach ($rows as $row): ?>
        
        
                            <dt class="col-sm-3">Id:</dt><dd class="col-sm-9"><?php echo $row['id']; ?></dd>
                            <input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>" readonly />
            
                            <dt class="col-sm-3">Nip:</dt><dd class="col-sm-9"><?php echo $row['nip']; ?></dd>
            
                            <dt class="col-sm-3">Nama:</dt><dd class="col-sm-9"><?php echo $row['nama']; ?></dd>
            
                            <dt class="col-sm-3">Sandi:</dt><dd class="col-sm-9"><?php echo $row['sandi']; ?></dd>
            
                            <dt class="col-sm-3">Level:</dt><dd class="col-sm-9"><?php echo $row['level']; ?></dd>
            
            
        </dl>
        <button class="btn btn-large btn-danger" type="submit">Delete</button>
        <a href="#index" class="btn btn-large btn-default">Cancel</a>
        <?php endforeach; ?>
    </form>
                                       
<?php
getFooter($theme,"");
?>
