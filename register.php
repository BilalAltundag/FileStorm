<?php
include 'db.php';

$password_error_message = ""; // Şifre ile ilgili hata mesajı
$username_error_message = ""; // Kullanıcı adı ile ilgili hata mesajı

// Kullanıcı adlarını veritabanından al
$usernames = getUsernames();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $birthdate = $_POST['birthdate'];
    $age = $_POST['age'];

    // Şifre güvenlik kontrolleri
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    // Şifre uygun değilse hata mesajını ayarla
    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        $password_error_message = "Şifreniz en az 8 karakter uzunluğunda olmalı, büyük harf, küçük harf, rakam ve özel karakter içermelidir.";
    } 

    // Kullanıcı adı var mı kontrol et sadece form gönderildiğinde kontrol et
    if (in_array($username, $usernames)) {
        $username_error_message = "Bu kullanıcı adı zaten mevcut. Lütfen farklı bir kullanıcı adı seçin.";
    }

    // Eğer hata mesajları boşsa ve hata yoksa kullanıcıyı kaydet
    if (empty($password_error_message) && empty($username_error_message)) {
        // Kullanıcıyı kaydet
        $register_success = register($username, $password, $birthdate, $age);
        if ($register_success) {
            // Kayıt başarılıysa profil sayfasına yönlendir
            header("Location: profile.php");
            exit();
        } else {
            $username_error_message = "Kullanıcı kaydı sırasında bir hata oluştu.";
        }
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
        .error-message {
            color: red;
            font-size: 0.8rem;
            margin-top: 5px;
        }
        .password-status {
            font-size: 0.8rem;
            margin-top: 5px;
        }
        .password-status.valid {
            color: green;
        }
        .password-status.invalid {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Kayıt Ol</h1>
        <form action="register.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Kullanıcı Adı</label>
                <input type="text" class="form-control" id="username" name="username" onkeyup="checkUsernameAvailability()">
                <div class="error-message" id="username-error-message"><?php echo $username_error_message; ?></div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Şifre</label>
                <input type="password" class="form-control" id="password" name="password" onkeyup="checkPasswordStrength()">
                <div class="error-message" id="password-error-message"><?php echo $password_error_message; ?></div>
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
    <script>
        function checkPasswordStrength() {
            let password = document.getElementById('password').value;
            let errorMessage = document.getElementById('password-error-message');

            let uppercase = /[A-Z]/.test(password);
            let lowercase = /[a-z]/.test(password);
            let number = /[0-9]/.test(password);
            let specialChars = /[^A-Za-z0-9]/.test(password);

            if (!uppercase || !lowercase || !number || !specialChars || password.length < 8) {
                errorMessage.innerHTML = 'Şifreniz en az 8 karakter uzunluğunda olmalı, büyük harf, küçük harf, rakam ve özel karakter içermelidir.';
                errorMessage.style.color = 'red';
            } else {
                errorMessage.innerHTML = '';
            }
        }

        function checkUsernameAvailability() {
            let username = document.getElementById('username').value;
            let errorMessage = document.getElementById('username-error-message');

            errorMessage.innerHTML = ''; // Hata mesajını temizle

            // Kullanıcı adı veritabanından alınan kullanıcı adları içerisinde mi kontrol et
            if (<?php echo json_encode($usernames); ?>.includes(username)) {
                errorMessage.innerHTML = 'Bu kullanıcı adı zaten mevcut. Lütfen farklı bir kullanıcı adı seçin.';
                errorMessage.style.color = 'red';
            }
        }
    </script>
</body>
</html>
