<?php
include "functions.php";

checkLogin();

$role = $_SESSION['role_user'];
$id_user = $_SESSION['id_user'] ?? 0;
$id = $_GET['id'] ?? null;

$conn = connect_db();

if (!$id) {
    echo "<script>alert('ID sepatu tidak ditemukan'); window.location.href='sepatu.php';</script>";
    exit;
}

$sepatu = get_sepatu_by_id($id);

if (!$sepatu) {
    echo "<script>alert('Sepatu tidak ditemukan'); window.location.href='sepatu.php';</script>";
    exit;
}

if ($sepatu['gambar'] && file_exists('src/img/shoe' . $sepatu['gambar'])) {
    unlink('src/img/shoe' . $sepatu['gambar']);
}

// Set variabel global untuk trigger
$conn->query("SET @id_user = $id_user");

// Hapus data dari database menggunakan stored procedure
$stmt = $conn->prepare("CALL delete_sepatu(?)");
$stmt->bind_param("i", $id);
$stmt->execute();

echo "<script>alert('Data sepatu berhasil dihapus'); window.location.href='sepatu.php';</script>";


?>