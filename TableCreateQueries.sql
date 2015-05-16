CREATE TABLE Administrators
(
ID int IDENTITY(1,1) PRIMARY KEY,
Email varchar(64) NOT NULL,
Userame varchar(64) NOT NULL,
Password varchar(64) NOT NULL
);

CREATE TABLE Users
(
ID int IDENTITY(1,1) PRIMARY KEY,
Email varchar(64) NOT NULL,
Userame varchar(64) NOT NULL,
Password varchar(64) NOT NULL,
FirstName varchar(64) NOT NULL,
LastName varchar(64) NOT NULL,
About varchar(256)
);

CREATE TABLE Friendships
(
ID int IDENTITY(1,1) PRIMARY KEY,
User1 int NOT NULL,
User2 int NOT NULL
);

CREATE TABLE Blocks
(
ID int IDENTITY(1,1) PRIMARY KEY,
Blocker int NOT NULL,
Blockee int NOT NULL
);

CREATE TABLE Notifications
(
ID int IDENTITY(1,1) PRIMARY KEY,
Link varchar(64) NOT NULL,
Text varchar(256)
);

CREATE TABLE Statuses
(
ID int IDENTITY(1,1) PRIMARY KEY,
Timestamp DateTime2 NOT NULL,
Text varchar(512) NOT NULL
);

CREATE TABLE Messages
(
ID int IDENTITY(1,1) PRIMARY KEY,
ConversationID int NOT NULL,
Timestamp DateTime2 NOT NULL,
Text varchar(256) NOT NULL
);

CREATE TABLE Conversations
(
ID int IDENTITY(1,1) PRIMARY KEY,
User1 int NOT NULL,
User2 int NOT NULL
);

CREATE TABLE Photos
(
ID int IDENTITY(1,1) PRIMARY KEY,
Content varbinary(max) NOT NULL,
NumCuddles int NOT NULL,
NumSlaps int NOT NULL,
Timestamp DateTime2 NOT NULL,
Description varchar(256)
);

CREATE TABLE Questions
(
ID int IDENTITY(1,1) PRIMARY KEY,
Timestamp DateTime2 NOT NULL,
Text varchar(128) NOT NULL,
NumCuddles int NOT NULL,
NumSlaps int NOT NULL
);

CREATE TABLE Responses
(
ID int IDENTITY(1,1) PRIMARY KEY,
QuestionID int NOT NULL,
Timestamp DateTime2 NOT NULL,
Text varchar(128) NOT NULL
);

CREATE TABLE NotAllowed
(
ID int IDENTITY(1,1) PRIMARY KEY,
ResponseID int NOT NULL
);