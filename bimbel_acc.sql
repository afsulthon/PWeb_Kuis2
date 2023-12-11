DROP DATABASE IF EXISTS bimbel_acc;

CREATE DATABASE IF NOT EXISTS bimbel_acc;
USE bimbel_acc;

DROP TABLE IF EXISTS bookmark;

CREATE TABLE bookmark (
  user_id VARCHAR(20) NOT NULL,
  playlist_id VARCHAR(20) NOT NULL
);

DROP TABLE IF EXISTS comments;

CREATE TABLE comments (
  id VARCHAR(20) NOT NULL,
  content_id VARCHAR(20) NOT NULL,
  user_id VARCHAR(20) NOT NULL,
  tutor_id VARCHAR(20) NOT NULL,
  comment VARCHAR(1000) NOT NULL,
  date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP()
);

DROP TABLE IF EXISTS contact;

CREATE TABLE contact (
  name VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  number INT NOT NULL,
  message VARCHAR(1000) NOT NULL
);

DROP TABLE IF EXISTS content;

CREATE TABLE content (
  id VARCHAR(20) NOT NULL,
  tutor_id VARCHAR(20) NOT NULL,
  playlist_id VARCHAR(20) NOT NULL,
  title VARCHAR(100) NOT NULL,
  description VARCHAR(1000) NOT NULL,
  video VARCHAR(100) NOT NULL,
  thumb VARCHAR(100) NOT NULL,
  date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  status VARCHAR(20) NOT NULL DEFAULT 'deactive'
);

INSERT INTO content
VALUES
('GibtbM7JMsCrYTq39xbN', 'EX3M5hGrng36k5KDRsJf', 'XOjpjy2oGD4kGDgQbQhq', 'Apa itu Pemrograman?', 'Apa ya kira-kira...', 'sZQh3Xp2ryBC8jfxMCNw.mp4', 'n7IlPdlw44SjbaxwKut0.jpg', '2023-12-11 08:52:25', 'active'),
('iwWLKJNKjB1sH4WBfuFR', 'EX3M5hGrng36k5KDRsJf', 'XOjpjy2oGD4kGDgQbQhq', 'Tips Memilih Bahasa Pemrograman untuk Pemula', 'Ini dia tipsnya...', 'XXAhH0WZA9wHuPlGqlsv.mp4', 'rpbMJ11qDzpX1o17iov1.jpg', '2023-12-11 08:53:48', 'active'),
('Pg1MzpFo7MCUMLbHWS1z', 'EX3M5hGrng36k5KDRsJf', 'Bk8a6l6ruUmp8n1cL4F0', 'Intro JavaScript', 'Intro dulu kali ye...', 'y76XoD9LVnghZZfAaY1e.mp4', 'dBzOAXTgBTKqk4zJMqdo.jpg', '2023-12-11 09:39:06', 'active'),
('W4BuTRkzktmBSZJuq1G5', 'EX3M5hGrng36k5KDRsJf', 'Bk8a6l6ruUmp8n1cL4F0', 'Control Flow pada JavaScript', 'Lanjut cuy...', 'VcKN28W4BPt8k0NxsfxR.mp4', 'M3PGoOcc4mArNeraSNOU.jpg', '2023-12-11 09:41:35', 'active'),
('QGfu7yOjAHXLuYHfMTne', 'U8kYDsNBNSbVmjYIVHXx', 'D6gDjbsXvUbsAQrxo3X4', 'Membuat Partikel Kuantum di Laboratorium', 'Mari kita coba...', '6BJ9cacJoqgoiWtWOS9u.mp4', 'UBa4KPZwBSCfgGFEltBm.jpg', '2023-12-11 09:47:51', 'active');

DROP TABLE IF EXISTS likes;

CREATE TABLE likes (
  user_id VARCHAR(20) NOT NULL,
  tutor_id VARCHAR(20) NOT NULL,
  content_id VARCHAR(20) NOT NULL
);

DROP TABLE IF EXISTS playlist;

CREATE TABLE playlist (
  id VARCHAR(20) NOT NULL,
  tutor_id VARCHAR(20) NOT NULL,
  title VARCHAR(100) NOT NULL,
  description VARCHAR(1000) NOT NULL,
  thumb VARCHAR(100) NOT NULL,
  date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  status VARCHAR(20) NOT NULL DEFAULT 'deactive'
);


INSERT INTO playlist
VALUES
('XOjpjy2oGD4kGDgQbQhq', 'EX3M5hGrng36k5KDRsJf', 'Dasar Pemrograman', 'Dasar Pemrograman oleh Sandhika Galih', 'ckkPHSnjJBArxmoIyVDD.jpg', '2023-12-11 07:30:08', 'active'),
('Bk8a6l6ruUmp8n1cL4F0', 'EX3M5hGrng36k5KDRsJf', 'Dasar Pemrograman JavaScript', 'Dasar Pemrograman JavaScript oleh Sandhika Galih', 'TZKDXDTbM0r9ZmkTFL4J.jpg', '2023-12-11 09:37:28', 'active'),
('D6gDjbsXvUbsAQrxo3X4', 'U8kYDsNBNSbVmjYIVHXx', 'Mari Praktikum', 'Mari Praktikum oleh Fajrul Falah', 'ZfUZkYeNWBOFUSzb858Q.jpg', '2023-12-11 09:47:24', 'active');

DROP TABLE IF EXISTS tutors;

CREATE TABLE tutors (
  id VARCHAR(20) NOT NULL,
  name VARCHAR(50) NOT NULL,
  profession VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL,
  image VARCHAR(100) NOT NULL
);

INSERT INTO tutors
VALUES
('yFku5TlwKuecOjWucuzK', 'Admin', 'Admin', 'admin@acc.id', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin.png'),
('EX3M5hGrng36k5KDRsJf', 'Sandhika Galih', 'Developer', 'sandhika@acc.id', 'ac74975bef61fce737a1c6808315ba00bf94a83a', 'sandhika.jpg'),
('U8kYDsNBNSbVmjYIVHXx', 'Fajrul Falah', 'Fisikawan', 'fajrul@acc.id', '7aed3da18f00836eea759f6bec6dfec7066b3646', 'fajrul.jpg'),
('A865uJ596TXisq5jpzZ3', 'Jerome Polin', 'Guru', 'jerome@acc.id', '723156650c5778d0e4df4b2fbfeefa65359302e5', 'jerome.jpg');

DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id VARCHAR(20) NOT NULL,
  name VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL,
  image VARCHAR(100) NOT NULL
);

INSERT INTO users
VALUES
('Vo2JoRHKQDtXDWCwVjN7', 'Akmal', 'akmal@mail.com', 'd29c11fe07a0192b3026caf3d6ca6ef7da8db65e', 'akmal.jpg'),
('LuZ6N9rtH7elFSNsFHf2', 'Khosyi', 'khosyi@mail.com', '524390fe1e1937b4306467a769e9161ba2a79c19', 'khosyi.jpeg');