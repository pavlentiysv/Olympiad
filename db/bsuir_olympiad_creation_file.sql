USE bsuir_olympiad;

CREATE TABLE `bsuir_olympiad`.`user_account` (
  `accountID` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(254) NOT NULL,
  `password` VARCHAR(254) NOT NULL,
  `userType` VARCHAR(5) NULL,
  PRIMARY KEY (`accountID`),
  UNIQUE INDEX `user_account_email_UNIQUE` (`email` ASC) VISIBLE);
  
CREATE TABLE `bsuir_olympiad`.`institution` (
  `institutionID` INT NOT NULL AUTO_INCREMENT,
  `number` VARCHAR(254) NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`institutionID`),
  UNIQUE INDEX `number_UNIQUE` (`number` ASC) VISIBLE);
  
CREATE TABLE `bsuir_olympiad`.`user` (
  `userID` INT NOT NULL,
  `accountID` INT NOT NULL,
  `surname` VARCHAR(64) NOT NULL,
  `name` VARCHAR(64) NOT NULL,
  `middlename` VARCHAR(64) NULL,
  `city` VARCHAR(64) NOT NULL,
  `institutionID` INT NOT NULL,
  `grade` INT NOT NULL,
  `gender` CHAR(1) NOT NULL,
  `birthDate` DATE NOT NULL,
  `telephoneNumber` INT NOT NULL,
  `photo` VARCHAR(254) NULL,
  PRIMARY KEY (`userID`),
  UNIQUE INDEX `accountID_UNIQUE` (`accountID` ASC) VISIBLE)
  ADD CONSTRAINT `user_institution__FK`
	FOREIGN KEY (`institutionID`)
	REFERENCES `bsuir_olympiad`.`institution` (`institutionID`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_account_FK`
	FOREIGN KEY (`accountID`)
	REFERENCES `bsuir_olympiad`.`user_account` (`accountID`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION;
  
  CREATE TABLE `bsuir_olympiad`.`event` (
  `eventID` INT NOT NULL,
  `title` VARCHAR(254) NOT NULL,
  `logo` VARCHAR(254) NOT NULL,
  `country` VARCHAR(64) NOT NULL,
  `city` VARCHAR(64) NOT NULL,
  `street` VARCHAR(128) NOT NULL,
  `houseNumber` VARCHAR(16) NOT NULL,
  `cabinet` VARCHAR(16) NULL,
  `startDate` DATETIME NOT NULL,
  `endDate` DATETIME NOT NULL,
  `site` VARCHAR(254) NULL,
  `shortInfo` VARCHAR(254) NOT NULL,
  `fullInfo` VARCHAR(512) NULL,
  PRIMARY KEY (`eventID`));
  
  CREATE TABLE `bsuir_olympiad`.`test` (
  `testID` INT NOT NULL,
  `title` VARCHAR(64) NOT NULL,
  `eventID` INT NULL,
  `date` DATETIME NULL,
  `fileSource` VARCHAR(254) NOT NULL,
  PRIMARY KEY (`testID`),
  INDEX `test_event_FK_idx` (`eventID` ASC) VISIBLE,
  CONSTRAINT `test_event_FK`
    FOREIGN KEY (`eventID`)
    REFERENCES `bsuir_olympiad`.`event` (`eventID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
    
CREATE TABLE `bsuir_olympiad`.`events_users` (
  `eventID` INT NOT NULL,
  `userID` INT NOT NULL,
  PRIMARY KEY (`eventID`, `userID`),
  INDEX `events_users_users_FK_idx` (`userID` ASC) VISIBLE,
  CONSTRAINT `events_users_events_FK`
    FOREIGN KEY (`eventID`)
    REFERENCES `bsuir_olympiad`.`events` (`eventID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `events_users_users_FK`
    FOREIGN KEY (`userID`)
    REFERENCES `bsuir_olympiad`.`users` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
    
CREATE TABLE `bsuir_olympiad`.`questions` (
  `questionID` INT NOT NULL AUTO_INCREMENT,
  `testID` INT NULL,
  `number` VARCHAR(8) NOT NULL,
  `text` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`questionID`),
  INDEX `question_test_FK_idx` (`testID` ASC) VISIBLE,
  CONSTRAINT `question_test_FK`
    FOREIGN KEY (`testID`)
    REFERENCES `bsuir_olympiad`.`tests` (`testID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
    
CREATE TABLE `bsuir_olympiad`.`answers` (
  `answerID` INT NOT NULL AUTO_INCREMENT,
  `questionID` INT NOT NULL,
  `text` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`answerID`),
  INDEX `answers_questions_FK_idx` (`questionID` ASC) VISIBLE,
  CONSTRAINT `answers_questions_FK`
    FOREIGN KEY (`questionID`)
    REFERENCES `bsuir_olympiad`.`questions` (`questionID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

#How tests will work
SELECT * FROM questions;
SELECT * FROM bsuir_olympiad.answers;

SELECT questions.text, questions.correctAnswerTitle,answers.title, answers.answer
FROM bsuir_olympiad.questions
INNER JOIN answers ON answers.questionID = questions.questionID;

SELECT questions.text, answers.answer
FROM bsuir_olympiad.questions
INNER JOIN answers ON answers.questionID = questions.questionID
WHERE questions.correctAnswerTitle = answers.title;
#End of How test will work

use bsuir_olympiad;

delimiter //
DROP trigger IF EXISTS archive_user;
CREATE TRIGGER archive_user
BEFORE INSERT 
ON accounts
for each row
begin
	SET NEW.password = md5(NEW.password);
end//
delimiter ;

delimiter //
DROP trigger IF EXISTS archive_user_update;
CREATE TRIGGER archive_user_update
BEFORE UPDATE 
ON accounts
for each row
begin
IF new.password IS NOT NULL AND new.password!='' THEN
	SET NEW.password = md5(NEW.password);
END IF;
end//
delimiter ;

SELECT email FROM accounts WHERE email='whereisinput@gmail.com' and password=md5('whereisinput228');

use bsuir_olympiad;
SELECT institutionID FROM institutions WHERE type = '' AND number = '';

USE `bsuir_olympiad`;
DROP procedure IF EXISTS `addUser`;

DELIMITER $$
USE `bsuir_olympiad`$$
CREATE PROCEDURE `addUser` (
	IN iemail VARCHAR(254), 
    ipassword VARCHAR(254), 
    isurname VARCHAR(64),
	iname VARCHAR(64), 
    imiddlename VARCHAR(64), 
    icity VARCHAR(64), 
    itype VARCHAR(45), 
    inumber VARCHAR(254),
	igrade int, 
    igender CHAR(1), 
    ibirthdate DATE, 
    itelephoneNumber int, 
    iphoto VARCHAR(254)
)
BEGIN
	DECLARE _accountID VARCHAR(254);
    DECLARE _institutionID INT;
    
	INSERT INTO accounts (email, password) values (iemail, ipassword);
	SELECT accountID INTO _accountID FROM accounts WHERE email = iemail;
    
    SELECT institutionID INTO _institutionID FROM institutions WHERE type = itype AND number = inumber;
    
    IF _institutionID IS NULL THEN
		INSERT INTO institutions (number, type) values (inumber, itype);
        SELECT institutionID INTO _institutionID FROM institutions WHERE type = itype AND number = inumber; 
	END IF;
    
    INSERT INTO users (accountID, surname, name, middlename, 
		city, institutionID, grade, gender, 
		birthDate, telephoneNumber, photo) 
	VALUES (_accountID, isurname, iname, imiddlename, 
		icity, _institutionID, igrade, igender, 
		ibirthDate, itelephoneNumber, iphoto);
END$$

DELIMITER ;

call addUser('greerz1212@gmail.com','1212', 'Шестаков', 'Валерий', 'Валерьевич', 'Семково', 'Гимназия', 'Гимназия №50 г.Минска', 14, 'М', '1998-11-12', 291302524, null);

# For select all users with full info
SELECT accounts.email,accounts.usertype,accounts.password, surname, name, middlename, city, institutions.type, institutions.number grade, gender, birthdate, telephoneNumber, photo
FROM users
RIGHT JOIN accounts ON accounts.accountID = users.accountID
LEFT JOIN institutions ON institutions.institutionID=users.institutionID;

#For reseting password
CREATE TABLE `bsuir_olympiad`.`password_reset` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(254) NOT NULL,
  `selector` TEXT NOT NULL,
  `token` LONGTEXT NOT NULL,
  `expires` TEXT NOT NULL,
  PRIMARY KEY (`ID`));
  
USE `bsuir_olympiad`;
DROP procedure IF EXISTS `updateUser`;

DELIMITER $$
USE `bsuir_olympiad`$$
CREATE PROCEDURE `updateUser` (
IN iemail VARCHAR(254), 
    ipassword VARCHAR(254), 
    iusertype VARCHAR(5),
    isurname VARCHAR(64),
	iname VARCHAR(64), 
    imiddlename VARCHAR(64), 
    icity VARCHAR(64), 
    itype VARCHAR(45), 
    inumber VARCHAR(254),
	igrade int, 
    igender CHAR(1), 
    ibirthdate DATE, 
    itelephoneNumber VARCHAR(17)
)
BEGIN
	DECLARE _accountID VARCHAR(254);
    DECLARE _password VARCHAR(32);
    DECLARE _userType VARCHAR(5);
    
    DECLARE _institutionID INT;
    DECLARE _userID INT;
    
    SET autocommit = 0;
	START TRANSACTION;
    
    #Нахождение аккаунта пользователя
	SELECT accountID, password, userType 
    INTO _accountID, _password, _userType 
    FROM accounts WHERE email = iemail;
    
    #проверка стоит ли меня пароль
    IF (md5(ipassword)!=_password AND ipassword IS NOT NULL) THEN
		UPDATE accounts SET password = ipassword, usertype = iusertype WHERE email = iemail;
	ELSE
		UPDATE accounts SET usertype = iusertype WHERE email = iemail;
    END IF;
    
    #нахождение инфы о пользователе
    SELECT userID INTO _userID FROM users WHERE accountID = _accountID;
    
    #проверка существует ли такой тип и номер ГУО
    SELECT institutionID INTO _institutionID FROM institutions WHERE type = itype AND number = inumber;
    #Если не существует
    IF check_institutionID IS NULL THEN
		INSERT INTO institutions (number, type) values (inumber, itype);
        SELECT institutionID INTO _institutionID FROM institutions WHERE type = itype AND number = inumber;
        UPDATE users SET institutionID = _institutionID WHERE userID=_userID;
	 #Если существует
	ELSE 
		UPDATE users SET institutionID = _institutionID WHERE userID=_userID;
    END IF;
    
    #Удаление, если никто не использует данное ГУО
    SELECT institutions.institutionID 
    FROM institutions 
    RIGHT JOIN users 
    ON institutions.institutionID = users.institutionID
    WHERE users.institutionID IS null;
    
    #Обновление инфы о пользователе
    UPDATE users SET surname=isurname, name=iname, middlename=imiddlename, 
		city=icity, grade=igrade, gender=igender, birthDate=ibirthDate, telephoneNumber=itelephoneNumber
	WHERE userID=_userID;
	
    COMMIT;
	SET autocommit = 1;
END$$

DELIMITER ;

use bsuir_olympiad;
call updateUser('greerz@mail.ru', null, null,'Тест', 'Обновления', null, 'Пинск', 'Средняя Школа', 'Средняя Школа №1 г.Пинска', 10, 'М', '1999-01-01', '+375(29)291302524');