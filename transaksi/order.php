<?php
include("../controllers/Transaksi.php");
include("../controllers/Customer.php");
include("../controllers/Produk.php");
include("../lib/functions.php");

$obj = new TransaksiController();
$customer = new CustomerController();
$produk = new ProdukController();

// Ambil data transaksi berdasarkan ID
if(isset($_GET["id"])){
    $id = $_GET["id"];
}


if (isset($_GET['export_pdf']) && $_GET['export_pdf'] == 'true') {
    require_once('../vendor/autoload.php');
    
    $dompdf = new Dompdf\Dompdf();
    $html = ''; // Tempat untuk menyimpan HTML untuk PDF
    
    // Buat HTML untuk PDF 
    $html .= '
    <html>
    <head>
        <style>
            body {
                font-family: "Arial", sans-serif;
                color: #333;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }
            .container {
                width: 80%;
                margin: 30px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            h1 {
                text-align: center;
                color: #1a73e8;
                font-size: 24px;
            }
            .detail {
                margin-bottom: 20px;
            }
            .detail p {
                font-size: 14px;
                margin: 8px 0;
                line-height: 1.5;
            }
            .detail strong {
                width: 200px;
                display: inline-block;
                color: #333;
            }
            .table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            .table th, .table td {
                padding: 8px 12px;
                border: 1px solid #ddd;
                text-align: left;
                font-size: 14px;
            }
            .table th {
                background-color: #f0f0f0;
                color: #333;
            }
            .table td {
                background-color: #fff;
            }
            .footer {
                text-align: center;
                font-size: 12px;
                color: #777;
                margin-top: 30px;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <h1>Detail Transaksi #'.$id.'</h1>';
    
    $rows = $obj->getTransaksi($id);
    $list_customer = $customer->getCustomerList();
    $list_produk = $produk->getProdukList();
    
    foreach ($rows as $row) {
        $html .= '
        <div class="detail">
            <p><strong>Bukti Transaksi:</strong> ' . htmlspecialchars($row['nomor_transaksi']) . '</p>
            <p><strong>Nomor Customer:</strong> ' . htmlspecialchars($row['nomor_customer']) . '</p>
            <p><strong>Nama Customer:</strong> ';
        
        foreach ($list_customer as $cust) {
            if ($row['nomor_customer'] == $cust['nomor_customer']) {
                $html .= htmlspecialchars($cust['nama_customer']);
                break;
            }
        }

        $html .= '</p>
            <p><strong>Kode Produk:</strong> ' . htmlspecialchars($row['kode_produk']) . '</p>
            <p><strong>Nama Produk:</strong> ';
        
        foreach ($list_produk as $prod) {
            if ($row['kode_produk'] == $prod['kode_produk']) {
                $html .= htmlspecialchars($prod['nama_produk']);
                break;
            }
        }

        $html .= '</p>
            <p><strong>Tanggal Transaksi:</strong> ' . htmlspecialchars($row['tanggal_transaksi']) . '</p>
            <p><strong>Jumlah:</strong> ' . htmlspecialchars($row['jumlah']) . '</p>
            <p><strong>Total Harga:</strong> ' . htmlspecialchars($row['total_harga']) . '</p>
        </div>';

        // Menambahkan tabel untuk detail produk 
        $html .= '
        <table class="table">
            <tr>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
            </tr>
            <tr>
                <td>' . htmlspecialchars($row['kode_produk']) . '</td>
                <td>' . htmlspecialchars($prod['nama_produk']) . '</td>
                <td>' . htmlspecialchars($prod['harga']) . '</td>
                <td>' . htmlspecialchars($row['jumlah']) . '</td>
                <td>' . htmlspecialchars($row['total_harga']) . '</td>
            </tr>
        </table>';
    }

    $html .= '
        <div class="footer">
            <p>&copy; ' . date("Y") . ' Detail Transaksi Advantage Dealer Motor</p>
        </div>
    </div>
    </body>
    </html>';

    // Load HTML ke Dompdf
    $dompdf->loadHtml($html);
    
    // Set ukuran kertas (A4 misalnya)
    $dompdf->setPaper('A4', 'portrait');
    
    // Render PDF 
    $dompdf->render();
    
    // Output PDF ke browser
    $dompdf->stream("transaksi_$id.pdf", array("Attachment" => 0)); 
    exit();
}

$rows = $obj->getTransaksi($id);
$list_customer = $customer->getCustomerList();
$list_produk = $produk->getProdukList();
$theme = setTheme();
getHeader($theme);
?>
<!-- Tambahkan Font Awesome CDN jika belum -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Menambahkan CDN Font Awesome untuk ikon -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="header icon-and-heading">
    <i class="zmdi zmdi-shopping-cart zmdi-hc-4x custom-icon"></i>
    <h2><strong>Detail Transaksi</strong></h2>
</div>
<hr style="margin-bottom:-2px;"/>

<?php if (empty($rows)): ?>
    <div class="alert alert-danger" style="display: block" id="message_error">Data transaksi tidak ditemukan.</div>
<?php else: ?>
    <?php foreach ($rows as $row): ?>
        <div class="card">
            <div class="card-header">
                <strong>No Transaksi #<?php echo htmlspecialchars($row['nomor_transaksi']); ?></strong>
            </div>
            <div class="card-body">
                <p><strong>Nomor Customer:</strong> <?php echo htmlspecialchars($row['nomor_customer']); ?></p>
                <p><strong>Nama Customer:</strong> 
                    <?php 
                        foreach ($list_customer as $cust) {
                            if ($row['nomor_customer'] == $cust['nomor_customer']) {
                                echo htmlspecialchars($cust['nama_customer']);
                                break;
                            }
                        }
                    ?>
                </p>
                <p><strong>Kode Produk:</strong> <?php echo htmlspecialchars($row['kode_produk']); ?></p>
                <p><strong>Nama Produk:</strong> 
                    <?php 
                        foreach ($list_produk as $prod) {
                            if ($row['kode_produk'] == $prod['kode_produk']) {
                                echo htmlspecialchars($prod['nama_produk']);
                                break;
                            }
                        }
                    ?>
                </p>
                <p><strong>Tanggal Transaksi:</strong> <?php echo htmlspecialchars($row['tanggal_transaksi']); ?></p>
                <p><strong>Jumlah:</strong> <?php echo htmlspecialchars($row['jumlah']); ?></p>
                <p><strong>Total Harga:</strong> <?php echo htmlspecialchars($row['total_harga']); ?></p>
            </div>
        </div>
        <br/>
    <?php endforeach; ?>
<?php endif; ?>

<!-- Tombol Kembali dan Export to PDF berdampingan di bawah -->
<div class="d-flex justify-content-start" style="margin-top: 20px;">
    <!-- Tombol Kembali dengan ikon -->
<a href="index.php" class="btn btn-info" style="padding: 10px 20px; margin-right: 10px;">
    <i class="fas fa-arrow-left"></i> Kembali
</a>

    <!-- Tombol Export to PDF -->
    <a href="Order.php?id=<?php echo $id; ?>&export_pdf=true" class="btn btn-success" style="padding: 10px 20px;">
        <i class="fa fa-file-pdf"></i> Cetak PDF
    </a>
</div>

<?php getFooter($theme, "<script src='../lib/forms.js'></script>"); ?>

</body>
</html>
