<?php

include_once('../db/database.php');

class ProdukModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addProduk($kode_produk, $nama_produk, $harga, $stok)
    {
        $sql = "INSERT INTO produk (kode_produk, nama_produk, harga, stok) VALUES (:kode_produk, :nama_produk, :harga, :stok)";
        $params = array(
            ":kode_produk" => $kode_produk,
            ":nama_produk" => $nama_produk,
            ":harga" => $harga,
            ":stok" => $stok
        );

        $result = $this->db->executeQuery($sql, $params);

        if ($result) {
            $response = array(
                "success" => true,
                "message" => "Insert successful"
            );
        } else {
            $response = array(
                "success" => false,
                "message" => "Insert failed"
            );
        }

        return json_encode($response);
    }

    public function getProduk($id)
    {
        $sql = "SELECT * FROM produk WHERE id = :id";
        $params = array(":id" => $id);

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateProduk($id, $kode_produk, $nama_produk, $harga, $stok)
    {
        $sql = "UPDATE produk SET kode_produk = :kode_produk, nama_produk = :nama_produk, harga = :harga, stok = :stok WHERE id = :id";
        $params = array(
            ":kode_produk" => $kode_produk,
            ":nama_produk" => $nama_produk,
            ":harga" => $harga,
            ":stok" => $stok,
            ":id" => $id
        );

        $result = $this->db->executeQuery($sql, $params);

        if ($result) {
            $response = array(
                "success" => true,
                "message" => "Update successful"
            );
        } else {
            $response = array(
                "success" => false,
                "message" => "Update failed"
            );
        }

        return json_encode($response);
    }

    public function deleteProduk($id)
    {
        $sql = "DELETE FROM produk WHERE id = :id";
        $params = array(":id" => $id);

        $result = $this->db->executeQuery($sql, $params);

        if ($result) {
            $response = array(
                "success" => true,
                "message" => "Delete successful"
            );
        } else {
            $response = array(
                "success" => false,
                "message" => "Delete failed"
            );
        }

        return json_encode($response);
    }

    // Fungsi untuk pencarian
    public function getProdukList($search = '')
    {
        $sql = "SELECT * FROM produk 
                WHERE kode_produk LIKE :search 
                OR nama_produk LIKE :search 
                OR harga LIKE :search 
                OR stok LIKE :search
                LIMIT 100";
        $params = array(
            ":search" => '%' . $search . '%'
        );

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDataCombo()
    {
        $sql = 'SELECT * FROM produk';
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
