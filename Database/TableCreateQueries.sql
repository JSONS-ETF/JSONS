CREATE TABLE Administrators
(
	ID int IDENTITY(1,1) PRIMARY KEY,
	Email varchar(64),
	Username varchar(64),
	Password varchar(64),
	AccessCode varchar(64),
	Activated bit
);

CREATE TABLE Users
(
	ID int IDENTITY(1,1) PRIMARY KEY,
	Email varchar(64) NOT NULL,
	Username varchar(64) NOT NULL,
	Password varchar(64) NOT NULL,
	FirstName varchar(64) NOT NULL,
	LastName varchar(64) NOT NULL,
	About varchar(256),
	PhotoID int
);

CREATE TABLE Friendships
(
	ID int IDENTITY(1,1) PRIMARY KEY,
	User1ID int NOT NULL FOREIGN KEY REFERENCES Users(ID),
	User2ID int NOT NULL FOREIGN KEY REFERENCES Users(ID)
);

CREATE TABLE Blocks
(
	ID int IDENTITY(1,1) PRIMARY KEY,
	Blocker int NOT NULL FOREIGN KEY REFERENCES Users(ID),
	Blockee int NOT NULL FOREIGN KEY REFERENCES Users(ID)
);

CREATE TABLE Notifications
(
	ID int IDENTITY(1,1) PRIMARY KEY,
	UserID int NOT NULL FOREIGN KEY REFERENCES Users(ID),
	Link varchar(64) NOT NULL,
	Text varchar(256)
);

CREATE TABLE Statuses
(
	ID int IDENTITY(1,1) PRIMARY KEY,
	UserID int NOT NULL FOREIGN KEY REFERENCES Users(ID),
	Timestamp DateTime2 NOT NULL,
	Text varchar(512) NOT NULL
);

CREATE TABLE Conversations
(
	ID int IDENTITY(1,1) PRIMARY KEY,
	User1ID int NOT NULL FOREIGN KEY REFERENCES Users(ID),
	User2ID int NOT NULL FOREIGN KEY REFERENCES Users(ID),
	TimeStamp DateTime2 NOT NULL
);

CREATE TABLE Messages
(
	ID int IDENTITY(1,1) PRIMARY KEY,
	ConversationID int NOT NULL FOREIGN KEY REFERENCES Conversations(ID),
	UserID int NOT NULL FOREIGN KEY REFERENCES Users(ID),
	Timestamp DateTime2 NOT NULL,
	Text varchar(256) NOT NULL
);

CREATE TABLE Photos
(
	ID int IDENTITY(1,1) PRIMARY KEY,
	UserID int NOT NULL FOREIGN KEY REFERENCES Users(ID),
	NumCuddles int NOT NULL,
	NumSlaps int NOT NULL,
	Timestamp DateTime2 NOT NULL,
	Description varchar(256)
);

CREATE TABLE Questions
(
	ID int IDENTITY(1,1) PRIMARY KEY,
	User1ID int NOT NULL FOREIGN KEY REFERENCES Users(ID),
	User2ID int NOT NULL FOREIGN KEY REFERENCES Users(ID),
	Timestamp DateTime2 NOT NULL,
	Text varchar(128) NOT NULL,
	NumCuddles int NOT NULL,
	NumSlaps int NOT NULL
);

CREATE TABLE Responses
(
	ID int IDENTITY(1,1) PRIMARY KEY,
	QuestionID int NOT NULL FOREIGN KEY REFERENCES Questions(ID),
	Timestamp DateTime2 NOT NULL,
	Text varchar(128) NOT NULL
);


CREATE TABLE BaseQuestions
(
	ID int IDENTITY(1,1) PRIMARY KEY,
	Timestamp DateTime2 NOT NULL,
	Text varchar(128) NOT NULL,
);

CREATE TABLE BaseResponses
(
	ID int IDENTITY(1,1) PRIMARY KEY,
	QuestionID int NOT NULL FOREIGN KEY REFERENCES BaseQuestions(ID),
	UserID int NOT NULL FOREIGN KEY REFERENCES Users(ID),
	Timestamp DateTime2 NOT NULL,
	Text varchar(128) NOT NULL
);