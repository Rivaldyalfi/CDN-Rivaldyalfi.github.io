<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // Validasi input
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message) && isset($_FILES['photo'])) {
        $photo = $_FILES['photo'];
        $photoPath = 'uploads/' . basename($photo['name']);
        
        // Upload file
        if (move_uploaded_file($photo['tmp_name'], $photoPath)) {
            // Kirim email atau simpan ke database
            $to = 'emailanda@example.com';
            $headers = "From: $email";
            $body = "Nama: $name\nSubjek: $subject\nPesan: $message\nLampiran: $photoPath";
            mail($to, $subject, $body, $headers);
            echo 'Pesan Anda telah dikirim!';
        } else {
            echo 'Gagal mengupload file.';
        }
    } else {
        echo 'Semua field harus diisi.';
    }
}
?>
