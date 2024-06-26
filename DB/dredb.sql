-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: dredb
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Current Database: `dredb`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `dredb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `dredb`;

--
-- Table structure for table `drecategorydb`
--

DROP TABLE IF EXISTS `drecategorydb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drecategorydb` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drecategorydb`
--

LOCK TABLES `drecategorydb` WRITE;
/*!40000 ALTER TABLE `drecategorydb` DISABLE KEYS */;
INSERT INTO `drecategorydb` VALUES (12,'Wings','Yes','Yes'),(15,'Burger','Yes','Yes'),(16,'Drinks','Yes','Yes'),(17,'Rice Meals','Yes','Yes'),(19,'BerBer','Yes','Yes');
/*!40000 ALTER TABLE `drecategorydb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drefaqdb`
--

DROP TABLE IF EXISTS `drefaqdb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drefaqdb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drefaqdb`
--

LOCK TABLES `drefaqdb` WRITE;
/*!40000 ALTER TABLE `drefaqdb` DISABLE KEYS */;
INSERT INTO `drefaqdb` VALUES (1,'Can i see the menu?','Yes, you can! you can found it on our navigation bar','Yes','Yes'),(2,'Where are you located?',' 47 Tahimik St, , Imus, Philippines','Yes','Yes'),(3,'What time do you open and close?','Monday - Thursday : 2pm -10pm; Friday - Sunday: 12pm - 10pm','Yes','Yes'),(4,'How can I contact you?','Our phone number is (046) 501 4730','Yes','Yes'),(5,'Question','What is it?','Yes','Yes');
/*!40000 ALTER TABLE `drefaqdb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drefooddb`
--

DROP TABLE IF EXISTS `drefooddb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drefooddb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `bestseller` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drefooddb`
--

LOCK TABLES `drefooddb` WRITE;
/*!40000 ALTER TABLE `drefooddb` DISABLE KEYS */;
INSERT INTO `drefooddb` VALUES (15,'Dre\'s CheeseBurger','Savor the all natural pure beef patty. DRE\'s custom buns infused with tasty American Cheeses and DRE\'s signature sauce, fresh lettuce, tomato, and onion. Served with fries on the side.',155.00,'Food-Name-7551.png',15,'Yes','No','Yes'),(16,'Dre\'s OG Wings','Infused with our special homemade sweet spicy sauce.\nServed With rich ranch dipSavor and infused with our special homemade sweet ...',214.00,'Food-Name-5872.png',12,'Yes','Yes','Yes'),(17,'HONEY BUTTER','Explore the delicious sweet buttery flavor chicken wings of us that is perfect for those who love crispy wings without the heat. It will serve you the unforgettable flavor of honey in chicken.',214.00,'Food-Name-8137.png',12,'Yes','No','Yes'),(18,'SPICY CHICKEN BURGER','Explore the crispy juicy hand-breaded chicken breast fillet, spread with DRE\'s homemade, topped with freshly made coleslaw, and pickles served on DRE\'s custom buns.',220.00,'Food-Name-9866.png',15,'Yes','Yes','Yes'),(19,'CRUNCHY CHOPS','Explore our mouthful, crunchy, juicy, thick pork cutlets, breaded and fried to a golden brown perfection served with rice.',249.00,'Food-Name-9783.png',17,'Yes','No','Yes'),(21,'Dragon Fruit Pomelo Tea','Experience our dragon fruit pomelo tea that is a delicious and refreshing beverage that is perfect for hot summer days.',140.00,'Food-Name-3788.png',16,'Yes','No','Yes'),(22,'Strawberry Sakura Tea','Try to drink our strawberry sakura tea that combines the floral notes of cherry blossom with the aroma and flavour of fresh strawberries in this delightfully pink drink!',140.00,'Food-Name-4763.png',16,'Yes','No','Yes'),(25,'BBQ Rum Chicken Wings','Indulge with our sweet, spicy, and tangy sauce with perfectly seasoned and smothered in a mouthwatering bbq sauce, each bite offering a harmonious blend of smoky sweetness and savory succulence that will leave you craving for another round.',214.00,'Food-Name-1848.png',12,'Yes','Yes','Yes'),(26,'Burger','Test',100.00,'Food-Name-3405.png',19,'Yes','No','Yes');
/*!40000 ALTER TABLE `drefooddb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dregallerydb`
--

DROP TABLE IF EXISTS `dregallerydb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dregallerydb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dregallerydb`
--

LOCK TABLES `dregallerydb` WRITE;
/*!40000 ALTER TABLE `dregallerydb` DISABLE KEYS */;
INSERT INTO `dregallerydb` VALUES (2,'Cold Drinks In Summer','Be cool this summer with dre orange juice','Picture-Name-1329.jpg','Yes'),(3,'Share Some Beffy Burger with others','Share some, eat some','Picture-Name-8959.jpg','Yes'),(4,'Family Picture','Have fun talk with family at Dre ','Picture-Name-1336.jpg','Yes'),(5,'Burgers','Eattttttttt','Picture-Name-3186.jpg','Yes'),(6,'Test Pic','aaaaaaaaaaa','Picture-Name-5629.jpg','Yes');
/*!40000 ALTER TABLE `dregallerydb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `access_level` varchar(5) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Admin','Admin@dre.com','$2y$10$bqnmua1ZCmxvE1BUpkdQoOwCX6wUUTcKoIVXM5IuNzEfltc81lRmq','admin'),(2,'orly','orlandolopezlpn@gmail.com','$2y$10$KYq/wbPuUalaVkz/WUn7r.RcnSZ9j/TqyXpGpRxCQKdm9xhgxZVmi','user'),(3,'Mhaine','jhermainecamana@yahoo.com','$2y$10$nk29LcSz166Lzhh7EBNs0.A0V5yA7ugoL/6gtEZ6nUB55UV66CK9u','admin'),(4,'jose rizal','jose.rizal@gmail.com','$2y$10$U.4O5x2qkJGgrI0Pvil1tutOPTBR2dK.y6dwVqpELFxMLBDHKFXbW','user');
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

-- Dump completed on 2024-06-26 14:06:29
