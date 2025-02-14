<?php
include("../controllers/Transaksi.php");
include("../lib/functions.php");
$obj = new TransaksiController();
$rows = $obj->gettransaksiList();
$theme = setTheme();
getHeader($theme);
?>

<div class="header icon-and-heading">
<i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
<h2><strong>transaksi</strong> <small>List All Data</small> </h2>
</div>
<hr style="margin-bottom:-2px;"/>
<a style="margin:10px 0px;" class="btn btn-large btn-info" href="add.php"><i class="fa fa-plus"></i> Create New Data</a>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>id</th>
<th>nomor_transaksi</th>
<th>nomor_customer</th>
<th>kode_produk</th>
<th>tanggal_transaksi</th>
<th>jumlah</th>
<th>total_harga</th>
            <th width="140">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($rows as $row){ ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
<td><?php echo $row["nomor_transaksi"]; ?></td>
<td><?php echo $row["nomor_customer"]; ?></td>
<td><?php echo $row["kode_produk"]; ?></td>
<td><?php echo $row["tanggal_transaksi"]; ?></td>
<td><?php echo $row["jumlah"]; ?></td>
<td><?php echo $row["total_harga"]; ?></td>
            <td class="text-center" width="200">
                <a class="btn btn-info btn-sm" href="edit.php?id=<?php echo $row['id']; ?>">
                    <i class="fa fa-pencil"></i>
                </a>
                <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $row['id']; ?>">
                    <i class="fa fa-trash"></i>
                </a>
                <a class="btn btn-success btn-sm" href="order.php?id=<?php echo $row['id']; ?>">
                    <i class="fa fa-shopping-cart"></i>
                </a>

            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php
getFooter($theme, "");
?>
