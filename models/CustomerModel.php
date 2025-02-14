<?php

include_once('../db/database.php');

class CustomerModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addCustomer($nomor_customer, $nama_customer, $alamat, $telepon)
    {
        $sql = "INSERT INTO customer (nomor_customer, nama_customer, alamat, telepon) VALUES (:nomor_customer, :nama_customer, :alamat, :telepon)";
        $params = array(
          ":nomor_customer" => $nomor_customer,
          ":nama_customer" => $nama_customer,
          ":alamat" => $alamat,
          ":telepon" => $telepon
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

    public function getCustomer($id)
    {
        $sql = "SELECT * FROM customer WHERE id = :id";
        $params = array(":id" => $id);

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCustomer($id, $nomor_customer, $nama_customer, $alamat, $telepon)
    {
        $sql = "UPDATE customer SET nomor_customer = :nomor_customer, nama_customer = :nama_customer, alamat = :alamat, telepon = :telepon WHERE id = :id";
        $params = array(
          ":nomor_customer" => $nomor_customer,
          ":nama_customer" => $nama_customer,
          ":alamat" => $alamat,
          ":telepon" => $telepon,
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
    

    public function deleteCustomer($id)
    {
        $sql = "DELETE FROM customer WHERE id = :id";
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

    public function getCustomerList()
    {
        $sql = 'SELECT * FROM customer limit 100';
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDataCombo()
    {
        $sql = 'SELECT * FROM customer';
        $data = array();
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
