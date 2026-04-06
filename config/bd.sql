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

CREATE TABLE user(
    id_user INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name_user VARCHAR(85) NOT NULL,
    email_user VARCHAR(85) NOT NULL,
    password_user VARCHAR(255) NOT NULL,
    rule_user ENUM('backoffice', 'user') NOT NULL DEFAULT 'user'
);

SELECT * FROM user;