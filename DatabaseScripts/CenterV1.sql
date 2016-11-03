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
 Name: 		Center Table
 Version: 	1
 Author: 	Barrett
 Purpose: 	This table will hold information about individual centers.
*/

/*
Referential Actions:

Center.cid
1a) When a User is deleted, Center.cid is also deleted (CASCADE)
1b) When a User is updated, Center.cid  is also updated (CASCADE)
*/

/*
Other Information:
- description is maximum 1000 characters
- all of address, email, and name are required.
- province has been enumerated to Canadian provences (Default BC)
- country has been enumerated (Always Canada)

*/

/*
Un-implemented attributes:



*/
-- DROP existing Centers table
DROP TABLE IF EXISTS `Centers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;

-- CREATE Centers table
CREATE TABLE `Centers` (
	
	-- cid int(11) NOT NULL,
	cid int(11) NOT NULL AUTO_INCREMENT,
	name varchar(100) NOT NULL,
	email varchar(45) NOT NULL,
	phone varchar(11),
	description varchar(1000),
	online tinyint(1) DEFAULT NULL,
	cost varchar(45) DEFAULT 'N/A',
	-- Address
	street_name varchar(45) NOT NULL,
	city varchar(40) DEFAULT NULL,
	province ENUM('British Columbia','Alberta','Sasketchewan', 'Manitoba','Ontario','Quebec','Nova Scotia','Newfoundland and Labrador', 'New Brunswick', 'Prince Edward Island','Yukon','Northwest Territories', 'Nunavut') NOT NULL,
	country ENUM('Canada') NOT NULL,
	postal_code varchar(45) NOT NULL,
	longitude float(10,6) DEFAULT NULL,
	latitude float(10,6) DEFAULT NULL,
	
	PRIMARY KEY (`cid`)
	
	-- FOREIGN KEY (sid) REFERENCES Users(uid) 
	--		ON DELETE CASCADE,
	--		ON UPDATE CASCADE,

) ENGINE=InnoDB DEFAULT CHARSET=utf8;