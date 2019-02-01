-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: research
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB-0+deb9u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attachment`
--

DROP TABLE IF EXISTS `attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proposal_id` int(11) NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date_time` datetime NOT NULL,
  `attachment` mediumblob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proposal_id` (`proposal_id`),
  CONSTRAINT `attachment_ibfk_1` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachment`
--

LOCK TABLES `attachment` WRITE;
/*!40000 ALTER TABLE `attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proposal_id` int(11) NOT NULL,
  `reviewer_id` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proposal_id` (`proposal_id`,`reviewer_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`proposal_id`, `reviewer_id`) REFERENCES `decision` (`proposal_id`, `reviewer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (2,1,5,'Explain why are you great.v class=\"border border-primary\" >\';Typography · Bootstrap\nhttps://getbootstrap.com/docs/4.1/content/typography/\nFor a more inclusive and accessible type scale, we assume the browser default root font-size (typically 16px) so visitors can customize their browser defaults as ...\n‎Global settings · ‎Headings · ‎Abbreviations · ‎Blockquotes\n		//my_print_r($ar);\n		$ri=get_user_info($link,$ar[\'reviewer_id\']);','2018-12-25 00:00:00'),(3,3,5,'Done badly, rewrite','2018-12-20 09:22:22'),(4,1,6,'Explaxxxxxxxxxxxxxxxxxxxxxx\r\ntbootstrap.com/docs/4.1/content/typography/\r\nFor a more inclusive and accessible type scale, we assume the browser default root font-size (typically 16px) so visitors can customize their browser defaults as ...\r\n‎Global settings · ‎Headings · ‎Abbreviations · ‎Blockquotes\r\n		//my_print_r($ar);\r\n		$ri=get_user_info($link,$ar[\'reviewer_id\']);','2018-12-25 00:00:00'),(5,1,6,'differet perdon diff time','2018-12-31 10:26:15'),(6,1,5,'				echo \'<input type=hidden name=session_name value=\\\'\'.$_POST[\'session_name\'].\'\\\'>\';\r\n','2018-12-31 09:27:52'),(7,1,5,'echo xxxx  \'<span class=\"text-danger\">Comment not Saved</span>\';','2018-12-31 09:28:31'),(8,1,5,'echo \'<span class=\"text-danger\">Comment not Saved</span>\';','2018-12-31 09:28:52'),(9,1,5,'			\\\'\'.mysqli_real_escape_string($link,$comment).\'\\\',\r\n','2018-12-31 09:30:02'),(10,1,5,'<h4 class=\"d-inline\"><span class=\"badge badge-secondary\">\'.$ri[\'department\'].\'</span></h4>\r\n			<h5 class=\"d-inline\"><span class=\"badge badge-info rounded-circle\">\'.$ri[\'type\'].\'</span></h5>\';','2018-12-31 09:30:20'),(11,1,5,'&lt;h4 class=&quot;d-inline&quot;&gt;&lt;span class=&quot;badge badge-secondary&quot;&gt;\'.$ri[\'department\'].\'&lt;/span&gt;&lt;/h4&gt;\r\n			&lt;h5 class=&quot;d-inline&quot;&gt;&lt;span class=&quot;badge badge-info rounded-circle&quot;&gt;\'.$ri[\'type\'].\'&lt;/span&gt;&lt;/h5&gt;\';\r\n','2018-12-31 09:32:53'),(12,1,5,'&lt;h4 class=&quot;d-inline&quot;&gt;&lt;span class=&quot;badge badge-secondary&quot;&gt;\'.$ri[\'department\'].\'&lt;/span&gt;&lt;/h4&gt;\r\n			&lt;h5 class=&quot;d-inline&quot;&gt;&lt;span class=&quot;badge badge-info rounded-circle&quot;&gt;\'.$ri[\'type\'].\'&lt;/span&gt;&lt;/h5&gt;\';\r\n$sql=\'insert into comment \r\n			(proposal_id,reviewer_id,comment,date_time)\r\n			values(\r\n			\\\'\'.$proposal_id.\'\\\',\r\n			\\\'\'.$reviewer_id.\'\\\',\r\n			\\\'\'.mysqli_real_escape_string($link,htmlspecialchars($comment)).\'\\\',\r\n			now','2018-12-31 09:33:32'),(13,1,5,'&lt;h4 class=&quot;d-inline&quot;&gt;&lt;span class=&quot;badge badge-secondary&quot;&gt;\'.$ri[\'department\'].\'&lt;/span&gt;&lt;/h4&gt;\r\n			&lt;h5 class=&quot;d-inline&quot;&gt;&lt;span class=&quot;badge badge-info rounded-circle&quot;&gt;\'.$ri[\'type\'].\'&lt;/span&gt;&lt;/h5&gt;\';\r\n$sql=\'insert into comment \r\n			(proposal_id,reviewer_id,comment,date_time)\r\n			values(\r\n			\\\'\'.$proposal_id.\'\\\',\r\n			\\\'\'.$reviewer_id.\'\\\',\r\n			\\\'\'.mysqli_real_escape_string($link,htmlspecialchars($comment)).\'\\\',\r\n			now','2018-12-31 09:34:26'),(14,1,5,'&lt;h4 class=&quot;d-inline&quot;&gt;&lt;span class=&quot;badge badge-secondary&quot;&gt;\'.$ri[\'department\'].\'&lt;/span&gt;&lt;/h4&gt;\r\n			&lt;h5 class=&quot;d-inline&quot;&gt;&lt;span class=&quot;badge badge-info rounded-circle&quot;&gt;\'.$ri[\'type\'].\'&lt;/span&gt;&lt;/h5&gt;\';\r\n$sql=\'insert into comment \r\n			(proposal_id,reviewer_id,comment,date_time)\r\n			values(\r\n			\\\'\'.$proposal_id.\'\\\',\r\n			\\\'\'.$reviewer_id.\'\\\',\r\n			\\\'\'.mysqli_real_escape_string($link,htmlspecialchars($comment)).\'\\\',\r\n			now','2018-12-31 09:37:45'),(15,1,5,'not approved. work hard','2018-12-31 09:42:32'),(16,1,5,'OK. Go ahead. Congradulation [APPROVED]','2018-12-31 09:44:18'),(17,1,5,' [APPROVED]','2018-12-31 09:59:14'),(18,1,5,' [APPROVED]','2018-12-31 09:59:40'),(19,1,5,' [APPROVED]','2018-12-31 23:31:49'),(20,1,6,'lillre','2018-12-31 23:34:31'),(21,1,6,'done [APPROVED]','2018-12-31 23:34:47'),(22,1,6,'done [APPROVED]','2018-12-31 23:35:05'),(23,1,6,' [APPROVED]','2018-12-31 23:36:44'),(24,2,6,'hj','2018-12-31 23:40:15'),(25,2,6,' [APPROVED]','2018-12-31 23:40:22'),(26,2,6,' [APPROVED]','2018-12-31 23:49:56'),(27,2,6,' [APPROVED]','2018-12-31 23:50:35'),(28,2,6,' [APPROVED]','2018-12-31 23:51:17'),(29,2,6,' [APPROVED]','2018-12-31 23:51:36'),(30,2,6,' [APPROVED]','2018-12-31 23:52:15'),(31,2,6,' [APPROVED]','2018-12-31 23:53:17'),(32,3,5,'a little more','2019-01-02 09:43:48'),(33,3,5,'Best of luck [APPROVED]','2019-01-02 09:44:00'),(34,3,9,'do allite 666','2019-01-02 09:45:42'),(35,3,9,'OK [APPROVED]','2019-01-02 09:46:04'),(36,2,9,'not approved','2019-01-07 22:05:05'),(37,2,9,'No, increase details','2019-01-08 16:58:54'),(38,2,9,'Good. Congrat. Go ahead [APPROVED]','2019-01-08 16:59:41'),(39,11,1,'Please do something','2019-01-14 11:58:03'),(40,4,1,'','2019-01-14 12:48:44'),(41,4,1,'','2019-01-14 12:48:57'),(42,4,1,'','2019-01-14 12:49:11'),(43,4,1,'','2019-01-14 12:50:01'),(44,4,1,'ll 00----','2019-01-14 14:57:51'),(49,4,5,'I am also commentig','2019-01-14 15:10:47'),(50,4,5,'xyz','2019-01-14 15:11:17'),(51,4,5,'xyz','2019-01-14 15:11:29'),(53,12,7,'$_POST[\'action\']==\'save_comment\'','2019-01-14 15:15:54'),(54,12,5,'ok','2019-01-14 15:17:57'),(55,12,5,'OK. Go ahead [APPROVED]','2019-01-14 15:18:10'),(56,12,6,'OK. Fine [APPROVED]','2019-01-14 15:18:37'),(57,12,1,'OK. Done from my side [APPROVED]','2019-01-14 15:27:57'),(59,11,1,'when?','2019-01-14 23:22:43'),(60,12,7,'Thanks Sir 1 2 3','2019-01-14 23:55:56'),(61,4,1,'ok [APPROVED]','2019-01-15 10:49:35'),(62,13,5,'Give detailed methodology','2019-01-15 12:29:19'),(63,13,7,'Done and upoloaed','2019-01-15 12:31:03'),(64,13,5,'OK [APPROVED]','2019-01-15 12:32:35'),(65,13,6,'Ok [APPROVED]','2019-01-15 12:33:26'),(66,13,1,'OK [APPROVED]','2019-01-15 12:34:10'),(67,13,1,'OK [APPROVED]','2019-01-15 12:34:26'),(70,13,7,'thank you','2019-01-21 15:53:46');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `decision`
--

DROP TABLE IF EXISTS `decision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `decision` (
  `proposal_id` int(11) NOT NULL,
  `reviewer_id` int(11) NOT NULL,
  `approval` int(11) NOT NULL,
  PRIMARY KEY (`proposal_id`,`reviewer_id`),
  KEY `reviewer_id` (`reviewer_id`),
  CONSTRAINT `decision_ibfk_1` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`),
  CONSTRAINT `decision_ibfk_2` FOREIGN KEY (`reviewer_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `decision`
--

LOCK TABLES `decision` WRITE;
/*!40000 ALTER TABLE `decision` DISABLE KEYS */;
INSERT INTO `decision` VALUES (1,5,1),(1,6,1),(2,6,1),(2,9,1),(3,5,1),(3,9,1),(4,1,1),(4,5,0),(4,6,0),(4,7,0),(5,5,0),(5,9,0),(11,1,0),(12,1,1),(12,5,1),(12,6,1),(12,7,0),(13,1,1),(13,5,1),(13,6,1),(13,7,0),(14,5,0),(14,6,0),(14,9,0),(15,1,0),(16,1,0),(17,1,0);
/*!40000 ALTER TABLE `decision` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `help`
--

DROP TABLE IF EXISTS `help`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `help`
--

LOCK TABLES `help` WRITE;
/*!40000 ALTER TABLE `help` DISABLE KEYS */;
INSERT INTO `help` VALUES (1,'manage user  (add, edit, delete, view) - by clerical staff\r\n\r\nreview_group (add, edit, delete, view) - by \r\n\r\nlogin\r\n	if type=applicant\r\n		add/edit/view their own [proposal]\r\n		view/add [comment] of their own praposal\r\n		view [decision] of their own praposal\r\n	if type=reviewer or chairman\r\n		view [proposal] if they are to make decision\r\n		view/edit their approval field of [decision]\r\n		view/add [comment] on proposal if they are to make decision\r\n	if type=chairman\r\n		add/view/delete all fields of [decision] but can not edit approval field\r\n			\r\n\r\n');
/*!40000 ALTER TABLE `help` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposal`
--

DROP TABLE IF EXISTS `proposal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proposal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `proposal_name` varchar(500) NOT NULL,
  `type` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL,
  `guide` varchar(50) NOT NULL,
  `status` enum('001.applied','010.srcm_assigned','020.srcm_approved','030.sent_to_ecms','040.ecm_assigned','060.ecm_approved','070.ecms_approved') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `applicant_id` (`applicant_id`),
  CONSTRAINT `proposal_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposal`
--

LOCK TABLES `proposal` WRITE;
/*!40000 ALTER TABLE `proposal` DISABLE KEYS */;
INSERT INTO `proposal` VALUES (1,7,'Amit is great.Amit is greatAmit is greatAmit is greatAmit is greatAmit is greatAmit is greatAmit is greatAmit is greatAmit is greatAmit is greatAmit is greatAmit is great','','2018-12-03 00:00:00','','030.sent_to_ecms'),(2,8,'dunia amar rahe','','2018-12-03 08:00:00','','030.sent_to_ecms'),(3,7,'Prestaining in PAGE','','2018-12-14 08:19:00','','030.sent_to_ecms'),(4,7,'xyz sad 3423&^^@_)(@@+_!@+)#@!:\r\n\":\">?>??','Dissertation','2019-01-08 23:39:42','Dr Verma','010.srcm_assigned'),(5,7,'xyz sad 3423&^^@_)(@@+_!@+)#@!:\r\n\":\">?>??','PhD','2019-01-08 23:44:27','D Desai','001.applied'),(6,1,'dddd','Paper','2019-01-14 11:46:07','','001.applied'),(7,1,'dddd','Clinical Trial','2019-01-14 11:47:26','','001.applied'),(8,1,'dddd xxx %%^$#@@!~~~~~~~~~~~','','2019-01-14 11:51:41','','001.applied'),(9,1,'dddd','','2019-01-14 11:52:00','','001.applied'),(10,1,'eeeee','','2019-01-14 11:56:00','','001.applied'),(11,1,'eeeee','','2019-01-14 11:57:21','','001.applied'),(12,7,'Entered proposal title','','2019-01-14 15:15:24','','030.sent_to_ecms'),(13,7,'PSM Psy','','2019-01-15 12:19:01','','030.sent_to_ecms'),(14,1,'ronak','','2019-01-21 15:50:08','','010.srcm_assigned'),(15,1,'Apple','','2019-01-29 22:06:22','','001.applied'),(16,1,'Applee ee','Poster','2019-01-29 22:08:56','Dr VErma','001.applied'),(17,1,'aaaaq','Poster','2019-01-30 10:29:08','krishna','001.applied');
/*!40000 ALTER TABLE `proposal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `expirydate` date NOT NULL,
  `type` enum('researcher','srcms','srcm','ecms','ecm') NOT NULL,
  `subtype` varchar(20) NOT NULL,
  `year_of_admission` int(11) NOT NULL,
  `department` enum('Anatomy','Physiology','Pathology','Medicine') NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'shailesh','tXc6mtlAdy6lc','2020-05-08','srcms','',0,'Pathology','nishishailesh@gmail.com','9664555812'),(2,'nimesh','tXRPKODJ8vTgc','2020-05-08','ecms','',0,'Medicine','',''),(3,'punit','YZIuax1DavYWA','2020-05-08','ecm','',0,'Physiology','',''),(4,'piyush','fXLUmzkIumLrQ','2020-05-08','ecm','',0,'Anatomy','',''),(5,'sarita','02siOVNkc.iqA','2020-05-08','srcm','',0,'Physiology','',''),(6,'alok','BENdRIR1ddOJU','2020-05-08','srcm','',0,'Physiology','',''),(7,'amit','jdK7RFj7x0eCU','2022-12-29','researcher','UG',0,'Pathology','',''),(8,'amar','rtJAsbQ9oxFiM','2022-12-29','researcher','PG',2017,'Medicine','',''),(9,'rohan','zJY9OlraRCcOU','2020-05-08','srcm','',0,'Anatomy','','');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-01 14:15:19
