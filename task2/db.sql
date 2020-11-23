DROP DATABASE IF EXISTS handbook;
CREATE DATABASE handbook;
USE handbook;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
	id SERIAL PRIMARY KEY,
    firstname VARCHAR(100) COMMENT 'Имя',
    lastname VARCHAR(100) COMMENT 'Фамилия',
    patronymic VARCHAR(100) COMMENT 'Отчество',
    created_at DATETIME DEFAULT NOW(),
    updated_at DATETIME ON UPDATE NOW()
);

INSERT INTO `users` (`id`, `firstname`, `lastname`, `patronymic`) VALUES 
('1', 'Fabian', 'Kub', 'Moses'),
('2', 'Henderson', 'Herzog', 'Hardy'),
('3', 'Eulah', 'Keebler', 'Garnett'),
('4', 'Madilyn', 'Fay', 'Clemens'),
('5', 'Georgette', 'Thompson', 'Halle');

DROP TABLE IF EXISTS phones;
CREATE TABLE phones (
	id SERIAL PRIMARY KEY,
    userID BIGINT UNSIGNED NOT NULL,
    phone BIGINT COMMENT 'Номер телефона',
    FOREIGN KEY (userID) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    created_at DATETIME DEFAULT NOW(),
    updated_at DATETIME ON UPDATE NOW()
);

INSERT INTO `phones` (`id`, `userID`, `phone`) VALUES 
('1', '1', '84489255861'),
('2', '2', '83396210332'),
('3', '3', '88743543251'),
('4', '4', '85725992576'),
('5', '5', '87998606575'),
('6', '1', '80897626225'),
('7', '2', '85284264611'),
('8', '3', '87293968380'),
('9', '4', '87642452454'),
('10', '5', '84602548901'),
('11', '1', '82380346009'),
('12', '2', '83013911877'),
('13', '3', '87398032796'),
('14', '4', '87240852972'),
('15', '5', '80630756463'),
('16', '1', '84882316121'),
('17', '2', '85717309897'),
('18', '3', '85654955746'),
('19', '4', '89836564976'),
('20', '5', '87452155946');