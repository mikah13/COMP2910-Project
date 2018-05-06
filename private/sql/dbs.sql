-- CREATE DATABASE food;
--
-- create user 'mikah'@'127.0.0.1' IDENTIFIED BY '29071308';
--
-- GRANT ALL PRIVILEGES ON * . * TO 'mikah'@'127.0.0.1';
USE localdb;
CREATE TABLE user (
    id INT(11) NOT NULL AUTO_INCREMENT,
    first VARCHAR(255) NOT NULL,
    last VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
) ENGINE=INNODB;;

CREATE TABLE user_recipe (
    id INT(11) NOT NULL,
    recipe_id INT(10) NOT NULL,
    recipe_title VARCHAR(255) NOT NULL,
    day VARCHAR(10) NOT NULL,
    quantity INT(10) NOT NULL,
    PRIMARY KEY(recipe_id, day),
    FOREIGN KEY (id) REFERENCES user(id)  ON DELETE CASCADE
) ENGINE=INNODB;
