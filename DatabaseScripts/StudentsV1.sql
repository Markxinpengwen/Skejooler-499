CREATE DATABASE  IF NOT EXISTS `skejooler`;
USE `skejooler`;

-- Old Environment Settings (Commented Out)
/*!40100 DEFAULT CHARACTER SET utf8 */;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*
 Name: 		Students Table
 Version: 	1
 Author: 	Barrett
 Purpose: 	This table will hold information about individual students.
*/

/*
Referential Actions:

Student.sid
1a) When a User is deleted, Student.sid is also deleted (CASCADE)
1b) When a User is updated, Student.sid  is also updated (CASCADE)

Student.institution
2a) When an Institution is deleted, Student.institution is SET to NULL
2b) When an Institution is updated, Student.institution is updated (CASCADE)

*/

/*
Other Information:
- removed Profile Picture BLOB
- gender as NOT NULL had the first ENUM element as default (ie.'not declared').
- age is optional
*/

/*
Un-implemented attributes:

"sid" will be a foreign key to uid from the Users table:
"institution" will be a foreign key to iid from Institutions table

*/
-- DROP existing Students table
DROP TABLE IF EXISTS `Students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;

-- CREATE Students table
CREATE TABLE `Students` (
	
	-- sid int(11) NOT NULL,
	sid int(11) NOT NULL AUTO_INCREMENT,
	firstName varchar(45) NOT NULL,
	lastName varchar(45) NOT NULL,
	email varchar(45) NOT NULL,
	gender ENUM('not declared','male','female','transgender') NOT NULL,
	age int(2),
	-- institution int(11),
	
	PRIMARY KEY (`sid`)
	
	-- FOREIGN KEY (institution) REFERENCES Institution(iid) 
	--		ON DELETE SET NULL,
	--		ON UPDATE CASCADE,
	
	-- FOREIGN KEY (sid) REFERENCES Users(uid) 
	--		ON DELETE CASCADE,
	--		ON UPDATE CASCADE,

) ENGINE=InnoDB DEFAULT CHARSET=utf8;


