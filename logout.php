<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Çıkış Yap</title>
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
        <div class="alert alert-success" role="alert">
            Başarıyla çıkış yapıldı. Ana sayfaya yönlendiriliyorsunuz...
        </div>
    </div>

    <!-- Bootstrap 5 JavaScript dosyası (isteğe bağlı) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Ana sayfaya yönlendirme
        setTimeout(function(){
            window.location.href = "index.php";
        }, 3000); // 3 saniye bekletme süresi
    </script>
</body>
</html>