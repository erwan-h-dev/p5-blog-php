-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: blog_php
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `authorId` int NOT NULL,
  `content` varchar(255) NOT NULL,
  `createdAt` varchar(100) NOT NULL,
  `postId` int NOT NULL,
  `commentId` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `validatedAt` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_FK_2` (`commentId`),
  KEY `comment_FK` (`authorId`),
  KEY `comment_FK_1` (`postId`),
  CONSTRAINT `comment_FK` FOREIGN KEY (`authorId`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comment_FK_1` FOREIGN KEY (`postId`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comment_FK_2` FOREIGN KEY (`commentId`) REFERENCES `comment` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `follow`
--

DROP TABLE IF EXISTS `follow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `follow` (
  `follower` int DEFAULT NULL,
  `following` int DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `follow_id_IDX` (`id`) USING BTREE,
  KEY `follow_FK` (`follower`),
  KEY `follow_FK_1` (`following`),
  CONSTRAINT `follow_FK` FOREIGN KEY (`follower`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `follow_FK_1` FOREIGN KEY (`following`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `leadSentence` varchar(255) NOT NULL,
  `content` longtext,
  `status` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `authorId` int NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `validatedAt` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_FK` (`authorId`),
  CONSTRAINT `post_FK` FOREIGN KEY (`authorId`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `profilePicture` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `linkedin` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'blog_php'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-09 12:27:23
