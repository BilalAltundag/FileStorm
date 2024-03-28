<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $birthdate = $_POST['birthdate'];
    $age = $_POST['age'];

    // Kullanıcıyı kaydet
    $register_success = register($username, $password, $birthdate, $age);
    if ($register_success) {
        // Kayıt başarılıysa profil sayfasına yönlendir
        header("Location: profile.php");
        exit();
    } else {
        echo "Kullanıcı kaydı sırasında bir hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <!-- Bootstrap 5 CSS dosyası -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sayfa içeriğini ortala */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Kayıt Ol</h1>
        <form action="register.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Kullanıcı Adı</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3"Q>
                <label for="password" class="form-label">Şifre</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="birthdate" class="form-label">Doğum Tarihi</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Yaş</label>
                <input type="number" class="form-control" id="age" name="age">
            </div>
            <button type="submit" class="btn btn-primary">Kayıt Ol</button>
        </form>
    </div>

    <!-- Bootstrap 5 JavaScript dosyası (isteğe bağlı) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
