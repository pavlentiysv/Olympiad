-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: 192.168.1.99    Database: bsuir_olympiad
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `accounts` (
  `accountID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `password` varchar(254) NOT NULL,
  `userType` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`accountID`),
  UNIQUE KEY `user_account_email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (4,'whereisinput@gmail.com','28052e8b384e4c1e089fa1b193befc9b','admin'),(6,'greerz1212@gmail.com','b59c67bf196a4758191e42f76670ceba',NULL),(24,'anton.rozhkov01@gmail.com','b59c67bf196a4758191e42f76670ceba',NULL),(25,'1361799@gmail.com','5285779a7667fb53e46e7ded9eb1e87c',NULL),(26,'pavlentiysv@gmail.com','b59c67bf196a4758191e42f76670ceba',NULL),(30,'ivanov@gmail.com','c4ca4238a0b923820dcc509a6f75849b',NULL),(36,'greerz@mail.ru','b59c67bf196a4758191e42f76670ceba',NULL);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `archive_user` BEFORE INSERT ON `accounts` FOR EACH ROW begin
	SET NEW.password = md5(NEW.password);
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `archive_user_update` BEFORE UPDATE ON `accounts` FOR EACH ROW begin
	SET NEW.password = md5(NEW.password);
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `answers` (
  `answerID` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) NOT NULL,
  `title` varchar(8) DEFAULT NULL,
  `answer` varchar(64) NOT NULL,
  PRIMARY KEY (`answerID`),
  KEY `answers_questions_FK_idx` (`questionID`),
  CONSTRAINT `answers_questions_FK` FOREIGN KEY (`questionID`) REFERENCES `questions` (`questionID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (1,1,'1','совокупность данных, организованных по определенным правилам;'),(2,1,'2','совокупность программ для хранения и обработки больших массивов '),(3,1,'3','интерфейс, поддерживающий наполнение и манипулирование данными;'),(4,1,'4','определенная совокупность информации.'),(5,2,'1','для хранения данных базы'),(6,2,'2','для отбора и обработки данных базы'),(7,2,'3','для ввода данных базы и их просмотра'),(8,2,'4','для автоматического выполнения группы команд'),(9,2,'5','для выполнения сложных программных действий'),(10,2,'6','для вывода обработанных данных базы на принтер');
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `events` (
  `eventID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(254) NOT NULL,
  `logo` varchar(254) NOT NULL,
  `country` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `street` varchar(128) NOT NULL,
  `houseNumber` varchar(16) NOT NULL,
  `cabinet` varchar(16) DEFAULT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `site` varchar(254) DEFAULT NULL,
  `shortInfo` varchar(254) NOT NULL,
  `fullInfo` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`eventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_users`
--

DROP TABLE IF EXISTS `events_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `events_users` (
  `eventID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`eventID`,`userID`),
  KEY `events_users_users_FK_idx` (`userID`),
  CONSTRAINT `events_users_events_FK` FOREIGN KEY (`eventID`) REFERENCES `events` (`eventID`),
  CONSTRAINT `events_users_users_FK` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_users`
--

LOCK TABLES `events_users` WRITE;
/*!40000 ALTER TABLE `events_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `institutions`
--

DROP TABLE IF EXISTS `institutions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `institutions` (
  `institutionID` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(254) NOT NULL,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`institutionID`),
  UNIQUE KEY `number_UNIQUE` (`number`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institutions`
--

LOCK TABLES `institutions` WRITE;
/*!40000 ALTER TABLE `institutions` DISABLE KEYS */;
INSERT INTO `institutions` VALUES (1,'Гимназия №50 г.Минска','Гимназия'),(3,'Свирская средняя школа','Средняя Школа'),(4,'Гимназия 50 г.Минска','Гимназия '),(5,'Гимназия 50','Гимназия'),(7,'Гимназия №50 г. Минска','Гимназия'),(8,'Средняя Школа №1 г. Пинска','Средняя Школа');
/*!40000 ALTER TABLE `institutions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset`
--

DROP TABLE IF EXISTS `password_reset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `password_reset` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `selector` text NOT NULL,
  `token` longtext NOT NULL,
  `expires` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset`
--

LOCK TABLES `password_reset` WRITE;
/*!40000 ALTER TABLE `password_reset` DISABLE KEYS */;
INSERT INTO `password_reset` VALUES (6,'greerz1212@gmail.com','cad254cc5fbd185b','$2y$10$AEtNY3hrBCWMWa3u5mhYD.fLuXZnLNRWcYVyAsWfpop6c9q2005l2','1557314096');
/*!40000 ALTER TABLE `password_reset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `questions` (
  `questionID` int(11) NOT NULL AUTO_INCREMENT,
  `testID` int(11) DEFAULT NULL,
  `number` varchar(8) NOT NULL,
  `text` varchar(64) NOT NULL,
  `correctAnswerTitle` varchar(8) NOT NULL,
  PRIMARY KEY (`questionID`),
  KEY `question_test_FK_idx` (`testID`),
  CONSTRAINT `questions_tests_FK` FOREIGN KEY (`testID`) REFERENCES `tests` (`testID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,NULL,'1','База данных - это:','1'),(2,NULL,'2','Для чего предназначены запросы:','2');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tests` (
  `testID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) NOT NULL,
  `eventID` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `fileSource` varchar(254) NOT NULL,
  PRIMARY KEY (`testID`),
  KEY `tests_events_FK_idx` (`eventID`),
  CONSTRAINT `tests_events_FK` FOREIGN KEY (`eventID`) REFERENCES `events` (`eventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tests`
--

LOCK TABLES `tests` WRITE;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `middlename` varchar(64) DEFAULT NULL,
  `city` varchar(64) NOT NULL,
  `institutionID` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `gender` char(1) NOT NULL,
  `birthDate` date NOT NULL,
  `telephoneNumber` varchar(17) NOT NULL,
  `photo` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `accountID_UNIQUE` (`accountID`),
  KEY `user_institution_FK_idx` (`institutionID`),
  CONSTRAINT `user_account_FK` FOREIGN KEY (`accountID`) REFERENCES `accounts` (`accountID`),
  CONSTRAINT `user_institution_FK` FOREIGN KEY (`institutionID`) REFERENCES `institutions` (`institutionID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,6,'Шестаков','Валерий','Валерьевич','Семково',1,14,'М','1998-11-12','+375(29)130-25-24',NULL),(4,24,'Рожков','Антон','Александрович','Минск',3,11,'М','1999-12-10','292769108',NULL),(5,25,'Мишук','Антонина','Сергеевна ','Ул.Калиновского 48-468',4,11,'Ж','1999-06-07','291361799',NULL),(6,26,'Свиридов','Павел','Сергеевич','Минск',5,10,'М','1999-07-23','2147483647',NULL),(10,30,'Иванов','Иван','Иванович','Минск',7,11,'М','1999-01-01','+375(29)228-28-28',NULL),(15,36,'Тест','Загрузки','Фото','Пинск',8,10,'М','1999-01-01','+375(29)130-25-24','greerz@mail.ru.png');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'bsuir_olympiad'
--

--
-- Dumping routines for database 'bsuir_olympiad'
--
/*!50003 DROP PROCEDURE IF EXISTS `addUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `addUser`(
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
    itelephoneNumber VARCHAR(17), 
    iphoto VARCHAR(254)
)
BEGIN
	DECLARE _accountID VARCHAR(254);
    DECLARE _institutionID INT;
    
    SET autocommit = 0;
	START TRANSACTION;
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
	
    COMMIT;
	SET autocommit = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-08 19:01:36
