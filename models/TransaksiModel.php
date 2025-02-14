<?php

include_once('../db/database.php');

class TransaksiModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addTransaksi($nomor_transaksi, $nomor_customer, $kode_produk, $tanggal_transaksi, $jumlah, $total_harga)
    {
        $sql = "INSERT INTO transaksi (nomor_transaksi, nomor_customer, kode_produk, tanggal_transaksi, jumlah, total_harga) VALUES (:nomor_transaksi, :nomor_customer, :kode_produk, :tanggal_transaksi, :jumlah, :total_harga)";
        $params = array(
          ":nomor_transaksi" => $nomor_transaksi,
          ":nomor_customer" => $nomor_customer,
          ":kode_produk" => $kode_produk,
          ":tanggal_transaksi" => $tanggal_transaksi,
          ":jumlah" => $jumlah,
          ":total_harga" => $total_harga
        );

        $result= $this->db->executeQuery($sql, $params);
        // Check if the insert was successful
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
    
        // Return the response as JSON
        return json_encode($response);
    }

    public function getTransaksi($id)
    {
        $sql = "SELECT * FROM transaksi WHERE id = :id";
        $params = array(":id" => $id);

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateTransaksi($id, $nomor_transaksi, $nomor_customer, $kode_produk, $tanggal_transaksi, $jumlah, $total_harga)
    {
        $sql = "UPDATE transaksi SET nomor_transaksi = :nomor_transaksi, nomor_customer = :nomor_customer, kode_produk = :kode_produk, tanggal_transaksi = :tanggal_transaksi, jumlah = :jumlah, total_harga = :total_harga WHERE id = :id";
        $params = array(
          ":nomor_transaksi" => $nomor_transaksi,
          ":nomor_customer" => $nomor_customer,
          ":kode_produk" => $kode_produk,
          ":tanggal_transaksi" => $tanggal_transaksi,
          ":jumlah" => $jumlah,
          ":total_harga" => $total_harga,
          ":id" => $id
        );
    
        // Execute the query
        $result = $this->db->executeQuery($sql, $params);
    
        // Check if the update was successful
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
    
        // Return the response as JSON
        return json_encode($response);
    }
    

    public function deleteTransaksi($id)
    {
        $sql = "DELETE FROM transaksi WHERE id = :id";
        $params = array(":id" => $id);

        $result = $this->db->executeQuery($sql, $params);
        // Check if the delete was successful
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
    
        // Return the response as JSON
        return json_encode($response);
    }

    public function getTransaksiList()
    {
        $sql = 'SELECT * FROM transaksi limit 100';
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDataCombo()
    {
        $sql = 'SELECT * FROM transaksi';
        $data = array();
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
