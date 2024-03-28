<?php
include 'db.php';

session_start();

// Oturum açıksa, kullanıcıyı profil sayfasına yönlendir
if (isset($_SESSION['loggedin'])) {
    header("Location: profile.php");
    exit();
}

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kullanıcı girişini kontrol et
    $login_success = login($username, $password);
    if ($login_success) {
        header("Location: profile.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
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
        /* Hatalı giriş mesajları için stil */
        .error-message {
            background-color: #f8d7da; /* Kırmızı arka plan */
            color: #721c24; /* Yazı rengi */
            padding: 10px; /* Dolgu alanı */
            margin-top: 10px; /* Üst boşluk */
            border: 1px solid #f5c6cb; /* Kenarlık */
            border-radius: 5px; /* Kenar yuvarlaklığı */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Giriş Yap</h1>
        <?php if (!isset($_SESSION['loggedin'])) : ?>
            <form action="login.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Kullanıcı Adı</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Şifre</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Giriş Yap</button>
            </form>
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !$login_success) : ?>
                <div class="error-message">
                    Kullanıcı adı veya şifre hatalı.
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Bootstrap 5 JavaScript dosyası (isteğe bağlı) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
