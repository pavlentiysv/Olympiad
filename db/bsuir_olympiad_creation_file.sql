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

