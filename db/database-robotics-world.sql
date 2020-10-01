USE mysql;
DROP DATABASE IF EXISTS RoboticsWorld;
CREATE DATABASE RoboticsWorld;
USE RoboticsWorld;

DROP TABLE IF EXISTS Statues;
CREATE TABLE Statuses
(
    StatusId  INT          NOT NULL AUTO_INCREMENT,
    Name      NVARCHAR(64) NOT NULL,
    IsRemoved BIT          NOT NULL DEFAULT (0),
    CONSTRAINT PK_Statues PRIMARY KEY (StatusId),
    CONSTRAINT CHK_Statuses_Name CHECK (LENGTH(Name) >= 4),
    CONSTRAINT UNQ_Statuses_Name UNIQUE (Name)
);

DROP TABLE IF EXISTS Roles;
CREATE TABLE Roles
(
    RoleId    INT          NOT NULL AUTO_INCREMENT,
    Name      NVARCHAR(64) NOT NULL,
    IsRemoved BIT          NOT NULL DEFAULT (0),
    CONSTRAINT PK_Roles PRIMARY KEY (RoleId),
    CONSTRAINT CHK_Roles_Name CHECK (LENGTH(Name) >= 4),
    CONSTRAINT UNQ_Roles_Name UNIQUE (Name)
);

DROP TABLE IF EXISTS Users;
CREATE TABLE Users
(
    UserId          INT           NOT NULL AUTO_INCREMENT,
    Username        NVARCHAR(64)  NOT NULL,
    Email           NVARCHAR(64)  NOT NULL,
    IsEmailVerified BIT           NOT NULL DEFAULT (0),
    Password        NVARCHAR(128) NOT NULL,
    StatusId        INT           NOT NULL,
    SignUpDate      DATETIME      NOT NULL DEFAULT (NOW()),
    IsRemoved       BIT           NOT NULL DEFAULT (0),
    CONSTRAINT PK_Users PRIMARY KEY (UserId),
    CONSTRAINT CHK_Users_Username CHECK (LENGTH(Username) >= 4),
    CONSTRAINT UNQ_Users_Username UNIQUE (Username),
    CONSTRAINT CHK_Users_Email CHECK (LENGTH(Email) >= 4),
    CONSTRAINT UNQ_Users_Email UNIQUE (Email),
    CONSTRAINT CHK_Users_Password CHECK (LENGTH(Password) >= 8),
    CONSTRAINT FK_Users_StatusId FOREIGN KEY (StatusId) REFERENCES Statuses (StatusId)
);

DROP TABLE IF EXISTS UserRoles;
CREATE TABLE UserRoles
(
    UserId    INT NOT NULL,
    RoleId    INT NOT NULL,
    IsRemoved BIT NOT NULL DEFAULT (0),
    CONSTRAINT PK_UserRoles PRIMARY KEY (UserId, RoleId),
    CONSTRAINT FK_UserRoles_UserId FOREIGN KEY (UserId) REFERENCES Users (UserId),
    CONSTRAINT FK_UserRoles_RoleId FOREIGN KEY (RoleId) REFERENCES Roles (RoleId)
);

INSERT INTO Statuses(Name)
VALUES ('Available');
INSERT INTO Statuses(Name)
VALUES ('Busy');
INSERT INTO Statuses(Name)
VALUES ('Do not disturb');
INSERT INTO Statuses(Name)
VALUES ('Be right back');
INSERT INTO Statuses(Name)
VALUES ('Appear away');

INSERT INTO Roles(Name)
VALUES ('Administrator');
INSERT INTO Roles(Name)
VALUES ('User');

INSERT INTO Users(Username, Email, IsEmailVerified, Password, StatusId)
VALUES ('liannoi', 'liannoi444@gmail.com', 1, '81f0d7c22167609382b79569c249acd45bc02f123180aa68fde964ae07201b93', 1);

INSERT INTO Users(Username, Email, IsEmailVerified, Password, StatusId)
VALUES ('pg5_', 'margarett9@gmail.com', 0, '497d85bdf4f60f890941c95cbc5358f4f377c08b5ed3b5578b14884e6ecdd843', 2);

INSERT INTO Users (Username, Email, IsEmailVerified, Password, StatusId, IsRemoved)
VALUES ('hscrace0', 'eobee0@huffingtonpost.com', 1, 'a80049413d45ecb1ddcad5587065ed1711fa5715f9b71de52ac935c2f513d339',
        1, 1);

INSERT INTO Users (Username, Email, IsEmailVerified, Password, StatusId, IsRemoved)
VALUES ('babbotts1', 'adelafield1@ucoz.ru', 0, '78ed4faf7df87cc587f7a76576adeb2955637c9e16ecfbd4fb7d37600890b1e9', 3,
        1);

INSERT INTO Users (Username, Email, IsEmailVerified, Password, StatusId, IsRemoved)
VALUES ('bphlippsen2', 'cbaskeyfield2@discovery.com', 1,
        '0e10012cb002a535534e619967049c826d78c90d7969c09e438decfb8a0597f3', 5, 1);

INSERT INTO Users (Username, Email, IsEmailVerified, Password, StatusId, IsRemoved)
VALUES ('jlangmaid3', 'fwells3@nyu.edu', 0, '9f404e36fbdf70a93a41177e8bd1a88b4a8c3c9d735c1548398ac48b2ee9f71c', 1, 0);

INSERT INTO Users (Username, Email, IsEmailVerified, Password, StatusId, IsRemoved)
VALUES ('cgrzelak4', 'jtabourin4@chicagotribune.com', 0,
        'eb84e3bb2a2e02d1dd11da5383071be7aa70b4c415edcab9088ec56cf15b6837', 5, 1);

INSERT INTO Users (Username, Email, IsEmailVerified, Password, StatusId, IsRemoved)
VALUES ('rshergold5', 'rsumnall5@360.cn', 1, '9ff3590fec1908545aa58e8f2f8301aaf2aa51ffca950f5a094ed400eff9efe0', 1, 1);

INSERT INTO Users (Username, Email, IsEmailVerified, Password, StatusId, IsRemoved)
VALUES ('dbourcq6', 'jnewburn6@google.com.au', 1, 'b9adfe24f9982b6e321bd4d03e1b036d804083ad92cba8f47cafa6ded69f1a8a', 3,
        0);

INSERT INTO Users (Username, Email, IsEmailVerified, Password, StatusId, IsRemoved)
VALUES ('ekaspar7', 'rschultes7@indiegogo.com', 1, 'b27f4b8c343b2a473df367ab41ed8ce7e72bf010e742a9e2cf948afe70ec9504',
        5, 1);

INSERT INTO Users (Username, Email, IsEmailVerified, Password, StatusId, IsRemoved)
VALUES ('vluberto8', 'ljeckell8@craigslist.org', 0, '6b88257f1b4777728544ae8c073b27d16da00b5f168fbde93e182e6431fda698',
        5, 0);

INSERT INTO Users (Username, Email, IsEmailVerified, Password, StatusId, IsRemoved)
VALUES ('cbrannan9', 'dshevlan9@list-manage.com', 0, 'ab62aec247856b0783642f6aedc9fd9bc8f5b0b64b946f5e1e624fdc169eb18c',
        2, 0);

INSERT INTO UserRoles (UserId, RoleId)
VALUES (8, 2);

INSERT INTO UserRoles (UserId, RoleId)
VALUES (3, 2);

INSERT INTO UserRoles (UserId, RoleId)
VALUES (9, 1);

INSERT INTO UserRoles (UserId, RoleId)
VALUES (1, 2);

INSERT INTO UserRoles (UserId, RoleId)
VALUES (7, 1);

INSERT INTO UserRoles (UserId, RoleId)
VALUES (5, 2);

INSERT INTO UserRoles (UserId, RoleId)
VALUES (4, 2);

INSERT INTO UserRoles (UserId, RoleId)
VALUES (7, 2);
