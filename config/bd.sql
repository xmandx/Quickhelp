DROP DATABASE IF EXISTS quickhelp;
CREATE DATABASE quickhelp CHARACTER SET utf8 COLLATE utf8_danish_ci;
USE quickhelp;

CREATE TABLE message(
    id_message INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name_message VARCHAR(85) NOT NULL,
    email_message VARCHAR(85) NOT NULL,
    message_message VARCHAR(500) NOT NULL
);

SELECT * FROM message;