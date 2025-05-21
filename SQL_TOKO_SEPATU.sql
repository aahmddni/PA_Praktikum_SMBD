CREATE DATABASE pa_smbd_tokosepatu

USE pa_smbd_tokosepatu

CREATE TABLE log_aktivitas (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    aksi VARCHAR(20),
    id_sepatu INT,
    id_user INT,
    waktu DATETIME DEFAULT CURRENT_TIMESTAMP,
    keterangan TEXT
);


CREATE TABLE kategori (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    kategori VARCHAR(50) NOT NULL
);

CREATE TABLE sepatu (
    id_sepatu INT AUTO_INCREMENT PRIMARY KEY,
    nama_sepatu VARCHAR(100),
    merek VARCHAR(50),
    ukuran INT,
    harga DECIMAL(10,2),
    stok INT,
    id_kategori INT,
    FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
);

ALTER TABLE sepatu ADD COLUMN gambar VARCHAR(255) AFTER stok;

CREATE TABLE pelanggan (
    id_pelanggan INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    alamat VARCHAR(200),
    no_hp VARCHAR(15)
);

CREATE TABLE transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    tanggal DATE,
    id_pelanggan INT,
    id_user INT,
    id_sepatu INT,
    jumlah INT,
    total DECIMAL(10,2),
    FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan),
    FOREIGN KEY (id_user) REFERENCES users(id_user),
    FOREIGN KEY (id_sepatu) REFERENCES sepatu(id_sepatu)
);

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    role_user VARCHAR(50)
);

ALTER TABLE users
ADD COLUMN username VARCHAR(50) UNIQUE AFTER nama,
ADD COLUMN PASSWORD VARCHAR(255) AFTER username;

-- =============
-- INSERT 5 DATA
-- =============

-- Kategori
INSERT INTO kategori (kategori) VALUES
('Sneakers'),
('Formal'),
('Sport'),
('Casual'),
('Sandal'),
('Boots');

-- Users
INSERT INTO users (nama, role_user) VALUES
('Ahmad Rizky', 'Admin'),
('Budi Santoso', 'Pegawai'),
('Citra Dewi', 'Pegawai'),
('Dian Purnama', 'Pegawai');

-- Sepatu
INSERT INTO sepatu (nama_sepatu, merek, ukuran, harga, stok, id_kategori) VALUES
('Air Max 270', 'Nike', 42, 1500000.00, 15, 1),
('Superstar', 'Adidas', 40, 1200000.00, 20, 1),
('Authentic', 'Vans', 41, 800000.00, 18, 4),
('Classic Leather', 'Reebok', 43, 900000.00, 12, 4),
('Ultraboost', 'Adidas', 39, 2000000.00, 10, 3),
('Chuck 70', 'Converse', 42, 850000.00, 25, 1),
('Oxford', 'Brodo', 41, 750000.00, 15, 2),
('ZX 750', 'Adidas', 44, 1100000.00, 8, 3),
('Air Force 1', 'Nike', 40, 1300000.00, 22, 1),
('Chelsea Boots', 'Dr. Martens', 42, 2200000.00, 5, 6);

-- Pelanggan
INSERT INTO pelanggan (nama, alamat, no_hp) VALUES
('Dewi Lestari', 'Jl. Merdeka No. 123, Jakarta', '081234567890'),
('Agus Widodo', 'Jl. Sudirman No. 45, Bandung', '082345678901'),
('Ratna Sari', 'Jl. Gajah Mada No. 67, Surabaya', '083456789012'),
('Hendra Wijaya', 'Jl. Diponegoro No. 89, Semarang', '084567890123'),
('Maya Anggraini', 'Jl. Ahmad Yani No. 32, Yogyakarta', '085678901234'),
('Bayu Pratama', 'Jl. Pahlawan No. 54, Malang', '086789012345'),
('Sinta Dewi', 'Jl. Pemuda No. 76, Medan', '087890123456');

-- Transaksi 
INSERT INTO transaksi (tanggal, id_pelanggan, id_user, id_sepatu, jumlah, total) VALUES
('2025-05-10', 1, 2, 3, 1, 800000.00),
('2025-05-11', 2, 4, 1, 2, 3000000.00),
('2025-05-12', 3, 2, 5, 1, 2000000.00),
('2025-05-13', 4, 4, 7, 1, 750000.00),
('2025-05-14', 5, 2, 2, 2, 2400000.00),
('2025-05-15', 6, 4, 9, 1, 1300000.00),
('2025-05-16', 7, 3, 10, 1, 2200000.00),
('2025-05-17', 1, 4, 6, 2, 1700000.00),
('2025-05-18', 3, 2, 4, 1, 900000.00),
('2025-05-19', 5, 3, 8, 1, 1100000.00);


-- ==========================
-- Query Sql Ketentuan Projek
-- ==========================
-- 5 View 
-- ==========================
-- 1. View Detail Sepatu
-- ==========================
CREATE VIEW v_detail_sepatu AS
SELECT 
    s.id_sepatu,
    s.nama_sepatu,
    s.merek,
    s.ukuran,
    s.harga,
    s.gambar,
    s.stok,
    s.id_kategori,
    k.kategori
FROM 
    sepatu s
JOIN 
    kategori k ON s.id_kategori = k.id_kategori;
   
SELECT * FROM v_detail_sepatu WHERE id_sepatu = 1;
-- ==========================
-- 2. View Detail Transaksi
-- ==========================
CREATE VIEW v_detail_transaksi AS
SELECT 
    t.id_transaksi,
    t.tanggal,
    p.nama AS nama_pelanggan,
    p.alamat AS alamat_pelanggan,
    p.no_hp AS telepon_pelanggan,
    u.nama AS nama_pegawai,
    u.role_user,
    s.nama_sepatu,
    s.merek,
    s.ukuran,
    s.harga,
    t.jumlah,
    t.total
FROM 
    transaksi t
JOIN 
    pelanggan p ON t.id_pelanggan = p.id_pelanggan
JOIN 
    users u ON t.id_user = u.id_user
JOIN 
    sepatu s ON t.id_sepatu = s.id_sepatu;
    
SELECT * FROM v_detail_transaksi WHERE tanggal = '2025-05-15';
-- ==========================
-- 3. View Stok < 10
-- ==========================
CREATE VIEW v_stok_menipis AS
SELECT 
    id_sepatu,
    nama_sepatu,
    merek,
    ukuran,
    harga,
    stok
FROM 
    sepatu
WHERE 
    stok < 10
ORDER BY 
    stok ASC;

SELECT * FROM v_stok_menipis;
-- ==========================
-- 4. View Penjualan per Kategori
-- ==========================
CREATE VIEW v_penjualan_per_kategori AS
SELECT 
    k.id_kategori,
    k.kategori,
    COUNT(t.id_transaksi) AS jumlah_transaksi,
    SUM(t.jumlah) AS total_item_terjual,
    SUM(t.total) AS total_pendapatan
FROM 
    kategori k
LEFT JOIN 
    sepatu s ON k.id_kategori = s.id_kategori
LEFT JOIN 
    transaksi t ON s.id_sepatu = t.id_sepatu
GROUP BY 
    k.id_kategori, k.kategori;
    
SELECT * FROM v_penjualan_per_kategori 
WHERE jumlah_transaksi IS NOT NULL AND jumlah_transaksi > 0;
    
SELECT * FROM v_penjualan_per_kategori;
SELECT * FROM v_penjualan_per_kategori ORDER BY total_pendapatan DESC;
-- ==========================
-- 5. Laporan penjualan per bulan (Opsional)
-- ==========================
CREATE VIEW v_penjualan_per_bulan AS
SELECT 
    YEAR(tanggal) AS tahun,
    MONTH(tanggal) AS bulan,
    COUNT(id_transaksi) AS jumlah_transaksi,
    SUM(jumlah) AS total_item_terjual,
    SUM(total) AS total_pendapatan
FROM 
    transaksi
GROUP BY 
    YEAR(tanggal), MONTH(tanggal)
ORDER BY 
    tahun, bulan;    
    
SELECT * FROM v_penjualan_per_bulan
-- ========================================
-- ========================================
-- Stored Procedure
-- ========================================
DELIMITER //
CREATE PROCEDURE insert_sepatu(
    IN p_nama VARCHAR(100),
    IN p_merek VARCHAR(50),
    IN p_ukuran INT,
    IN p_harga DECIMAL(10,2),
    IN p_stok INT,
    IN p_gambar VARCHAR(255),
    IN p_id_kategori INT
)
BEGIN
    INSERT INTO sepatu (nama_sepatu, merek, ukuran, harga, stok, gambar, id_kategori)
    VALUES (p_nama, p_merek, p_ukuran, p_harga, p_stok, p_gambar, p_id_kategori);
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE update_sepatu(
    IN p_id INT,
    IN p_nama VARCHAR(100),
    IN p_merek VARCHAR(100),
    IN p_ukuran INT,
    IN p_harga DOUBLE,
    IN p_stok INT,
    IN p_gambar VARCHAR(255),
    IN p_kategori_id INT
)
BEGIN
    UPDATE sepatu
    SET 
        nama_sepatu = p_nama,
        merek = p_merek,
        ukuran = p_ukuran,
        harga = p_harga,
        stok = p_stok,
        gambar = p_gambar,
        id_kategori = p_kategori_id
    WHERE id_sepatu = p_id;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE delete_sepatu(IN p_id INT)
BEGIN
    DELETE FROM sepatu WHERE id_sepatu = p_id;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE HitungJumlahPegawai()
BEGIN
    DECLARE jumlah INT DEFAULT 0;
    DECLARE i INT DEFAULT 1;
    DECLARE total_row INT;

    DROP TEMPORARY TABLE IF EXISTS PegawaiSementara;

    CREATE TEMPORARY TABLE PegawaiSementara (
        id_user INT
    );

    INSERT INTO PegawaiSementara (id_user)
    SELECT id_user
    FROM users
    WHERE role_user = 'Pegawai';

    SELECT COUNT(*) INTO total_row FROM PegawaiSementara;

    WHILE i <= total_row DO
        SET jumlah = jumlah + 1;
        SET i = i + 1;
    END WHILE;

    SELECT jumlah AS jumlah_pegawai;

    DROP TEMPORARY TABLE IF EXISTS PegawaiSementara;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE get_sepatu_terbaru(
    IN jumlah INT
)
BEGIN
    SELECT * FROM sepatu
    ORDER BY id_sepatu DESC
    LIMIT jumlah;
END //
DELIMITER ;

-- ==============
-- TRIGGER 
-- ==============
DELIMITER //
CREATE TRIGGER trigger_log_insert_sepatu
AFTER INSERT ON sepatu
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (aksi, id_sepatu, id_user, keterangan)
    VALUES ('INSERT', NEW.id_sepatu, @id_user, 'Menambahkan data sepatu');
END //
DELIMITER ;

-- UPDATE
DELIMITER //
CREATE TRIGGER trigger_log_update_sepatu
AFTER UPDATE ON sepatu
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (aksi, id_sepatu, id_user, keterangan)
    VALUES ('UPDATE', NEW.id_sepatu, @id_user, 'Memperbarui data sepatu');
END //
DELIMITER ;

-- DELETE
DELIMITER //
CREATE TRIGGER trigger_log_delete_sepatu
AFTER DELETE ON sepatu
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (aksi, id_sepatu, id_user, keterangan)
    VALUES ('DELETE', OLD.id_sepatu, @id_user, 'Menghapus data sepatu');
END //
DELIMITER ;


SELECT * FROM log_aktivitas
SELECT * FROM users

