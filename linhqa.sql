-- MySQL dump 10.13  Distrib 5.7.38, for Linux (x86_64)
--
-- Host: localhost    Database: linhqa
-- ------------------------------------------------------
-- Server version	5.7.38-0ubuntu0.18.04.1

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
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `time_created` int(11) NOT NULL,
  `time_updated` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_name_index` (`name`),
  KEY `activity_path_index` (`path`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity`
--

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` VALUES (1,'Act 1','1652497377.zip',1,0,1652369958,1652630864),(2,'Act 2','',2,1,1652369958,1652497363),(3,'Act 3','',2,1,1652369958,1652369958),(4,'Act 4','',2,1,1652369958,1652369958),(5,'Act 6','1652497588.zip',4,1,1652497588,1652497598);
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumb` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `time_created` int(11) NOT NULL,
  `time_updated` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `game_name_index` (`name`),
  KEY `game_thumb_index` (`thumb`),
  KEY `game_path_index` (`path`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game`
--

LOCK TABLES `game` WRITE;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` VALUES (1,'Memories Card','1652494425.png','1652494425.zip',1,1652369958,1652630851),(2,'Điền thế','1652494467.png','1652494484.zip',1,1652369958,1652494467),(3,'Sentence Search','1652494484.png','1652494484.zip',1,1652369958,1652494490),(4,'Game toán','1652494549.png','1652494549.zip',1,1652494549,1652494549);
/*!40000 ALTER TABLE `game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (15,'2022_05_12_152846_create_user_table',1),(16,'2022_05_12_152855_create_staff_table',1),(17,'2022_05_12_152909_create_topic_table',1),(18,'2022_05_12_152917_create_game_table',1),(20,'2022_05_12_153017_create_activity_table',1),(21,'2022_05_12_153010_create_topic_has_activity_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `time_created` int(11) NOT NULL,
  `time_updated` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `staff_name_index` (`name`),
  KEY `staff_email_index` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,'Admin','admin@gmail.com','$2y$10$1stZUv4sPz/0RYrS5Z2Vm.L2aWWuRkudrKHK6oKjrUuIbnT9jnWPG',1,1,1591081018,1652631788,'JTBunt8wPYlzEyXfduYsP3L3WuDi8bupMkVr2S4YVvoKkhxBa2g3LLjJRVBq'),(2,'Nhan su 1','admin1@gmail.com','$2y$10$IlJX5Qlr6wHittUTcSMeVO3ttSbz/1q0VN1t1Hueu7fy51xKk2yuC',1,2,1652631930,1652631930,NULL),(3,'adsadadsd','admin222@gmail.com','$2y$10$PUgp7LN1gsLfIhyiHuwXQOjddAnyWAjPIa/.1ud/rw0TVJ9lbYuWS',2,1,1652632073,1652632091,NULL);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topic`
--

DROP TABLE IF EXISTS `topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumb` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `time_created` int(11) NOT NULL,
  `time_updated` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `topic_name_index` (`name`),
  KEY `topic_thumb_index` (`thumb`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topic`
--

LOCK TABLES `topic` WRITE;
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` VALUES (1,'Animals','1652458108.png',1,1652369958,1652630824),(2,'Color','1652458117.png',1,1652369958,1652458117),(3,'Beach','1652458127.png',1,1652369958,1652458127),(16,'In the Storm','1652456997.png',1,1652456997,1652456997),(17,'cây dây leo','1652457066.png',2,1652457066,1652457801),(18,'Chủ đề mới','1652628809.png',1,1652628809,1652628809),(19,'Chủ đề mới','1652630074.png',1,1652628893,1652630283),(20,'In the Storm','1652630841.png',1,1652630841,1652630841);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topic_has_activity`
--

DROP TABLE IF EXISTS `topic_has_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topic_has_activity` (
  `topic_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  PRIMARY KEY (`topic_id`,`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topic_has_activity`
--

LOCK TABLES `topic_has_activity` WRITE;
/*!40000 ALTER TABLE `topic_has_activity` DISABLE KEYS */;
INSERT INTO `topic_has_activity` VALUES (1,2),(2,3),(3,1),(19,4),(19,5),(20,2),(20,3),(20,4),(20,5);
/*!40000 ALTER TABLE `topic_has_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_created` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'kien dep trai','kiendeptrai1@gmail.com',NULL,'$2y$10$O.tjsCeaIFdOUTM6SBpgA.1QYTxdr2pZW/tIiYSVf0rtBz1WmOkDu',NULL,1652632771),(2,'kien dep trai','kiendeptrai11@gmail.com',NULL,'$2y$10$0eCyFfVlNjl60Phhr3P24.caCD520jV9HQxItTffYrQt8edXwUEm.',NULL,1652633328);
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

-- Dump completed on 2022-05-16  0:24:17
