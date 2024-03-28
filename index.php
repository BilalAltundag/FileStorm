<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <!-- Bootstrap 5 CSS dosyası -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sayfa içeriğini ortala */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa; /* Arka plan rengi */
            color: #000; /* Yazı rengi */
        }
        /* Başlık stilini belirle */
        .title {
            color: #000; /* Başlık rengi */
            font-size: 3rem; /* Başlık font boyutu */
            margin-bottom: 30px; /* Başlık alt boşluğu */
        }
        /* Düğmelerin stilini belirle */
        .btn-container {
            margin-top: 20px; /* Düğmeler üst boşluğu */
        }
        /* Logo stilini belirle */
        .logo-container {
            margin-bottom: 20px; /* Logo alt boşluğu */
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <div class="logo-container">
            <img src="https://img.freepik.com/free-vector/bird-colorful-logo-gradient-vector_343694-1365.jpg?size=338&ext=jpg&ga=GA1.1.735520172.1711411200&semt=ais" alt="Logo" width="150">
        </div>
        <h1 class="title">Dosya Yükleme Platformu</h1>
        <?php if(isset($_SESSION['loggedin'])): ?>
            <div class="btn-container">
                <a href="profile.php" class="btn btn-primary btn-lg">Profilime Git</a>
                <a href="logout.php" class="btn btn-danger btn-lg">Çıkış Yap</a>
            </div>
        <?php else: ?>
            <div class="btn-container">
                <a href="login.php" class="btn btn-primary btn-lg">Giriş Yap</a>
                <a href="register.php" class="btn btn-success btn-lg">Kayıt Ol</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap 5 JavaScript dosyası (isteğe bağlı) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
