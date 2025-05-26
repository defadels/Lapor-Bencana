-- Menambahkan kolom video pada tabel pengaduan
ALTER TABLE pengaduan ADD COLUMN video VARCHAR(255) AFTER foto; 