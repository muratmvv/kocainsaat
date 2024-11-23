<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "ankarayi_06";
$password = "Yikimkirim06";
$dbname = "ankarayi_06";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ad, soyad, yorum, puan FROM yorumlar ORDER BY id DESC";
$result = $conn->query($sql);

$feedbacks = [];
while ($row = $result->fetch_assoc()) {
    $feedbacks[] = $row;
}

echo json_encode($feedbacks);

$conn->close();
?>
