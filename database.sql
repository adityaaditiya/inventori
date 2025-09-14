-- SQL schema for the Inventory Management Application

CREATE TABLE IF NOT EXISTS `stores` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_toko` VARCHAR(255) NOT NULL,
  `alamat` TEXT NOT NULL,
  `kode_toko` VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_lengkap` VARCHAR(255) NOT NULL,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('superadmin','owner','admin') NOT NULL,
  `id_toko` INT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_toko`) REFERENCES `stores` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `kode_barang` VARCHAR(100) NOT NULL UNIQUE,
  `nama_barang` VARCHAR(255) NOT NULL,
  `deskripsi` TEXT,
  `gambar` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `inventory` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `id_product` INT NOT NULL,
  `id_store` INT NOT NULL,
  `jumlah_stok` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_store`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  UNIQUE KEY `unique_stock` (`id_product`, `id_store`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `stock_transfers` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `id_product` INT NOT NULL,
  `id_toko_asal` INT NOT NULL,
  `id_toko_tujuan` INT NOT NULL,
  `jumlah` INT NOT NULL,
  `tanggal_transfer` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` ENUM('diproses','selesai') NOT NULL DEFAULT 'diproses',
  `keterangan` TEXT,
  `id_user_transfer` INT NOT NULL,
  FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  FOREIGN KEY (`id_toko_asal`) REFERENCES `stores` (`id`),
  FOREIGN KEY (`id_toko_tujuan`) REFERENCES `stores` (`id`),
  FOREIGN KEY (`id_user_transfer`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;