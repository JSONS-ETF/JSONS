DELETE FROM NotAllowed;
DBCC CHECKIDENT (NotAllowed, RESEED, 0)

DELETE FROM Responses;
DBCC CHECKIDENT (Responses, RESEED, 0)

DELETE FROM Questions;
DBCC CHECKIDENT (Questions, RESEED, 0)

DELETE FROM Photos;
DBCC CHECKIDENT (Photos, RESEED, 0)

DELETE FROM Messages;
DBCC CHECKIDENT (Messages, RESEED, 0)

DELETE FROM Conversations;
DBCC CHECKIDENT (Conversations, RESEED, 0)

DELETE FROM Statuses;
DBCC CHECKIDENT (Statuses, RESEED, 0)

DELETE FROM Notifications;
DBCC CHECKIDENT (Notifications, RESEED, 0)

DELETE FROM Blocks;
DBCC CHECKIDENT (Blocks, RESEED, 0)

DELETE FROM Friendships;
DBCC CHECKIDENT (Friendships, RESEED, 0)

DELETE FROM Users;
DBCC CHECKIDENT (Users, RESEED, 0)

DELETE FROM Administrators;
DBCC CHECKIDENT (Administrators, RESEED, 0)