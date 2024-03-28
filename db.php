<?php

// Veritabanı bilgileri
$host = "localhost:3307";
$username = "root";
$password = "Abcd.1234";
$database = "test";

// Veritabanı bağlantısını oluştur
$conn = new mysqli($host, $username, $password, $database);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}

// Türkçe karakter desteği
$conn->set_charset("utf8");

// Kullanıcı kaydı işlevi
function register($username, $password, $birthdate, $age) {
    global $conn;
    // Kullanıcı bilgilerini veritabanına ekle
    $sql = "INSERT INTO user (username, password, birthdate, age) VALUES ('$username', '$password', '$birthdate', '$age')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Kullanıcı girişi işlevi
function login($username, $password) {
    global $conn;
    // Kullanıcı adı ve şifre veritabanında kontrol edilir
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        // Oturum başlatma kontrolü
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        return true;
    } else {
        // Kullanıcı yoksa hata döndür
        return false;
    }
}

// Kullanıcı adlarını getiren fonksiyon
function getUsernames() {
    global $conn;
    $usernames = array();

    $sql = "SELECT username FROM user";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $usernames[] = $row["username"];
        }
    }

    return $usernames;
}
?>
