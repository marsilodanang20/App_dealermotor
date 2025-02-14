<?php
// Memulai session di awal file
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="../themes/fobia/assets/images/logo-icon-2.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Advantage Dealer Motor</h4>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">        
        <li class="menu-label">Main Menu</li>
        <li>
            <a href="dashboard/index.php">
                <div class="parent-icon">
                    <!-- Ganti ikon dengan ikon dashboard -->
                    <ion-icon name="speedometer-outline"></ion-icon>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        
        <?php
        // Cek level pengguna yang login
        if (isset($_SESSION['level'])) {
            $level = $_SESSION['level']; // Pastikan level sudah ada dalam session

            // Mengambil daftar menu dari fungsi Menulist
            $menuItems = Menulist();

            // Loop untuk menampilkan menu berdasarkan level
            foreach ($menuItems as $item) {
                if ($level == 'Admin') {
                    // Untuk Admin, tampilkan semua menu kecuali Login dan Users
                    if ($item !== 'Login' && $item !== 'Users') {
                        if ($item === 'Customer') {
                            echo '<li><a href="../' . strtolower($item) . '">
                                    <div class="parent-icon">
                                        <!-- Ikon untuk Data Customer -->
                                        <ion-icon name="person-add-outline"></ion-icon>
                                    </div>
                                    <div class="menu-title">Data ' . $item . '</div>
                                  </a></li>';
                        } elseif ($item === 'Produk') {
                            echo '<li><a href="../' . strtolower($item) . '">
                                    <div class="parent-icon">
                                        <!-- Ikon untuk Data Produk -->
                                        <ion-icon name="cube-outline"></ion-icon>
                                    </div>
                                    <div class="menu-title">Data ' . $item . '</div>
                                  </a></li>';
                        } elseif ($item === 'Transaksi') {
                            echo '<li><a href="../' . strtolower($item) . '">
                                    <div class="parent-icon">
                                        <!-- Ikon untuk Data Transaksi -->
                                        <ion-icon name="cash-outline"></ion-icon>
                                    </div>
                                    <div class="menu-title">Data ' . $item . '</div>
                                  </a></li>';
                        } else {
                            echo '<li><a href="../' . strtolower($item) . '">
                                    <div class="parent-icon">
                                        <!-- Ikon umum untuk Data lainnya -->
                                        <ion-icon name="document-text-outline"></ion-icon>
                                    </div>
                                    <div class="menu-title">Data ' . $item . '</div>
                                  </a></li>';
                        }
                    }
                }
                elseif ($level == 'Kasir') {
                    // Untuk Kasir, sembunyikan Produk
                    if ($item !== 'Produk') {
                        echo '<li><a href="../' . strtolower($item) . '">
                                <div class="parent-icon">
                                    <!-- Ikon umum untuk Data -->
                                    <ion-icon name="document-text-outline"></ion-icon>
                                </div>
                                <div class="menu-title">Data ' . $item . '</div>
                              </a></li>';
                    }
                }
                elseif ($level == 'User') {
                    // Untuk User, hanya tampilkan Produk
                    if ($item === 'Produk') {
                        echo '<li><a href="../' . strtolower($item) . '">
                                <div class="parent-icon">
                                    <!-- Ikon untuk Produk -->
                                    <ion-icon name="cube-outline"></ion-icon>
                                </div>
                                <div class="menu-title">Data ' . $item . '</div>
                              </a></li>';
                    }
                }
            }
        } else {
            // Menangani kasus jika session['level'] belum ada
            echo '<li><a href="../login.php">
                    <div class="parent-icon">
                        <!-- Ikon untuk Login -->
                        <ion-icon name="log-in-outline"></ion-icon>
                    </div>
                    <div class="menu-title">Login</div>
                  </a></li>';
        }
        ?>
        
        <li>
            <a href="../logout.php">
                <div class="parent-icon">
                    <!-- Ikon untuk Log Out -->
                    <ion-icon name="log-out-outline"></ion-icon>
                </div>
                <div class="menu-title">Log Out</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->
