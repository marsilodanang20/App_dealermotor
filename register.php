<?php
include("controllers/Login.php");
include("lib/functions.php");
$obj = new LoginController();
$msg = null;

// Ambil daftar level dari database
$levels = $obj->getUserLevels();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $nama = $_POST["nama"];
    $sandi = $_POST["sandi"];
    $confirmpassword = $_POST["confirmpassword"];
    $level = $_POST["level"]; // Menambahkan level dari form

    if ($sandi === $confirmpassword) {
        $dat = $obj->addUsers($email, $nama, $sandi, $level); // Mengirimkan level ke method addUsers
        $msg = getJSON($dat);
    } else {
        $msg = "no";
    }
}

$theme = setTheme();
getHeaderLogin($theme);
?>

<div class="container-fluid mt-5">
    <h4 class="text-center mb-4">Register</h4>
    <div class="row justify-content-center">
        <div class="col-md-4 panel panel-default p-4 rounded shadow-sm">
            <?php 
                if ($msg === true) { 
                    echo '<div class="alert alert-success" id="message_success">Register Success</div>';
                    echo '<meta http-equiv="refresh" content="1;url=' . base_url() . 'index.php">';
                } elseif ($msg === false) {
                    echo '<div class="alert alert-danger" id="message_error">Register Gagal</div>'; 
                } elseif ($msg === "no") {
                    echo '<div class="alert alert-danger" id="message_error">Password dan Confirm Password harus sama</div>';
                }
            ?>		
            <form id="register-form" method="POST">
                <div class="form-group mb-3">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group mb-3">
                    <label for="sandi">Sandi:</label>
                    <div class="input-password-wrapper position-relative">
                        <input type="password" class="form-control" id="sandi" name="sandi" required>
                        <i class="eye-icon" id="toggle-password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                            <img src="https://img.icons8.com/ios/50/000000/visible.png" width="20" height="20" alt="eye-icon">
                        </i>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="confirmpassword">Confirm Password:</label>
                    <div class="input-password-wrapper position-relative">
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" required>
                        <i class="eye-icon" id="toggle-confirmpassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                            <img src="https://img.icons8.com/ios/50/000000/visible.png" width="20" height="20" alt="eye-icon">
                        </i>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="level">Role:</label>
                    <select class="form-control" id="level" name="level" required>
                        <?php
                            foreach ($levels as $level) {
                                echo "<option value=\"$level\">$level</option>";
                            }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <div class="text-center mt-3">
                Sudah punya akun? Login <a href="login.php">disini</a>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId, toggleId) {
        const passwordField = document.getElementById(fieldId);
        const eyeIcon = document.getElementById(toggleId).getElementsByTagName("img")[0];
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.src = "https://img.icons8.com/ios/50/000000/invisible.png";
        } else {
            passwordField.type = "password";
            eyeIcon.src = "https://img.icons8.com/ios/50/000000/visible.png";
        }
    }

    document.getElementById("toggle-password").addEventListener("click", function () {
        togglePassword("sandi", "toggle-password");
    });

    document.getElementById("toggle-confirmpassword").addEventListener("click", function () {
        togglePassword("confirmpassword", "toggle-confirmpassword");
    });
</script>

<?php
getFooterLogin($theme, '');
?>
