<?php

include_once('db/database.php');

class LoginModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Validasi login
    public function login_validation($email, $sandi)
    {
        $sql = "SELECT id, email, nama, sandi, level FROM users WHERE email = :email";
        $params = array(":email" => $email);
        $stmt = $this->db->executeQuery($sql, $params);

        if ($stmt !== false && !empty($stmt)) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $row['sandi'];
            $nama = $row['nama'];
            $level = $row['level'];

            if (password_verify($sandi, $hashed_password)) { // verify passwords
                $_SESSION['nama'] = $nama;
                $_SESSION['email'] = $email;
                $_SESSION['level'] = $level; // Menyimpan level dalam session

                $response = array(
                    "success" => true,
                    "message" => "Login successful"
                );
            } else {
                $response = array(
                    "success" => false,
                    "message" => "Invalid password"
                );
            }
        } else {
            $response = array(
                "success" => false,
                "message" => "User not found"
            );
        }

        return json_encode($response);
    }

    // Menambahkan pengguna baru dengan level
    public function addUsers($email, $nama, $sandi, $level)
    {
        $sql = "INSERT INTO users (email, nama, sandi, level) VALUES (:email, :nama, :sandi, :level)";
        $pwd = password_hash($sandi, PASSWORD_BCRYPT); // Enkripsi password
        $params = array(
            ":email" => $email,
            ":nama" => $nama,
            ":sandi" => $pwd,
            ":level" => $level, // Menyisipkan level ke dalam query
        );

        $result = $this->db->executeQuery($sql, $params);

        // Mengecek apakah proses insert berhasil
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

        // Mengembalikan response dalam bentuk JSON
        return json_encode($response);
    }

    // Menambahkan metode getUserLevels() untuk mengambil semua level
    public function getUserLevels()
    {
        $sql = "SELECT DISTINCT level FROM users";
        $stmt = $this->db->executeQuery($sql);

        if ($stmt !== false && !empty($stmt)) {
            $levels = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $levels[] = $row['level'];
            }
            return $levels;
        }
        return []; // Mengembalikan array kosong jika tidak ada level
    }
}
