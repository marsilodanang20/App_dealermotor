<?php
session_start();
error_reporting(0);
include("controllers/Login.php");
include("lib/functions.php");

$obj = new LoginController();
$msg = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $sandi = $_POST["sandi"];

    $dat = $obj->login_validation($email, $sandi);
    $msg = getJSON($dat);
}

$theme = setTheme();
getHeaderLogin($theme);
?>

<div class="container-fluid mt-5">
    <h4 class="text-center mb-4">Login</h4>
    <div class="row justify-content-center">
        <div class="col-md-4 panel panel-default p-4 rounded shadow-sm">
            <?php 
                if ($msg !== null) { 
                    if ($msg === true) {
                        echo '<div class="alert alert-success" id="message_success">Login Success</div>';
                        echo '<meta http-equiv="refresh" content="1;url=' . base_url() . 'index.php">';
                    } else {
                        echo '<div class="alert alert-danger" id="message_error">Login Gagal: ' . $msg . '</div>';
                    }
                }
            ?>			
            <form id="login-form" method="POST">
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
                <button type="submit" class="btn btn-primary w-100">Log In</button>
            </form>
            <div class="text-center mt-3">
                Belum punya akun? Daftarkan <a href="register.php">disini</a>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordField = document.getElementById("sandi");
        const eyeIcon = document.getElementById("toggle-password").getElementsByTagName("img")[0];
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.src = "https://img.icons8.com/ios/50/000000/invisible.png";
        } else {
            passwordField.type = "password";
            eyeIcon.src = "https://img.icons8.com/ios/50/000000/visible.png";
        }
    }

    document.getElementById("toggle-password").addEventListener("click", togglePassword);
</script>

<?php
getFooterLogin($theme, '');
?>
