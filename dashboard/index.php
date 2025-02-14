<?php 
include("../lib/auth.php"); 
include("../lib/functions.php");
$theme = setTheme();
getHeader($theme);

// Ambil jumlah data untuk customer, produk, dan transaksi
$customerCount = getCount('customer');
$productCount = getCount('produk');
$transactionCount = getCount('transaksi');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: <?php echo $theme == 'dark' ? '#1e1e2f' : '#f8f9fa'; ?>;
            color: <?php echo $theme == 'dark' ? '#e0e0e0' : '#333'; ?>;
            margin: 0;
            padding: 0;
        }

        .dashboard-container {
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .dashboard-header {
            background: <?php echo $theme == 'dark' ? '#33344a' : 'linear-gradient(to right, #283e51, #4b79a1)'; ?>;
            color: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
            width: 100%;
            min-height: 120px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dashboard-header h4 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }

        .dashboard-header p {
            margin: 5px 0 0;
            font-size: 16px;
        }

        .logo-icon {
            max-height: 60px;
            border-radius: 50%;
        }

        .stats-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            min-height: 150px;
        }

        .stats-box {
            background: <?php echo $theme == 'dark' ? '#2e2e3f' : '#ffffff'; ?>;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin: 10px;
            width: 250px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: slideIn 1s ease;
            cursor: pointer;
        }

        .stats-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stats-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
            color: <?php echo $theme == 'dark' ? '#ffffff' : '#333'; ?>;
        }

        .stats-value {
            font-size: 28px;
            font-weight: bold;
            color: <?php echo $theme == 'dark' ? '#ff6f61' : '#4b79a1'; ?>;
        }

        .stats-icon {
            font-size: 40px; /* Ukuran logo lebih besar */
            margin-bottom: 10px;
        }

        .footer-text {
            background: <?php echo $theme == 'dark' ? '#1f1f2e' : '#e8e8f1'; ?>;
            color: <?php echo $theme == 'dark' ? '#bcbcbc' : '#4b4b4b'; ?>;
            padding: 20px;
            margin-top: 40px;
            border-radius: 15px;
            text-align: center;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .footer-text strong {
            color: <?php echo $theme == 'dark' ? '#ff6f61' : '#283e51'; ?>;
        }
       /* 🚀 Motor Melaju ke Kiri */
@keyframes ride-left {
  0% { transform: translateX(0) rotate(0deg); }
  25% { transform: translateX(-20px) rotate(2deg); }
  50% { transform: translateX(-40px) rotate(-2deg); }
  75% { transform: translateX(-60px) rotate(2deg); }
  100% { transform: translateX(-80px) rotate(0deg); }
}

/* 👤 Customer: Efek Melompat */
@keyframes bounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}

/* 💰 Transaksi: Efek Getar */
@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-3px) rotate(-5deg); }
  50% { transform: translateX(3px) rotate(5deg); }
  75% { transform: translateX(-3px) rotate(-5deg); }
}

/* Terapkan ke emoji masing-masing */
.stats-box[href*="../produk/"] .stats-icon {
  display: inline-block;
  animation: ride-left 1.5s ease-in-out infinite;
}

.stats-box[href*="../customer/"] .stats-icon {
  display: inline-block;
  animation: bounce 1.2s ease-in-out infinite;
}

.stats-box[href*="../transaksi/"] .stats-icon {
  display: inline-block;
  animation: shake 0.8s ease-in-out infinite;
}


    </style>
</head>
<body>

<div class="container dashboard-container">
    <div class="row">
        <!-- Welcome Header -->
        <div class="col-12 dashboard-header">
            <div>
                <h4>Welcome, <?php echo $_SESSION['nama']; ?>!</h4>
                <p>Dealer management dashboard for <?php echo $_SESSION['level']; ?>.</p>
            </div>
            <div>
                <img src="../themes/fobia/assets/images/logo-dashboard.png" class="logo-icon" alt="logo icon">
            </div>
        </div>

         <!-- Stats for Customer, Produk, and Transaksi -->
         <div class="col-12 stats-container">
            <?php if ($_SESSION['level'] == 'Admin' || $_SESSION['level'] == 'Kasir') : ?>
                <a href="../customer/" class="stats-box">
                    <div class="stats-icon">👤</div>
                    <div class="stats-title">Jumlah Customer</div>
                    <div class="stats-value"><?php echo $customerCount; ?></div>
                </a>
            <?php endif; ?>

            <?php if ($_SESSION['level'] == 'Admin' || $_SESSION['level'] == 'User') : ?>
                <a href="../produk/" class="stats-box">
                    <div class="stats-icon">🏍️💨</div>
                    <div class="stats-title">Jumlah Produk</div>
                    <div class="stats-value"><?php echo $productCount; ?></div>
                </a>
            <?php endif; ?>

            <?php if ($_SESSION['level'] == 'Admin' || $_SESSION['level'] == 'Kasir') : ?>
                <a href="../transaksi/" class="stats-box">
                    <div class="stats-icon">💰</div>
                    <div class="stats-title">Jumlah Transaksi</div>
                    <div class="stats-value"><?php echo $transactionCount; ?></div>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer Text -->
    <div class="footer-text">
        <p>
            Dashboard ini dirancang untuk memberikan <strong>kemudahan</strong> dan <strong>efisiensi</strong> dalam 
            pengelolaan data <strong>dealer</strong>. Klik tombol untuk memudahkan anda dapat mengelola data customer, produk, 
            dan transaksi dengan cepat dan akurat🚀🔥
        </p>
    </div>
</div>

<?php
getFooter($theme, "");
?>

</body>
</html>
