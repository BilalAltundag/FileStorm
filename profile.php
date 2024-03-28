<?php
include 'db.php';
session_start();

// Kullanıcı giriş yapmadıysa, login sayfasına yönlendir
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username='$username'";
$result = $conn->query($sql);

// Profil resmi yükleme
if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0){
    $errors= array();
    $file_name_parts = explode('.', $_FILES['profile_image']['name']);
    $file_ext = strtolower(end($file_name_parts));
    $file_size =$_FILES['profile_image']['size'];
    $file_tmp =$_FILES['profile_image']['tmp_name'];
    $file_type=$_FILES['profile_image']['type'];
    
    $extensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$extensions)=== false){
       $errors[]="Uzantı sadece JPEG, JPG ve PNG dosyaları için geçerlidir.";
    }
    
    if($file_size > 2097152) {
       $errors[]='Dosya boyutu 2 MB\'ı geçemez';
    }
    
    if(empty($errors)==true) {
        // Kullanıcı adına göre klasör oluşturma
        $target_dir = "profile_images/$username/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        // Mevcut dosyaları sil
        $existing_files = glob($target_dir . "*.{jpg,jpeg,png}", GLOB_BRACE);
        foreach ($existing_files as $file) {
            unlink($file);
        }
        // Yeni dosyayı yükle
        move_uploaded_file($file_tmp,$target_dir.$_FILES['profile_image']['name']);
    } else {
        print_r($errors);
    }
}

// CV yükleme
if(isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] === 0){
    $errors= array();
    $file_name_parts = explode('.', $_FILES['cv_file']['name']);
    $file_ext = strtolower(end($file_name_parts));
    $file_size =$_FILES['cv_file']['size'];
    $file_tmp =$_FILES['cv_file']['tmp_name'];
    $file_type=$_FILES['cv_file']['type'];
    
    $extensions= array("pdf");
    
    if(in_array($file_ext,$extensions)=== false){
       $errors[]="Sadece PDF dosyaları için geçerlidir.";
    }
    
    if($file_size > 2097152) {
       $errors[]='Dosya boyutu 2 MB\'ı geçemez';
    }
    
    if(empty($errors)==true) {
        // Kullanıcı adına göre klasör oluşturma
        $target_dir = "cv_files/$username/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        // Mevcut dosyaları sil
        $existing_files = glob($target_dir . "*.pdf");
        foreach ($existing_files as $file) {
            unlink($file);
        }
        // Yeni dosyayı yükle
        move_uploaded_file($file_tmp,$target_dir.$_FILES['cv_file']['name']);
    } else {
        print_r($errors);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
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

        .upload-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border: 2px dashed #ccc;
            padding: 20px;
            width: 325px;
            height: 350px;
            margin: 20px auto;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Profil</h1>
        <?php if ($result && $result->num_rows > 0) : ?>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <!-- Kullanıcı Bilgileri -->
                <p>Kullanıcı Adı: <?php echo $row["username"]; ?></p>
                <p>Doğum Tarihi: <?php echo $row["birthdate"]; ?></p>
                <p>Yaş: <?php echo $row["age"]; ?></p>

                <!-- Profil Resmi Yükleme Formu -->
                <!-- Profil Resmi Yükleme Formu -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="upload-container">
                        <p>Profil Resmi</p>
                        <?php
                        $profile_image_path = "profile_images/$username/";
                        $profile_images = glob($profile_image_path . "*.{jpg,jpeg,png}", GLOB_BRACE);
                        $latest_profile_image = end($profile_images);
                        if ($latest_profile_image !== false) {
                            echo '<img src="' . $latest_profile_image . '" alt="Profil Resmi" width="150" height="150">';
                        } else {
                            echo '<p>......</p>';
                        }
                        ?>
                        <br> <!-- Boşluk ekledik -->
                        <input type="file" id="profile_image" name="profile_image" style="display: inline;">
                        <br> <!-- Boşluk ekledik -->
                        <button type="submit" class="btn btn-primary">Resmi Yükle</button>
                    </div>
                </form>

                <!-- CV Yükleme Formu -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="upload-container">
                        <p>CV</p>
                        <?php
                        $cv_file_path = "cv_files/$username/";
                        $cv_files = glob($cv_file_path . "*.pdf");
                        $latest_cv_file = end($cv_files);
                        if ($latest_cv_file !== false) {
                            $cv_file_name = basename($latest_cv_file);
                            echo '<a href="' . $latest_cv_file . '" download>' . $cv_file_name . '</a>';
                        } else {
                            echo '<p>......</p>';
                        }
                        ?>
                        <br> <!-- Boşluk ekledik -->
                        <input type="file" id="cv_file" name="cv_file" style="display: inline;">
                        <br> <!-- Boşluk ekledik -->
                        <button type="submit" class="btn btn-primary">CV Yükle</button>
                    </div>
                </form>
            <?php endwhile; ?>
        <?php else : ?>
            <p>Kullanıcı bulunamadı.</p>
        <?php endif; ?>

        <!-- Ana sayfaya dönüş ve çıkış butonları -->
        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-primary">Ana Sayfa</a>
            <a href="logout.php" class="btn btn-danger">Çıkış Yap</a>
        </div>
    </div>
    <!-- Bootstrap 5 JavaScript dosyası (isteğe bağlı) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
