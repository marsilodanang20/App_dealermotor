<!--start footer-->

    <!--end footer-->
    <!-- JS Files-->
    <script src="themes/fobia/assets/js/jquery.min.js"></script>
    <script src="themes/fobia/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="themes/fobia/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="themes/fobia/assets/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!--plugins-->
    <script src="themes/fobia/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>

    <!-- Main JS-->
    <!-- <?php echo $theme_dir; ?> -->
    <script src="themes/fobia/assets/js/main.js"></script>
<?php
if(getFilename()=="upload.php"){
  echo '<script src="upload.js"></script>';
}
if(getFilename()=="add.php" || getFilename()=="edit.php"){
  echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.1/tinymce.min.js"></script>
  <script src="../lib/forms.js"></script>';
}

?>