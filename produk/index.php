<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../controllers/Produk.php");
include("../lib/functions.php");
use Dompdf\Dompdf;
use Dompdf\Options;

$obj = new ProdukController();

// Fungsi search
$search = isset($_GET['search']) ? $_GET['search'] : '';

$rows = $obj->getprodukList($search);

// Export PDF
if (isset($_GET['export_pdf'])) {
    // Disesuaikan dengan fitur search
    $rows = $obj->getprodukList($search);

    // HTML untuk data yang akan diekspor
    $html = '<div style="text-align:center;">';
    $html .= '<h1 style="display:inline-block;">Daftar Produk</h1>';
    $html .= '</div>';
    $html .= '<table border="1" cellpadding="5" cellspacing="0" style="width:100%; border-collapse: collapse; text-align:center; margin-top: 20px;">';
    $html .= '<thead><tr><th>ID</th><th>Kode Produk</th><th>Nama Produk</th><th>Harga</th><th>Stok</th></tr></thead>';
    $html .= '<tbody>';

    foreach ($rows as $row) {
        $html .= '<tr>';
        $html .= '<td>' . $row["id"] . '</td>';
        $html .= '<td>' . $row["kode_produk"] . '</td>';
        $html .= '<td>' . $row["nama_produk"] . '</td>';
        $html .= '<td>' . $row["harga"] . '</td>';
        $html .= '<td>' . $row["stok"] . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';

    // footer
    $html .= '<div style="position:fixed; bottom:0; width:100%; text-align:center; padding:10px; font-size:12px; background-color:#f1f1f1; border-top:1px solid #ddd;">';
    $html .= 'Daftar Produk Advantage Dealer Motor - All Rights Reserved © 2025';
    $html .= '</div>';

    // DOMPDF untuk menghasilkan PDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    // Menampilkan PDF
    $dompdf->stream('daftar_produk.pdf');
    exit;  
}

$theme = setTheme();
getHeader($theme);

// Mengecek level pengguna
$level = isset($_SESSION['level']) ? $_SESSION['level'] : '';

?>

<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Produk</strong> <small>List All Data</small></h2>
</div>
<hr style="margin-bottom:-2px;"/>

<!-- Tombol Cari -->
<form method="get" action="index.php" class="d-flex align-items-center" style="margin: 10px 0;">
    <div class="position-relative">
        <input type="text" name="search" value="<?php echo $search; ?>" class="form-control pe-5 rounded-pill" placeholder="Search...">
        <button type="submit" class="btn btn-primary position-absolute top-50 end-0 translate-middle-y rounded-pill px-4">
            <i class="bi bi-search"></i>
        </button>
    </div>
</form>

<!-- Pastikan Anda menyertakan ikon Bootstrap untuk search -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">



<!-- Tombol Download PDF -->
<a href="index.php?export_pdf=true&search=<?php echo $search; ?>" class="btn btn-large btn-success" style="margin: 10px 0px;">
    <i class="fas fa-file-pdf"></i> Download PDF
</a>

<!-- Tombol Create New Data hanya jika level bukan User -->
<?php if ($level != 'User') { ?>
    <a style="margin:10px 0px;" class="btn btn-large btn-info" href="add.php"><i class="fa fa-plus"></i> Create New Data</a>
<?php } ?>

<table class="table table-bordered table-striped">
    <thead>
    <!-- CDN Tombol Download PDF -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <!-- Font Awesome 6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Font Awesome 6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


        <tr>
            <th>id</th>
            <th>kode_produk</th>
            <th>nama_produk</th>
            <th>harga</th>
            <th>stok</th>
            <th width="140">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php if (empty($rows)) { ?>
        <tr>
            <td colspan="6" class="text-center">No data found.</td>
        </tr>
    <?php } else { ?>
        <?php foreach($rows as $row){ ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["kode_produk"]; ?></td>
            <td><?php echo $row["nama_produk"]; ?></td>
            <td><?php echo $row["harga"]; ?></td>
            <td><?php echo $row["stok"]; ?></td>
            <td class="text-center" width="200">
                <!-- Tampilkan tombol Edit dan Delete jika yang login level selain User -->
                <?php if ($level != 'User') { ?>
                    <a class="btn btn-info btn-sm" href="edit.php?id=<?php echo $row['id']; ?>">
                        <i class="fa fa-pencil-alt"></i> Edit
                    </a>

                    <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $row['id']; ?>">
                        <i class="fas fa-trash"></i> Delete
                    </a>
                <?php } else { ?>
                    <!-- Jika level User, tampilkan hanya View -->
                    <span class="btn btn-info btn-sm disabled"><i class="fa fa-eye"></i> View</span>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    <?php } ?>
    </tbody>
</table>

<?php
getFooter($theme, "");
?>


