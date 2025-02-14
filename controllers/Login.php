<?php

include_once('models/LoginModel.php');

class LoginController
{
    private $model;

    public function __construct()
    {
        $this->model = new LoginModel();
    }

    // Validasi login
    public function login_validation($email, $sandi)
    {
        return $this->model->login_validation($email, $sandi);
    }

    // Menambah pengguna baru
    public function addUsers($email, $nama, $sandi, $level)
    {
        return $this->model->addUsers($email, $nama, $sandi, $level);
    }

    // Mendapatkan level pengguna yang tersedia dari database
    public function getUserLevels()
    {
        return $this->model->getUserLevels();
    }
}
