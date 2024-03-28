<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifre Değiştir</title>
    <!-- Bootstrap 5 CSS dosyası -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sayfa içeriğini ve arka planı ortala */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #ffffff; /* Yeşil arka plan */
        }

        /* Form container stilini ayarla */
        .container {
            background-color: #fff; /* Beyaz arka plan */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Hafif gölgelendirme */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Şifre Değiştir</h1>
        <?php
        session_start();
        include 'db.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_SESSION['username'];
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            // Eski şifre doğrulaması
            $sql = "SELECT * FROM user WHERE username='$username' AND password='$old_password'";
            $result = $conn->query($sql);
            if ($result->num_rows == 1) {
                // Yeni şifrelerin eşleştiğini kontrol et
                if ($new_password == $confirm_password) {
                    // Yeni şifreyi güncelle
                    $update_sql = "UPDATE user SET password='$new_password' WHERE username='$username'";
                    if ($conn->query($update_sql) === TRUE) {
                        // Şifre başarıyla değiştirildiğinde profil sayfasına yönlendir
                        echo '<div class="alert alert-success" role="alert">Şifre başarıyla değiştirildi. Ana sayfaya yönlendiriliyorsunuz...</div>';
                        echo '<script>setTimeout(function(){ window.location.href = "profile.php"; }, 3000);</script>';
                        exit();
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Şifre değiştirme işlemi sırasında bir hata oluştu.</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">Yeni şifreler eşleşmiyor.</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Eski şifre yanlış.</div>';
            }
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="old_password" class="form-label">Eski Şifre</label>
                <input type="password" class="form-control" id="old_password" name="old_password">
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Yeni Şifre</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Yeni Şifre Tekrar</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            </div>
            <button type="submit" class="btn btn-primary">Şifre Değiştir</button>
        </form>
    </div>

    <!-- Bootstrap 5 JavaScript dosyası (isteğe bağlı) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
