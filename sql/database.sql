CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);
INSERT INTO admin (username, password) VALUES ('kash', 'kash');
INSERT INTO admin (username, password) VALUES ('odala', 'odala');

CREATE TABLE music (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    artist VARCHAR(255) NOT NULL,
    filename VARCHAR(255) NOT NULL,
    poster VARCHAR(255) NOT NULL
);

ALTER TABLE music ADD COLUMN downloads INT DEFAULT 0;
