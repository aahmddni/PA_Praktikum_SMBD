<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function checkLogin()
{
    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit();
    }
}

function checkAdmin()
{
    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit();
    }

    if ($_SESSION['role_user'] !== 'admin') {
        header("Location: 404.php");
        exit();
    }
}

function connect_db() {
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "pa_smbd_tokosepatu";
    
    $conn = new mysqli($server, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    return $conn;
}

// View v_detail_sepatu
function get_all_sepatu() {
    $conn = connect_db();
    $sql = "SELECT * FROM v_detail_sepatu ORDER BY nama_sepatu ASC";
    $result = $conn->query($sql);
    
    $data = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    
    $conn->close();
    return $data;
}

function get_sepatu_by_id($id_sepatu) {
    $conn = connect_db();
    $id_sepatu = $conn->real_escape_string($id_sepatu);
    
    $sql = "SELECT * FROM v_detail_sepatu WHERE id_sepatu = '$id_sepatu'";
    $result = $conn->query($sql);
    
    $data = null;
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    }
    
    $conn->close();
    return $data;
}

// View v_detail_transaksi
function get_all_transaksi() {
    $conn = connect_db();
    $sql = "SELECT * FROM v_detail_transaksi ORDER BY tanggal DESC";
    $result = $conn->query($sql);
    
    $data = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    
    $conn->close();
    return $data;
}

function get_transaksi_by_id($id_transaksi) {
    $conn = connect_db();
    $id_transaksi = $conn->real_escape_string($id_transaksi);
    
    $sql = "SELECT * FROM v_detail_transaksi WHERE id_transaksi = '$id_transaksi'";
    $result = $conn->query($sql);
    
    $data = null;
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    }
    
    $conn->close();
    return $data;
}

// View v_stok_menipis
function get_low_stock_items() {
    $conn = connect_db();
    $sql = "SELECT * FROM v_stok_menipis";
    $result = $conn->query($sql);
    
    $data = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    
    $conn->close();
    return $data;
}

// View v_penjualan_per_kategori
function get_sales_by_categories_exclude_null() {
    $conn = connect_db();
    $sql = "SELECT * FROM v_penjualan_per_kategori WHERE jumlah_transaksi IS NOT NULL AND jumlah_transaksi > 0 ORDER BY total_pendapatan DESC";
    $result = $conn->query($sql);
    
    $data = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    
    $conn->close();
    return $data;
}

// View Penjualan perbulan
function get_monthly_sales() {
    $conn = connect_db();
    $sql = "SELECT * FROM v_penjualan_per_bulan ORDER BY tahun DESC, bulan DESC";
    $result = $conn->query($sql);
    
    $data = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    
    $conn->close();
    return $data;
}

// END VIEW

function uploadGambar($file) {
    $targetDir = "./src/img/shoe/";
    $fileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png',];

    if (!in_array($fileType, $allowedTypes)) {
        return false;
    }

    // Generate nama file unik: timestamp + uniqid + ekstensi
    $uniqueName = time() . '_' . uniqid() . '.' . $fileType;
    $targetPath = $targetDir . $uniqueName;

    // Buat folder jika belum ada
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    if (move_uploaded_file($file["tmp_name"], $targetPath)) {
        return $uniqueName; // Simpan nama unik ini ke database
    }

    return false;
}

function get_all_categories() {
    $conn = connect_db();
    $kategori = [];
    $query = "SELECT * FROM kategori ORDER BY kategori ASC";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $kategori[] = $row;
        }
    }

    return $kategori;
}

function get_jumlah_pegawai() {

    $conn = connect_db();
    $jumlah = 0;

    // Panggil stored procedure
    $query = "CALL HitungJumlahPegawai()";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        $jumlah = $row['jumlah_pegawai'] ?? 0;
        $result->free();
    }

    // Karena setelah CALL mungkin ada lebih dari satu resultset, bersihkan sisa
    while ($conn->more_results() && $conn->next_result()) {
        $conn->use_result();
    }

    return $jumlah;
}


function get_sepatu_terbaru( $limit) {
    $conn = connect_db();
    $sepatu = [];

    $stmt = $conn->prepare("CALL get_sepatu_terbaru(?)");
    $stmt->bind_param("i", $limit);
    $stmt->execute();

    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $sepatu[] = $row;
    }

    $stmt->close();

    // Bersihkan result set tambahan dari stored procedure
    while ($conn->more_results() && $conn->next_result()) {
        $conn->use_result();
    }

    return $sepatu;
}
