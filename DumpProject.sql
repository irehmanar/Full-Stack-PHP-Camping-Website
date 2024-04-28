CREATE DATABASE  IF NOT EXISTS `project` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `project`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: project
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blogs` (
  `Blog_ID` int NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `blogText` text NOT NULL,
  `date` date NOT NULL,
  `User_ID` int NOT NULL,
  `Picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Blog_ID`),
  KEY `User_ID` (`User_ID`),
  CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (4,'My First Blog Post','This is my first ever blog post! I am excited to share my thoughts and experiences with you.','2024-04-26',1,'https://images.pexels.com/photos/1687845/pexels-photo-1687845.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),(5,'Travel Tips for Beginners','Here are some essential tips for anyone starting out with traveling. From planning to packing, this blog has you covered!','2024-04-26',2,'https://images.pexels.com/photos/1172207/pexels-photo-1172207.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),(6,'Learning a New Language','Are you interested in expanding your horizons?  This blog explores the benefits and challenges of learning a new language.','2024-04-25',3,'https://images.pexels.com/photos/19246664/pexels-photo-19246664/free-photo-of-man-on-pier-with-pedal-boats.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),(7,'The Power of Positive Thinking','Maintaining a positive outlook can make a big difference in your life. Read this blog to learn how to cultivate a more optimistic mindset.','2024-04-24',2,'https://images.pexels.com/photos/1157386/pexels-photo-1157386.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),(8,'Top 5 Must-Read Books','Looking for some recommendations for your next reading adventure? Check out this list of the top 5 must-read books!','2024-04-23',1,'https://images.pexels.com/photos/19714034/pexels-photo-19714034/free-photo-of-back-view-of-man-in-mountains-in-winter.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experience`
--

DROP TABLE IF EXISTS `experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `experience` (
  `experience_ID` int NOT NULL AUTO_INCREMENT,
  `review` text NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `Picture` varchar(255) DEFAULT NULL,
  `Destination` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`experience_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experience`
--

LOCK TABLES `experience` WRITE;
/*!40000 ALTER TABLE `experience` DISABLE KEYS */;
INSERT INTO `experience` VALUES (1,'Best Place. 10/10','Abdul Rehman','2024-04-24','abrehman4163@gmail.com','https://images.pexels.com/photos/11712470/pexels-photo-11712470.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1','Okara'),(2,'Out Standing. Want to visit again.','Hamza Ali','2024-04-01','ali@gmai.com','https://images.pexels.com/photos/14406067/pexels-photo-14406067.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1','Lahore');
/*!40000 ALTER TABLE `experience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `User_ID` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`User_ID`),
  UNIQUE KEY `User_ID` (`User_ID`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Abdul Rehman','abrehman4163@gmail.com','$2y$10$ycf4d7n.rRTFVgKrLE1SnOE6kBymmKyJhRp3aIc4eJbAV0WGbhzXS','Abdul','Rehman'),(2,'Salman Ahmad','salman@gmail.com','$2y$10$QHCe4wWA1SHonGwjSZwwoe1.qJp.fUnxJyOam3Lnt5gVP9WBFv3Ye','Salman','Ahmad'),(3,'Hamza Mahmood','hamza@gmail.com','$2y$10$Id5hJUMbE45/RQOH7nnICOZI59KtLn/Y9wg9gLtzm.CG/1uPXapAS','Hamza','Mahmood');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'project'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-26 23:44:12
