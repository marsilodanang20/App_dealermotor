<?php
include_once('../models/CustomerModel.php');

class CustomerController
{
    private $model;

    public function __construct()
    {
        $this->model = new CustomerModel();
    }

    public function addCustomer($nomor_customer, $nama_customer, $alamat, $telepon)
    {
        return $this->model->addCustomer($nomor_customer, $nama_customer, $alamat, $telepon);
    }

    public function getCustomer($id)
    {
        return $this->model->getCustomer($id);
    }

    public function Show($id)
    {
        $rows = $this->model->getCustomer($id);
        foreach($rows as $row){
            $val = $row['nama'];
        }
        return $val;
    }

    public function updateCustomer($id, $nomor_customer, $nama_customer, $alamat, $telepon)
    {
        return $this->model->updateCustomer($id, $nomor_customer, $nama_customer, $alamat, $telepon);
    }

    public function deleteCustomer($id)
    {
        return $this->model->deleteCustomer($id);
    }

    public function getCustomerList()
    {
        return $this->model->getCustomerList();
    }
    
    public function getDataCombo()
    {
        return $this->model->getDataCombo();
    }
}
