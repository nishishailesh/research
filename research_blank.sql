-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: research
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB-0+deb9u1

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

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` bigint(20) NOT NULL,
  `name` varchar(15) NOT NULL,
  `password` varchar(300) NOT NULL,
  `expirydate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `attachment_name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proposal_id` (`proposal_id`),
  CONSTRAINT `attachment_ibfk_1` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proposal_id` int(11) NOT NULL,
  `reviewer_id` bigint(15) NOT NULL,
  `comment` varchar(5000) NOT NULL,
  `date_time` datetime NOT NULL,
  `attachment` mediumblob NOT NULL,
  `attachment_name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proposal_id` (`proposal_id`,`reviewer_id`),
  KEY `reviewer_id` (`reviewer_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`proposal_id`, `reviewer_id`) REFERENCES `decision` (`proposal_id`, `reviewer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `decision`
--

DROP TABLE IF EXISTS `decision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `decision` (
  `proposal_id` int(11) NOT NULL,
  `reviewer_id` bigint(15) NOT NULL,
  `approval` int(11) NOT NULL,
  PRIMARY KEY (`proposal_id`,`reviewer_id`),
  KEY `reviewer_id` (`reviewer_id`),
  CONSTRAINT `decision_ibfk_1` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`),
  CONSTRAINT `decision_ibfk_2` FOREIGN KEY (`reviewer_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proposal`
--

DROP TABLE IF EXISTS `proposal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proposal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(15) NOT NULL,
  `proposal_name` varchar(500) NOT NULL,
  `type` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL,
  `guide` varchar(50) NOT NULL,
  `year` varchar(5) NOT NULL,
  `Department` varchar(25) NOT NULL,
  `status` enum('001.applied','010.srcm_assigned','020.srcm_approved','030.sent_to_ecms','040.ecm_assigned','060.ecm_approved','070.ecms_approved') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `applicant_id` (`applicant_id`),
  CONSTRAINT `proposal_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` bigint(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `expirydate` date NOT NULL,
  `type` enum('researcher','srcms','srcm','ecms','ecm') NOT NULL,
  `subtype` enum('','UG','PG','Faculty','Intern','PHD') NOT NULL,
  `Institute` varchar(50) NOT NULL,
  `year_of_admission` int(11) DEFAULT NULL,
  `department` enum('N/A','Anatomy','Anesthesiology','Biochemistry','Burns and Plastic Surgery','Cardiology','Community Medicine','Dentistry','Dermatology','Emergency Medicine','Forensic Medicine','General Surgery','Immunohematology and Blood Transfusion','Infectious Disease','Medicine','Microbiology','Nephrology','Neurology','Neurosurgery','Obstetrics and Gynacology','Opthalmology','Orthopaedics','Otorhinolaryngiology','Paediatrics','Pathology','Peadiatric Surgery','Pharmacology','Physiology','Psychiatry','Pulmonary Medicine','Radiology','Radiotherapy','Urology','PSM','Skin & V.D.','ENT','Surgery','Other') NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user.notuse`
--

DROP TABLE IF EXISTS `user.notuse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user.notuse` (
  `id` bigint(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `expirydate` date NOT NULL,
  `type` enum('researcher','srcms','srcm','ecms','ecm') NOT NULL,
  `subtype` enum('','UG','PG','Faculty','Intern','PHD') NOT NULL,
  `Institute` varchar(50) NOT NULL,
  `year_of_admission` int(11) DEFAULT NULL,
  `department` enum('N/A','Anatomy','Anesthesiology','Biochemistry','Burns and Plastic Surgery','Cardiology','Community Medicine','Dentistry','Dermatology','Emergency Medicine','Forensic Medicine','General Surgery','Immunohematology and Blood Transfusion','Infectious Disease','Medicine','Microbiology','Nephrology','Neurology','Neurosurgery','Obstetrics and Gynacology','Opthalmology','Orthopaedics','Otorhinolaryngiology','Paediatrics','Pathology','Peadiatric Surgery','Pharmacology','Physiology','Psychiatry','Pulmonary Medicine','Radiology','Radiotherapy','Urology','PSM','Skin & V.D.','ENT','Surgery','Other') NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-16 16:24:29
