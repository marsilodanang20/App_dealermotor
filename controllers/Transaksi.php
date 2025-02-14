<?php
include_once('../models/TransaksiModel.php');

class TransaksiController
{
    private $model;

    public function __construct()
    {
        $this->model = new TransaksiModel();
    }

    public function addTransaksi($nomor_transaksi, $nomor_customer, $kode_produk, $tanggal_transaksi, $jumlah, $total_harga)
    {
        return $this->model->addTransaksi($nomor_transaksi, $nomor_customer, $kode_produk, $tanggal_transaksi, $jumlah, $total_harga);
    }

    public function getTransaksi($id)
    {
        return $this->model->getTransaksi($id);
    }

    public function Show($id)
    {
        $rows = $this->model->getTransaksi($id);
        foreach($rows as $row){
            $val = $row['nama'];
        }
        return $val;
    }

    public function updateTransaksi($id, $nomor_transaksi, $nomor_customer, $kode_produk, $tanggal_transaksi, $jumlah, $total_harga)
    {
        return $this->model->updateTransaksi($id, $nomor_transaksi, $nomor_customer, $kode_produk, $tanggal_transaksi, $jumlah, $total_harga);
    }

    public function deleteTransaksi($id)
    {
        return $this->model->deleteTransaksi($id);
    }

    public function getTransaksiList()
    {
        return $this->model->getTransaksiList();
    }
    
    public function getDataCombo()
    {
        return $this->model->getDataCombo();
    }
    
}
