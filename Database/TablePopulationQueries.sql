IF OBJECT_ID (N'func_hashMD5') IS NOT NULL
    DROP FUNCTION func_hashMD5;
GO

CREATE FUNCTION func_hashMD5(@str VARCHAR(64)) RETURNS VARCHAR(64) AS
BEGIN
	RETURN CONVERT (varchar(64), hashbytes('MD5', @str), 2);
END
GO

DELETE FROM Administrators WHERE Username = 'admin';
INSERT INTO Administrators VALUES ('admin@questy.com', 'admin', dbo.func_hashMD5('admin'), NULL, 1);

IF OBJECT_ID (N'rndView') IS NOT NULL
    DROP VIEW rndView;
GO

CREATE VIEW rndView
AS
SELECT RAND() rndResult
GO

IF OBJECT_ID (N'func_RandFn') IS NOT NULL
    DROP FUNCTION func_RandFn;
GO

CREATE FUNCTION func_RandFn() RETURNS DECIMAL(18,18) AS
BEGIN
	DECLARE @rndValue DECIMAL(18,18);
	SELECT @rndValue = rndResult
	FROM rndView;
	RETURN @rndValue;
END
GO

IF OBJECT_ID (N'func_getRandChar') IS NOT NULL
    DROP FUNCTION func_getRandChar;
GO

CREATE FUNCTION func_getRandChar(@useNumbers BIT = 0) RETURNS CHAR AS
BEGIN
	DECLARE @type INT;
	SET @type = 0;

	IF @useNumbers = 1 SET @type = CAST(dbo.func_RandFn() * 3 as INT);
	ELSE SET @type = CAST(dbo.func_RandFn() * 2 as INT);

	RETURN CASE @type
		WHEN 0 THEN CHAR(CAST(dbo.func_RandFn() * 26 as INT) + 65)
		WHEN 1 THEN CHAR(CAST(dbo.func_RandFn() * 26 as INT) + 97)
		WHEN 2 THEN CHAR(CAST(dbo.func_RandFn() * 10 as INT) + 48)
	END
END
GO

IF OBJECT_ID (N'func_getRandString') IS NOT NULL
    DROP FUNCTION func_getRandString;
GO

CREATE FUNCTION func_getRandString(@length INT = 8) RETURNS VARCHAR(64) AS
BEGIN
	DECLARE @str VARCHAR(64) = '';
	DECLARE @i INT = 0;
	WHILE @i < @length
	BEGIN
		SET @str = @str + dbo.func_getRandChar(IIF(@i > 3, 1, 0));
		SET @i = @i + 1;
	END
	RETURN @str;
END
GO

IF OBJECT_ID (N'func_getRandDateTime') IS NOT NULL
    DROP FUNCTION func_getRandDateTime;
GO

CREATE FUNCTION func_getRandDateTime() RETURNS DateTime2 AS
BEGIN
	DECLARE @timestamp DateTime2 = '2014-01-01 00:00:00.0000000';
	SET @timestamp = DATEADD(YEAR, CAST(dbo.func_RandFn() * 2 as INT), @timestamp);
	SET @timestamp = DATEADD(MONTH, CAST(dbo.func_RandFn() * 12 as INT), @timestamp);
	SET @timestamp = DATEADD(DAY, CAST(dbo.func_RandFn() * 30 as INT), @timestamp);
	SET @timestamp = DATEADD(HOUR, CAST(dbo.func_RandFn() * 24 as INT), @timestamp);
	SET @timestamp = DATEADD(MINUTE, CAST(dbo.func_RandFn() * 60 as INT), @timestamp);
	SET @timestamp = DATEADD(SECOND, CAST(dbo.func_RandFn() * 60 as INT), @timestamp);
	SET @timestamp = DATEADD(MILLISECOND, CAST(dbo.func_RandFn() * 1000 as INT), @timestamp);

	RETURN @timestamp;
END
GO

DECLARE @userCount INT = 10;
DECLARE @i INT = 0;
WHILE @i < @userCount
BEGIN
	DECLARE @email VARCHAR(64) = dbo.func_getRandString(8) + '@' + dbo.func_getRandString(8) + '.com';
	DECLARE @username VARCHAR(64) = dbo.func_getRandString(16);
	DECLARE @password VARCHAR(64) = dbo.func_getRandString(16);
	DECLARE @firstname VARCHAR(64) = dbo.func_getRandString(16);
	DECLARE @lastname VARCHAR(64) = dbo.func_getRandString(16);
	DECLARE @about VARCHAR(64) = @password;

	INSERT INTO Users VALUES (@email, @username, dbo.func_hashMD5(@password), @firstname, @lastname, @about, null);

	SET @i = @i + 1;
END

DECLARE @firstUserID INT = @@IDENTITY - @userCount + 1;
PRINT @firstUserID

DECLARE @chance REAL = 0.3; -- values: 0.0 -> 1.0
SET @i = 0;
WHILE @i < @userCount
BEGIN
	DECLARE @j INT = @i + 1;
	WHILE @j < @userCount
	BEGIN
		DECLARE @roll REAL = dbo.func_RandFn();
		IF @roll <= @chance
		BEGIN
			INSERT INTO Friendships VALUES (@i + @firstUserID, @j + @firstUserID);
		END

		SET @j = @j + 1;
	END
	SET @i = @i + 1;
END

DECLARE @notificationCount INT = 10;
SET @i = 0;
WHILE @i < @notificationCount
BEGIN
	DECLARE @userID INT = CAST(dbo.func_RandFn() * @userCount as INT) + @firstUserID;
	DECLARE @link VARCHAR(64) = 'http://' + dbo.func_getRandString(8) + '.com';
	DECLARE @text VARCHAR(256) = dbo.func_getRandString(64);
	INSERT INTO Notifications VALUES (@userID, @link, @text);

	SET @i = @i + 1;
END

DECLARE @statusCount INT = 10;
SET @i = 0;
WHILE @i < @statusCount
BEGIN
	SET @userID = CAST(dbo.func_RandFn() * @userCount as INT) + @firstUserID;
	SET @text = dbo.func_getRandString(64);
	DECLARE @timestamp DateTime2 = dbo.func_getRandDateTime();
	INSERT INTO Statuses VALUES (@userID, @timestamp, @text);

	SET @i = @i + 1;
END

SET @chance = 0.3; -- values: 0.0 -> 1.0
SET @i = 0;
DECLARE @conversationCount INT = 0;
WHILE @i < @userCount
BEGIN
	SET @j = @i + 1;
	WHILE @j < @userCount
	BEGIN
		SET @roll = dbo.func_RandFn();
		IF @roll <= @chance
		BEGIN
			INSERT INTO Conversations VALUES (@i + 1, @j + 1);
			SET @conversationCount = @conversationCount + 1;
			DECLARE @conversationID INT = @@IDENTITY;

			DECLARE @msgCount INT = CAST(dbo.func_RandFn() * 5 + 2 as INT);
			DECLARE @k INT = 0;
			WHILE @k < @msgCount
			BEGIN
				SET @timestamp = dbo.func_getRandDateTime();
				SET @text = dbo.func_getRandString(64);

				SET @userID = IIF(CAST(dbo.func_RandFn() * 2 as INT) = 0, @i + @firstUserID, @j + @firstUserID);

				INSERT INTO Messages VALUES (@conversationID, @userID, @timestamp, @text);

				SET @k = @k + 1;
			END
		END

		SET @j = @j + 1;
	END
	SET @i = @i + 1;
END

DECLARE @questionCount INT = 10;
SET @i = 0;
WHILE @i < @questionCount
BEGIN
	DECLARE @user1ID INT = CAST(dbo.func_RandFn() * @userCount as INT) + @firstUserID;
	DECLARE @user2ID INT = CAST(dbo.func_RandFn() * @userCount as INT) + @firstUserID;

	IF @user1ID != @user2ID
	BEGIN
		SET @timestamp = dbo.func_getRandDateTime();
		SET @text = dbo.func_getRandString(64) + '?';
		DECLARE @numCuddles INT = CAST(dbo.func_RandFn() * 5 as INT) + 1;
		DECLARE @numSlaps INT = CAST(dbo.func_RandFn() * 5 as INT) + 1;

		INSERT INTO Questions VALUES (@user1ID, @user2ID, @timestamp, @text, @numCuddles, @numSlaps);

		DECLARE @responseCount INT = CAST(dbo.func_RandFn() * 4 + 1 as INT);
		SET @j = 0;
			WHILE @j < @responseCount
			BEGIN
				SET @timestamp = dbo.func_getRandDateTime();
				SET @text = dbo.func_getRandString(64) + '!';

				INSERT INTO Responses VALUES (@i + 1, @timestamp, @text);

				SET @j = @j + 1;
			END

		SET @i = @i + 1;
	END
END

DECLARE @baseQuestionCount INT = 5;
SET @i = 0;
WHILE @i < @baseQuestionCount
BEGIN
	SET @timestamp = dbo.func_getRandDateTime();
	SET @text = dbo.func_getRandString(64) + '?';
	INSERT INTO BaseQuestions VALUES (@timestamp, @text);
	DECLARE @baseQuestionID INT = @@IDENTITY;

	SET @j = 0;
	WHILE (@j < @userCount)
	BEGIN
		DECLARE @baseResponseCount INT = CAST(dbo.func_RandFn() * 0 + 1 as INT);
		SET @k = 0;
		WHILE @k < @baseResponseCount
		BEGIN
			SET @timestamp = dbo.func_getRandDateTime();
			SET @text = dbo.func_getRandString(64) + '!';

			INSERT INTO BaseResponses VALUES (@baseQuestionID, @j + @firstUserID, @timestamp, @text);

			SET @k = @k + 1;
		END
		SET @j = @j + 1;
	END
	SET @i = @i + 1;
END