-- CREATE DATABASE food;
--
-- create user 'mikah'@'127.0.0.1' IDENTIFIED BY '29071308';
--
-- GRANT ALL PRIVILEGES ON * . * TO 'mikah'@'127.0.0.1';

CREATE TABLE user (
    id INT(11) NOT NULL AUTO_INCREMENT,
    first VARCHAR(255) NOT NULL,
    last VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);
