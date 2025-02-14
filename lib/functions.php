<?php
require_once __DIR__ . "/../vendor/autoload.php"; 

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "motor");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ambil jumlah data untuk customer, produk, dan transaksi
$customerCount = getCount('customer');
$productCount = getCount('produk');
$transactionCount = getCount('transaksi');

// Fungsi untuk menghitung jumlah data di tabel
function getCount($tableName) {
    global $conn; // Pastikan $conn adalah koneksi ke database
    $query = "SELECT COUNT(*) AS count FROM $tableName";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

// Fungsi untuk memproses JSON response
function getJSON($jsonResponse){
    $data = json_decode($jsonResponse);

    // Check if the JSON decoding was successful
    if ($data !== null) {
        // Access the values
        $success = $data->success; // true
        $message = $data->message; // "Update successful"

        // Now you can use $success and $message in your PHP code
        if ($success) {
            $val = true;
        } else {
            $val = false;
        }
    } else {
        // JSON parsing failed
        $val = "error";
    }
    return $val;
}

// Fungsi untuk mendapatkan URL base
function base_url(){
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();
    $base = $_ENV["BASE_URL"];
    return $base;
}

// Fungsi untuk mendapatkan controller URL
function controller_url(){
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();
    $base = $_ENV["CONTROLLER_URL"];
    return $base;
}

// Fungsi untuk mendapatkan daftar modul yang tersedia
function MenuList() {
    $directory = controller_url(); 
    $mod_array = array('Login', 'Users');  // Modul yang tidak dimasukkan ke Leftmenu
    
    if (!is_dir($directory)) {
        error_log("Invalid directory path: " . $directory);
        return []; 
    }

    $files = glob($directory . '*.php');
    
    if ($files === false) {
        error_log("Error reading directory: " . $directory);
        return [];
    }

    $filenames = array_map(function($file) { 
        return basename($file, '.php');
    }, $files);
    
    $filenames = array_filter($filenames, function($mod) use ($mod_array) {
        return !in_array($mod, $mod_array);
    });
    
    return array_values($filenames); // Re-index array after filtering
}

// Fungsi untuk menampilkan nilai checkbox
function ShowCheckBoxValue($val){
    return $val === 0 ? "Tidak" : "Ya";
}

// Fungsi untuk mengatur tema
function setTheme(){
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();
    return $_ENV["THEME"];
}

// Fungsi untuk menampilkan header
function getHeader($theme_name){
    include("../themes/".$theme_name."/header.php"); 
    include("../themes/".$theme_name."/leftmenu.php"); 
    include("../themes/".$theme_name."/topnav.php");
    include("../themes/".$theme_name."/upper_block.php");
}

// Fungsi untuk menampilkan footer
function getFooter($theme_name, $extra){
    include("../themes/".$theme_name."/lower_block.php"); 
    echo $extra;
    include("../themes/".$theme_name."/footer.php"); 
    echo '</body></html>';
}

// Fungsi untuk menampilkan header login
function getHeaderLogin($theme_name){
    include("themes/".$theme_name."/headerlogin.php"); 
    include("themes/".$theme_name."/leftmenulogin.php"); 
    include("themes/".$theme_name."/topnav.php");
    include("themes/".$theme_name."/upper_block.php");
}

// Fungsi untuk menampilkan footer login
function getFooterLogin($theme_name, $extra){
    include("themes/".$theme_name."/lower_block.php"); 
    echo $extra;
    include("themes/".$theme_name."/footerlogin.php"); 
    echo '</body></html>';
}

// Fungsi untuk mendapatkan nama file saat ini
function getFilename(){
    $host = $_SERVER["HTTP_HOST"];
    $uri = $_SERVER["REQUEST_URI"];
    $url = "http://".$host.$uri;
    $parsed_url = parse_url($url);

    $path = $parsed_url["path"];
    $file_info = pathinfo($path);
    return $file_info["basename"];
}

// Fungsi untuk menghasilkan string acak
function generateRandomString($length = 7) {
    $time = microtime(true);
    $hash = md5($time);
    return substr($hash, 0, $length);
}

?>
