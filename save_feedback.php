<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "ankarayi_06";  // Veritabanı kullanıcı adı
$password = "Yikimkirim06"; // Veritabanı parolanız
$dbname = "ankarayi_06";    // Veritabanı adı

// Bağlantıyı kur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Bağlantı hatası: ' . $conn->connect_error]));
}

// Veriyi al
$ad = isset($_POST['first-name']) ? $_POST['first-name'] : '';
$soyad = isset($_POST['last-name']) ? $_POST['last-name'] : '';
$yorum = isset($_POST['feedback']) ? $_POST['feedback'] : '';
$puan = isset($_POST['rating']) ? $_POST['rating'] : 0;  // Puanı al (0'dan küçük olmaması için varsayılan 0)

// Veritabanına kaydet
if ($ad && $soyad && $yorum && $puan) {
    $stmt = $conn->prepare("INSERT INTO yorumlar (ad, soyad, yorum, puan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $ad, $soyad, $yorum, $puan);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Yorum başarıyla kaydedildi.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Yorum kaydedilirken bir hata oluştu.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Lütfen tüm alanları doldurun.']);
}

$conn->close();
?>
