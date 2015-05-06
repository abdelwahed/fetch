-- This entire database can be constructed by running “source setup.sql” from mysql.
CREATE DATABASE `fetch_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

USE `fetch_db`;

GRANT ALL PRIVILEGES ON fetch_db.* TO 'the_user'@'localhost' IDENTIFIED BY 'the_password';

source file.sql;
source user.sql;