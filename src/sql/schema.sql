/*  phpMyAdmin SQL Dump
 version 5.0.4
 https://www.phpmyadmin.net/

 Host: 127.0.0.1
 Generation Time: 
 Server version: 10.4.16-MariaDB
 PHP Version: 7.4.12 

 */

-- Database: BugMe;

CREATE DATABASE IF NOT EXISTS BugMe;

-- Table structure for UserTable;

CREATE TABLE IF NOT EXISTS UserTable (
    id INT,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    password_hash VARCHAR(64) NOT NULL,
    email VARCHAR(200),
    date_joined DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE = MyISAM AUTO_INCREMENT = 4080 DEFAULT CHARSET = utf8mb4;

CREATE TABLE IF NOT EXISTS  IssuesTable(
    id INT AUTO_INCREMENT,
    title VARCHAR(64),
    description TEXT(100),
    type VARCHAR(64),
    priority VARCHAR(64),
    status VARCHAR(64),
    assigned_to INT,
    created_by INT,
    created DATETIME,
    updated DATETIME,
    PRIMARY KEY (id)
);

/*
 Data for table UserTable
For markers password is password123
 */
INSERT INTO UserTable (id,firstname,lastname,password_hash,email,date_joined) VALUES 
('1', 'Raman', 'Lewis', '', 'admin@project2.com', '2020-11-24 22:16:00'),
('2', 'Candice', 'Giselle', '', 'admin@project2.com', '2020-11-20 14:30:00'),
('3', 'Dexter', 'Small', '', 'admin@project2.com', '2020-11-18 15:47:00'),
('4', 'Samara', 'Soares', '',  'admin@project2.com', '2020-11-16 11:38:00');

INSERT INTO IssuesTable (title,description,type,status,assigned_to,created) VALUES 
('#100','Add User Form','Bug','Open','1','2020-11-25 22:16:00');

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8 */
;