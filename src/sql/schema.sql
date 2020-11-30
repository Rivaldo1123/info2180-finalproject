
CREATE DATABASE IF NOT EXISTS BugMe;
USE BugMe;
-- Database: BugMe;

-- Table structure for UserTable;

CREATE TABLE IF NOT EXISTS UserTable (
    id INT AUTO_INCREMENT,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    password VARCHAR(64) NOT NULL,
    email VARCHAR(200) NOT NULL,
    date_joined DATETIME,
    PRIMARY KEY (id)
) ENGINE = MyISAM AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8mb4;

CREATE TABLE IF NOT EXISTS  IssuesTable(
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(64) NOT NULL,
    description TEXT(500) NOT NULL,
    type VARCHAR(64) NOT NULL,
    priority VARCHAR(20) NOT NULL,
    status VARCHAR(64) NOT NULL,
    assigned_to INT NULL,
    created_by INT,
    created DATETIME,
    updated DATETIME,
    PRIMARY KEY (id)
)ENGINE = MyISAM DEFAULT CHARSET = utf8mb4;

/*
 Data for table UserTable
For markers password is password123
 */
INSERT INTO UserTable (firstname,lastname,password,email,date_joined) VALUES 
('Admin', 'User', 'password123', 'admin@project2.com', NOW());

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8 */
;