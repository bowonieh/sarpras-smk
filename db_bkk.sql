/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80022
 Source Host           : localhost:3306
 Source Schema         : db_bkk

 Target Server Type    : MySQL
 Target Server Version : 80022
 File Encoding         : 65001

 Date: 15/03/2021 12:59:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ci_sessions
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `timestamp` int unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for d_apply_lowongan
-- ----------------------------
DROP TABLE IF EXISTS `d_apply_lowongan`;
CREATE TABLE `d_apply_lowongan` (
  `id_apply` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_lowongan` int NOT NULL,
  `is_verified` int DEFAULT NULL,
  `no_pendaftaran` int DEFAULT NULL,
  `is_pass` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_apply`),
  KEY `id_user` (`id_user`,`id_lowongan`),
  KEY `id_lowongan` (`id_lowongan`),
  CONSTRAINT `d_apply_lowongan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `r_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `d_apply_lowongan_ibfk_2` FOREIGN KEY (`id_lowongan`) REFERENCES `d_lowongan` (`id_lowongan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for d_dokumen_pengguna
-- ----------------------------
DROP TABLE IF EXISTS `d_dokumen_pengguna`;
CREATE TABLE `d_dokumen_pengguna` (
  `dokumen_pengguna_id` int NOT NULL AUTO_INCREMENT,
  `id_jenis_dokumen` int NOT NULL,
  `id_user` int NOT NULL,
  `filename` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`dokumen_pengguna_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for d_lowongan
-- ----------------------------
DROP TABLE IF EXISTS `d_lowongan`;
CREATE TABLE `d_lowongan` (
  `id_lowongan` int NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int NOT NULL,
  `judul` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `detil` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `maks_usia` decimal(10,0) DEFAULT NULL,
  `jurusan` text,
  `jns_kelamin` enum('L','P','UMUM') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `min_tinggi_bdn` decimal(10,2) DEFAULT NULL,
  `kuota` decimal(10,0) DEFAULT '0',
  `is_active` int DEFAULT '0',
  `is_selesai` int DEFAULT '0',
  `tanggal_seleksi` date DEFAULT NULL,
  `rerata_nilai_un` decimal(10,2) DEFAULT NULL,
  `rerata_nilai_mat` decimal(10,2) DEFAULT NULL,
  `rerata_nilai_bhs` decimal(10,2) DEFAULT NULL,
  `rerata_nilai_bing` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_lowongan`),
  KEY `id_perusahaan` (`id_perusahaan`),
  CONSTRAINT `d_lowongan_ibfk_1` FOREIGN KEY (`id_perusahaan`) REFERENCES `r_perusahaan` (`id_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for d_nilai_seleksi
-- ----------------------------
DROP TABLE IF EXISTS `d_nilai_seleksi`;
CREATE TABLE `d_nilai_seleksi` (
  `id_nilai` int NOT NULL AUTO_INCREMENT,
  `id_apply` int DEFAULT NULL,
  `id_tahapan` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `is_lanjut` int DEFAULT '0',
  `nilai` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id_nilai`),
  KEY `id_apply` (`id_apply`,`id_tahapan`),
  KEY `id_tahapan` (`id_tahapan`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `d_nilai_seleksi_ibfk_1` FOREIGN KEY (`id_apply`) REFERENCES `d_apply_lowongan` (`id_apply`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `d_nilai_seleksi_ibfk_2` FOREIGN KEY (`id_tahapan`) REFERENCES `d_tahapan_seleksi` (`id_tahapan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `d_nilai_seleksi_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `d_profil` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for d_pengumuman
-- ----------------------------
DROP TABLE IF EXISTS `d_pengumuman`;
CREATE TABLE `d_pengumuman` (
  `id_pengumuman` int NOT NULL AUTO_INCREMENT,
  `id_lowongan` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `judul_pengumuman` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `isi_pengumuman` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pengumuman`),
  KEY `id_lowongan` (`id_lowongan`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `d_pengumuman_ibfk_1` FOREIGN KEY (`id_lowongan`) REFERENCES `d_lowongan` (`id_lowongan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `d_pengumuman_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `r_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for d_profil
-- ----------------------------
DROP TABLE IF EXISTS `d_profil`;
CREATE TABLE `d_profil` (
  `id_profil` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'no_pic.jpg',
  `nik` decimal(20,0) DEFAULT NULL,
  `nama_lengkap` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tempat_lahir` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tinggi_badan` decimal(10,0) DEFAULT '0',
  `berat_badan` decimal(10,2) DEFAULT '0.00',
  `pendidikan_terakhir` enum('SMK/MAK','SMA/MA') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `jurusan_pendaftar` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `agama` enum('ISLAM','KRISTEN','KATOLIK','HINDU','BUDHA','KONGHUCU','KEPERCAYAAN LAINNYA') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_profil`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `d_profil_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `r_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for d_tahapan_seleksi
-- ----------------------------
DROP TABLE IF EXISTS `d_tahapan_seleksi`;
CREATE TABLE `d_tahapan_seleksi` (
  `id_tahapan` int NOT NULL AUTO_INCREMENT,
  `id_lowongan` int DEFAULT NULL,
  `tahap_ke` int DEFAULT NULL,
  `tahapan` varchar(255) DEFAULT NULL,
  `detil` text,
  `tanggal_pelaksanaan` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_tahapan`),
  KEY `id_lowongan` (`id_lowongan`),
  CONSTRAINT `d_tahapan_seleksi_ibfk_1` FOREIGN KEY (`id_lowongan`) REFERENCES `d_lowongan` (`id_lowongan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for r_dokumen
-- ----------------------------
DROP TABLE IF EXISTS `r_dokumen`;
CREATE TABLE `r_dokumen` (
  `id_jenis_dokumen` int NOT NULL AUTO_INCREMENT,
  `nama_dokumen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_jenis_dokumen`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for r_level
-- ----------------------------
DROP TABLE IF EXISTS `r_level`;
CREATE TABLE `r_level` (
  `id_level` int NOT NULL AUTO_INCREMENT,
  `level` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for r_mapping_pengguna
-- ----------------------------
DROP TABLE IF EXISTS `r_mapping_pengguna`;
CREATE TABLE `r_mapping_pengguna` (
  `id_mapping` int unsigned NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_mapping`),
  KEY `id_perusahaan` (`id_perusahaan`,`id_user`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `r_mapping_pengguna_ibfk_1` FOREIGN KEY (`id_perusahaan`) REFERENCES `r_perusahaan` (`id_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `r_mapping_pengguna_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `r_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for r_mst_wilayah
-- ----------------------------
DROP TABLE IF EXISTS `r_mst_wilayah`;
CREATE TABLE `r_mst_wilayah` (
  `kode_wilayah` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `nama` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `id_level_wilayah` smallint DEFAULT NULL,
  `mst_kode_wilayah` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `negara_id` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `asal_wilayah` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `kode_bps` char(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `kode_dagri` char(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `kode_keu` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`kode_wilayah`),
  KEY `ref_mst_wilayah_id_level_wilayah_fk` (`id_level_wilayah`) USING BTREE,
  KEY `ref_mst_wilayah_mst_kode_wilayah_fk` (`mst_kode_wilayah`) USING BTREE,
  KEY `ref_mst_wilayah_negara_id_fk` (`negara_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for r_perusahaan
-- ----------------------------
DROP TABLE IF EXISTS `r_perusahaan`;
CREATE TABLE `r_perusahaan` (
  `id_perusahaan` int NOT NULL AUTO_INCREMENT,
  `logo_perusahaan` varchar(255) DEFAULT NULL,
  `nama_perusahaan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `alamat_perusahaan` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `kd_prov` char(8) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `kd_kokab` char(8) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `kd_kecamatan` char(8) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `kd_kelurahan` char(8) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `rt` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `rw` char(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `kode_pos` char(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email_perusahaan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `no_telp_perusahaan` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `website` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nama_kontak` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `jabatan_kontak` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `no_hp_kontak` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email_kontak` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `no_surat_mou` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tanggal_surat` datetime DEFAULT NULL,
  `file` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_perusahaan`)
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for r_token_request
-- ----------------------------
DROP TABLE IF EXISTS `r_token_request`;
CREATE TABLE `r_token_request` (
  `id_token` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `jenis_token` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_token`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for r_user
-- ----------------------------
DROP TABLE IF EXISTS `r_user`;
CREATE TABLE `r_user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `id_level` int NOT NULL DEFAULT '2',
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_level` (`id_level`),
  CONSTRAINT `r_user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `r_level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- View structure for v_dokumen
-- ----------------------------
DROP VIEW IF EXISTS `v_dokumen`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_dokumen` AS select `r`.`id_jenis_dokumen` AS `id_jenis_dokumen`,`r`.`nama_dokumen` AS `nama_dokumen`,`dok`.`id_user` AS `id_user`,`dok`.`dokumen_pengguna_id` AS `dokumen_pengguna_id`,`dok`.`filename` AS `filename` from (`r_dokumen` `r` left join `d_dokumen_pengguna` `dok` on((`dok`.`id_jenis_dokumen` = `r`.`id_jenis_dokumen`)));

-- ----------------------------
-- View structure for v_finalisasi
-- ----------------------------
DROP VIEW IF EXISTS `v_finalisasi`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_finalisasi` AS select `d_profil`.`id_user` AS `id_user`,`d_apply_lowongan`.`id_lowongan` AS `id_lowongan`,`d_apply_lowongan`.`is_verified` AS `is_verified`,`d_apply_lowongan`.`is_pass` AS `is_pass`,`d_apply_lowongan`.`no_pendaftaran` AS `no_pendaftaran`,`d_profil`.`nama_lengkap` AS `nama_lengkap`,`d_apply_lowongan`.`id_apply` AS `id_apply`,(select sum(if((`d`.`is_lanjut` = 0),1,0)) from `d_nilai_seleksi` `d` where (`d`.`id_apply` = `d_apply_lowongan`.`id_apply`)) AS `jmlh_gagal`,(select sum(`p`.`nilai`) from `d_nilai_seleksi` `p` where (`p`.`id_apply` = `d_apply_lowongan`.`id_apply`)) AS `total_nilai` from (`d_profil` join `d_apply_lowongan` on((`d_profil`.`id_user` = `d_apply_lowongan`.`id_user`)));

-- ----------------------------
-- View structure for v_laporan
-- ----------------------------
DROP VIEW IF EXISTS `v_laporan`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_laporan` AS select `r_perusahaan`.`id_perusahaan` AS `id_perusahaan`,`r_perusahaan`.`nama_perusahaan` AS `nama_perusahaan`,count(distinct `d_lowongan`.`id_lowongan`) AS `total_lowongan`,count(distinct `d_apply_lowongan`.`id_apply`) AS `total_pelamar`,sum(if((`d_apply_lowongan`.`is_verified` is null),0,1)) AS `total_pelamar_verifikasi`,sum(if((`d_profil`.`jenis_kelamin` = 'L'),1,0)) AS `laki_laki`,sum(if((`d_profil`.`jenis_kelamin` = 'P'),1,0)) AS `perempuan`,sum(if((`d_profil`.`pendidikan_terakhir` = 'SMK/MAK'),1,0)) AS `smk`,sum(if((`d_profil`.`pendidikan_terakhir` = 'SMA/MA'),1,0)) AS `sma` from (((`r_perusahaan` join `d_lowongan` on((`d_lowongan`.`id_perusahaan` = `r_perusahaan`.`id_perusahaan`))) left join `d_apply_lowongan` on((`d_apply_lowongan`.`id_lowongan` = `d_lowongan`.`id_lowongan`))) left join `d_profil` on((`d_profil`.`id_user` = `d_apply_lowongan`.`id_user`))) group by `r_perusahaan`.`id_perusahaan`;

-- ----------------------------
-- View structure for v_lowongan
-- ----------------------------
DROP VIEW IF EXISTS `v_lowongan`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_lowongan` AS select `r_perusahaan`.`nama_perusahaan` AS `nama_perusahaan`,`d_lowongan`.`id_perusahaan` AS `id_perusahaan`,`d_lowongan`.`judul` AS `judul`,`d_lowongan`.`detil` AS `detil`,`d_lowongan`.`maks_usia` AS `maks_usia`,`d_lowongan`.`jurusan` AS `jurusan`,`d_lowongan`.`jns_kelamin` AS `jns_kelamin`,`d_lowongan`.`min_tinggi_bdn` AS `min_tinggi_bdn`,`d_lowongan`.`kuota` AS `kuota`,`d_lowongan`.`is_active` AS `is_active`,`d_lowongan`.`tanggal_seleksi` AS `tanggal_seleksi`,`d_lowongan`.`rerata_nilai_un` AS `rerata_nilai_un`,`d_lowongan`.`rerata_nilai_mat` AS `rerata_nilai_mat`,`d_lowongan`.`rerata_nilai_bhs` AS `rerata_nilai_bhs`,`d_lowongan`.`rerata_nilai_bing` AS `rerata_nilai_bing`,`d_lowongan`.`created_at` AS `created_at`,`d_lowongan`.`updated_at` AS `updated_at`,`d_lowongan`.`deleted_at` AS `deleted_at`,`d_lowongan`.`id_lowongan` AS `id_lowongan`,`r_mapping_pengguna`.`id_user` AS `id_user` from ((`d_lowongan` join `r_perusahaan` on((`d_lowongan`.`id_perusahaan` = `r_perusahaan`.`id_perusahaan`))) left join `r_mapping_pengguna` on((`r_perusahaan`.`id_perusahaan` = `r_mapping_pengguna`.`id_perusahaan`)));

-- ----------------------------
-- View structure for v_pendaftar
-- ----------------------------
DROP VIEW IF EXISTS `v_pendaftar`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_pendaftar` AS select `d_apply_lowongan`.`id_apply` AS `id_apply`,`d_apply_lowongan`.`id_lowongan` AS `id_lowongan`,`d_apply_lowongan`.`no_pendaftaran` AS `no_pendaftaran`,`d_apply_lowongan`.`is_verified` AS `is_verified`,`d_apply_lowongan`.`id_user` AS `id_user`,`d_profil`.`nama_lengkap` AS `nama_lengkap`,`d_profil`.`jenis_kelamin` AS `jenis_kelamin`,`d_profil`.`tanggal_lahir` AS `tanggal_lahir`,`d_lowongan`.`id_perusahaan` AS `id_perusahaan`,`d_lowongan`.`judul` AS `judul`,`d_lowongan`.`tanggal_seleksi` AS `tanggal_seleksi`,`d_apply_lowongan`.`created_at` AS `created_at`,`d_apply_lowongan`.`updated_at` AS `updated_at`,`d_apply_lowongan`.`deleted_at` AS `deleted_at` from ((`d_apply_lowongan` join `d_profil` on((`d_apply_lowongan`.`id_user` = `d_profil`.`id_user`))) join `d_lowongan` on((`d_apply_lowongan`.`id_lowongan` = `d_lowongan`.`id_lowongan`)));

-- ----------------------------
-- View structure for v_penilaian
-- ----------------------------
DROP VIEW IF EXISTS `v_penilaian`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_penilaian` AS select `dlo`.`id_lowongan` AS `id_lowongan`,`dt`.`id_tahapan` AS `id_tahapan`,`dt`.`tahapan` AS `tahapan`,`dt`.`tahap_ke` AS `tahap_ke`,`dl`.`id_apply` AS `id_apply`,`dl`.`id_user` AS `id_user`,`dn`.`id_nilai` AS `id_nilai`,`dn`.`nilai` AS `nilai`,`dn`.`is_lanjut` AS `is_lanjut`,`dp`.`nama_lengkap` AS `nama_lengkap`,`dl`.`is_verified` AS `is_verified`,`dl`.`no_pendaftaran` AS `no_pendaftaran` from ((((`d_lowongan` `dlo` left join `d_tahapan_seleksi` `dt` on((`dlo`.`id_lowongan` = `dt`.`id_lowongan`))) left join `d_apply_lowongan` `dl` on((`dl`.`id_lowongan` = `dlo`.`id_lowongan`))) join `d_profil` `dp` on((`dp`.`id_user` = `dl`.`id_user`))) left join `d_nilai_seleksi` `dn` on(((`dn`.`id_tahapan` = `dt`.`id_tahapan`) and (`dn`.`id_apply` = `dl`.`id_apply`) and (`dn`.`id_user` = `dp`.`id_user`))));

-- ----------------------------
-- View structure for v_tahapan
-- ----------------------------
DROP VIEW IF EXISTS `v_tahapan`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_tahapan` AS select `d_tahapan_seleksi`.`id_tahapan` AS `id_tahapan`,`d_lowongan`.`id_lowongan` AS `id_lowongan`,`d_tahapan_seleksi`.`tahapan` AS `tahapan`,`d_tahapan_seleksi`.`tahap_ke` AS `tahap_ke`,`d_tahapan_seleksi`.`tanggal_pelaksanaan` AS `tanggal_pelaksanaan`,`d_tahapan_seleksi`.`detil` AS `detil` from (`d_tahapan_seleksi` join `d_lowongan` on((`d_tahapan_seleksi`.`id_lowongan` = `d_lowongan`.`id_lowongan`)));

-- ----------------------------
-- View structure for v_wilayah_perusahaan
-- ----------------------------
DROP VIEW IF EXISTS `v_wilayah_perusahaan`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_wilayah_perusahaan` AS select `pt`.`id_perusahaan` AS `id_perusahaan`,`pt`.`nama_perusahaan` AS `nama_perusahaan`,`pt`.`alamat_perusahaan` AS `alamat_perusahaan`,`pt`.`kd_prov` AS `kd_prov`,`pt`.`kd_kokab` AS `kd_kokab`,`pt`.`kd_kecamatan` AS `kd_kecamatan`,`pt`.`kd_kelurahan` AS `kd_kelurahan`,`pt`.`rt` AS `rt`,`pt`.`rw` AS `rw`,`pt`.`kode_pos` AS `kode_pos`,`pt`.`email_perusahaan` AS `email_perusahaan`,`pt`.`no_telp_perusahaan` AS `no_telp_perusahaan`,`pt`.`website` AS `website`,`pt`.`created_at` AS `created_at`,`pt`.`updated_at` AS `updated_at`,`pt`.`deleted_at` AS `deleted_at`,(select `r_mst_wilayah`.`nama` from `r_mst_wilayah` where (convert(`r_mst_wilayah`.`kode_wilayah` using utf8mb4) = convert(`pt`.`kd_prov` using utf8mb4))) AS `nama_prov`,(select `r_mst_wilayah`.`nama` from `r_mst_wilayah` where (convert(`r_mst_wilayah`.`kode_wilayah` using utf8mb4) = convert(`pt`.`kd_kokab` using utf8mb4))) AS `kokab`,(select `r_mst_wilayah`.`nama` from `r_mst_wilayah` where (convert(`r_mst_wilayah`.`kode_wilayah` using utf8mb4) = convert(`pt`.`kd_kecamatan` using utf8mb4))) AS `kecamatan`,(select `r_mst_wilayah`.`nama` from `r_mst_wilayah` where (convert(`r_mst_wilayah`.`kode_wilayah` using utf8mb4) = convert(`pt`.`kd_kelurahan` using utf8mb4))) AS `kelurahan` from `r_perusahaan` `pt`;

-- ----------------------------
-- Triggers structure for table d_apply_lowongan
-- ----------------------------
DROP TRIGGER IF EXISTS `cdtee`;
delimiter ;;
CREATE TRIGGER `cdtee` BEFORE INSERT ON `d_apply_lowongan` FOR EACH ROW set new.created_at = now()
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table d_lowongan
-- ----------------------------
DROP TRIGGER IF EXISTS `cdas123`;
delimiter ;;
CREATE TRIGGER `cdas123` BEFORE INSERT ON `d_lowongan` FOR EACH ROW set new.created_at = now()
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table d_pengumuman
-- ----------------------------
DROP TRIGGER IF EXISTS `bfrDas`;
delimiter ;;
CREATE TRIGGER `bfrDas` BEFORE INSERT ON `d_pengumuman` FOR EACH ROW set new.created_at = now()
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table r_user
-- ----------------------------
DROP TRIGGER IF EXISTS `insertBBDS`;
delimiter ;;
CREATE TRIGGER `insertBBDS` AFTER INSERT ON `r_user` FOR EACH ROW insert into d_profil (id_user) values (new.id_user)
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
