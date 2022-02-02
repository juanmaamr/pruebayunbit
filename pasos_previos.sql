/*
Autor: Medina Ruiz, Juan Manuel
Ejercicio: Prueba Yunbit PHP Junior
Pasos previos
*/

-- 1. Crear la BD yunbit con juego de caracteres utf
CREATE DATABASE yunbit CHARSET utf8; 

-- 2. Crear la tabla customer con los campos: 
CREATE TABLE customer(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    address VARCHAR(255),
    description TEXT,
    phone VARCHAR(255),
    type ENUM(‘P’,’N’)
)CHARSET = utf8;

/* 3. Crear un usuario denominado employee con password 12345 que tenga todos los
permisos sobre la BD. */

CREATE USER 'employee'@'localhost' IDENTIFIED BY '12345';

CREATE USER 'employee'@'%' IDENTIFIED BY '12345';

GRANT ALL PRIVILEGES ON yunbit.* TO 'employee'@'localhost';

GRANT ALL PRIVILEGES ON yunbit.* TO 'employee'@'%';

FLUSH PRIVILEGES;