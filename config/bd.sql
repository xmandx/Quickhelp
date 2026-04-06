DROP DATABASE IF EXISTS quickhelp;
CREATE DATABASE quickhelp CHARACTER SET utf8 COLLATE utf8_danish_ci;
USE quickhelp;

CREATE TABLE message(
    id_message INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name_message VARCHAR(85) NOT NULL,
    email_message VARCHAR(85) NOT NULL,
    message_message VARCHAR(500) NOT NULL,
    date_message TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE sos(
    id_sos INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_user INT NOT NULL,
    date_sos TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); 

CREATE TABLE user(
    id_user INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name_user VARCHAR(85) NOT NULL,
    email_user VARCHAR(85) NOT NULL,
    password_user VARCHAR(255) NOT NULL,
    rule_user ENUM('backoffice', 'user') NOT NULL DEFAULT 'user'
);

CREATE TABLE adress(
    id_address INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_user INT NOT NULL,
    state_address VARCHAR(85) NOT NULL,
    city_address VARCHAR(85) NOT NULL,
    neighborhood_address VARCHAR(85) NOT NULL,
    street_address VARCHAR(85) NOT NULL,
    number_address VARCHAR(20) NOT NULL,
    complement_address VARCHAR(255),
    FOREIGN KEY (id_user) REFERENCES user(id_user)
);

CREATE TABLE contact(
    id_contact INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_user INT NOT NULL,
    name_contact VARCHAR(85) NOT NULL,
    phone_contact VARCHAR(20) NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id_user)
);

CREATE VIEW reincidencia AS
SELECT u.name_user, COUNT(s.id_sos) AS total_sos    
FROM user u
LEFT JOIN sos s ON u.id_user = s.id_user
GROUP BY u.id_user
ORDER BY total_sos DESC;

SELECT * FROM user;