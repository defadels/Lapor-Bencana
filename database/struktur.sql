-- Struktur tabel barang
CREATE TABLE barang (
    id_barang INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(100) NOT NULL,
    stok_gudang INT NOT NULL DEFAULT 0,
    satuan VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Struktur tabel stok_masuk
CREATE TABLE stok_masuk (
    id_stok_masuk INT AUTO_INCREMENT PRIMARY KEY,
    id_barang INT NOT NULL,
    jumlah INT NOT NULL,
    tanggal_masuk DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_barang) REFERENCES barang(id_barang)
);

-- Struktur tabel distribusi
CREATE TABLE distribusi (
    id_distribusi INT AUTO_INCREMENT PRIMARY KEY,
    id_barang INT NOT NULL,
    alamat_distribusi TEXT NOT NULL,
    jumlah INT NOT NULL,
    tanggal_distribusi DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_barang) REFERENCES barang(id_barang)
);

-- Trigger untuk update stok setelah input stok masuk
DELIMITER //
CREATE TRIGGER after_stok_masuk_insert
AFTER INSERT ON stok_masuk
FOR EACH ROW
BEGIN
    UPDATE barang 
    SET stok_gudang = stok_gudang + NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END//

-- Trigger untuk update stok setelah distribusi
CREATE TRIGGER after_distribusi_insert
AFTER INSERT ON distribusi
FOR EACH ROW
BEGIN
    UPDATE barang 
    SET stok_gudang = stok_gudang - NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END//
DELIMITER ; 