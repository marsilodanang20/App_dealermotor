<?php
include_once('../models/ProdukModel.php');

class ProdukController
{
    private $model;

    public function __construct()
    {
        $this->model = new ProdukModel();
    }

    public function addProduk($kode_produk, $nama_produk, $harga, $stok)
    {
        return $this->model->addProduk($kode_produk, $nama_produk, $harga, $stok);
    }

    public function getProduk($id)
    {
        return $this->model->getProduk($id);
    }

    public function Show($id)
    {
        $rows = $this->model->getProduk($id);
        foreach($rows as $row){
            $val = $row['nama'];
        }
        return $val;
    }

    public function updateProduk($id, $kode_produk, $nama_produk, $harga, $stok)
    {
        return $this->model->updateProduk($id, $kode_produk, $nama_produk, $harga, $stok);
    }

    public function deleteProduk($id)
    {
        return $this->model->deleteProduk($id);
    }

    // Modifikasi fungsi getProdukList agar menerima parameter pencarian
    public function getProdukList($search = '')
    {
        return $this->model->getProdukList($search);
    }
    
    public function getDataCombo()
    {
        return $this->model->getDataCombo();
    }
}
