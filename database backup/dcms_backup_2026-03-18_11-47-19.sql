-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: dcms_db
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
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `priority` varchar(255) NOT NULL DEFAULT 'normal',
  `audience` varchar(255) NOT NULL DEFAULT 'all',
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` VALUES (1,'First Semester Lecture Timetable Released','The first semester continuous lectures timetable for all levels has been released. Students are advised to check the departmental notice board and the website for their schedules. All lectures will hold at the designated venues.','normal','All Students','2026-03-14 23:00:00','2026-02-22 14:37:25','2026-02-22 16:30:13'),(2,'IT/SIWES Logbook Submission Deadline','All 300-level students who completed their IT/SIWES are reminded to submit their logbooks and presentation reports to the SIWES coordinator before the end of the month. Late submissions will not be accepted.','high','All Students','2026-03-24 23:00:00','2026-02-22 14:37:25','2026-02-22 16:28:07'),(3,'Staff Senate Meeting — March 2026','All academic staff are invited to the departmental senate meeting scheduled for the first Monday of March at 10:00 AM in the HOD\'s conference room. Agenda includes curriculum review and NUC compliance.','normal','staff','2026-03-08 14:37:25','2026-02-22 14:37:25','2026-02-22 14:37:25');
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carousel_slides`
--

DROP TABLE IF EXISTS `carousel_slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carousel_slides` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subtitle` text DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `overlay_color` varchar(255) NOT NULL DEFAULT 'rgba(0,0,0,0.5)',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carousel_slides`
--

LOCK TABLES `carousel_slides` WRITE;
/*!40000 ALTER TABLE `carousel_slides` DISABLE KEYS */;
INSERT INTO `carousel_slides` VALUES (1,'Empowering the Future of Computing','Discover world-class education, pioneering research, and a community dedicated to solving global challenges through technology.','Explore Department','/about','carousel/zjgosilFsYrGahxOT7MEXTD37K8fYdgPsN6npAPc.jpg','rgba(0,60,30,0.55)',1,2,'2026-02-21 22:14:16','2026-02-21 23:12:08'),(2,'Department of Computer Science','Faculty of Natural & Applied Sciences, Nasarawa State University, Keffi — Bridging the Digital Divide in an Emerging Economy.','View Programmes','/academics','carousel/Cb3wUCzsxHmvT29UCIGGL0j01ZUx3h8bomeYtM3R.jpg','rgba(0,50,30,0.6)',1,1,'2026-02-21 22:14:16','2026-02-21 23:09:25'),(3,'A Community of Innovation','Learn, collaborate, and grow in an environment built for the next generation of tech professionals and thought leaders.','Meet Our Team','/people','carousel/slide-3.jpg','rgba(0,40,20,0.55)',1,3,'2026-02-21 22:14:16','2026-02-21 22:14:16'),(4,'DEPARTMENTAL ASSOCIATION','Students Association','NACOS','/faculty','carousel/7DhgWlPPAn65E18LVYAgWQWa6sbOYJd8g0VZrVSt.jpg','rgba(0,0,0,0.5)',1,4,'2026-02-21 23:08:14','2026-02-21 23:08:14');
/*!40000 ALTER TABLE `carousel_slides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` bigint(20) unsigned NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `author_name` varchar(255) DEFAULT NULL,
  `author_email` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_news_id_is_approved_index` (`news_id`,`is_approved`),
  KEY `comments_parent_id_index` (`parent_id`),
  CONSTRAINT `comments_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,3,NULL,NULL,NULL,'this is the first comment','Ab1rjlgRl6PnbCwgc3GgJOKD2XD44racaZjpppZp','127.0.0.1',1,'2026-03-07 15:15:52','2026-03-07 15:15:52');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_staff`
--

DROP TABLE IF EXISTS `course_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_staff` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) unsigned NOT NULL,
  `staff_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_staff_course_id_foreign` (`course_id`),
  KEY `course_staff_staff_id_foreign` (`staff_id`),
  CONSTRAINT `course_staff_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `course_staff_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_staff`
--

LOCK TABLES `course_staff` WRITE;
/*!40000 ALTER TABLE `course_staff` DISABLE KEYS */;
INSERT INTO `course_staff` VALUES (3,1,1181,NULL,NULL),(4,2,1182,NULL,NULL);
/*!40000 ALTER TABLE `course_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `programme_id` bigint(20) unsigned NOT NULL,
  `code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `credit_units` int(11) NOT NULL DEFAULT 3,
  `level` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `is_elective` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_code_unique` (`code`),
  KEY `courses_programme_id_foreign` (`programme_id`),
  CONSTRAINT `courses_programme_id_foreign` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,1,'CS 111','Introduction to Computing',3,100,1,'This is the introductionto computing.',0,'2026-02-22 15:34:37','2026-02-22 15:34:37'),(2,1,'CS 113','Introduction to Hardware',2,100,1,'Introduction to Hardware',0,'2026-02-22 16:16:23','2026-02-22 16:16:23');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department_settings`
--

DROP TABLE IF EXISTS `department_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `department_settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department_settings`
--

LOCK TABLES `department_settings` WRITE;
/*!40000 ALTER TABLE `department_settings` DISABLE KEYS */;
INSERT INTO `department_settings` VALUES (1,'footer_bg_image','site/footer-bg.jpg','general','2026-02-21 22:14:57','2026-02-21 22:14:57'),(2,'hero_about','site/heroes/Kp0r1linWcA5EXlVt77FBMSWyM18b9eUaoffzfE7.jpg','general','2026-02-22 12:05:02','2026-02-22 12:06:02'),(3,'hero_academics','site/heroes/7YwBvsVZThOCODdd0CV7jkIW62BSFxWymk05uZQB.jpg','general','2026-02-22 12:06:02','2026-02-22 12:06:06'),(4,'hero_blog','site/heroes/oLXWm4hPPe1IzK5tC631PyxXS3FtXd10krXVOOd9.jpg','general','2026-02-22 12:06:02','2026-02-22 12:06:06'),(5,'hero_contact','site/heroes/5oeW9JoEBSsgGPapCUU1Oj1cii8jDECq5fY1vzDY.jpg','general','2026-02-22 12:06:02','2026-02-22 12:06:06'),(6,'stat_1_icon','fa-regular fa-building','page_home','2026-02-22 13:07:36','2026-02-22 13:07:36'),(7,'stat_1_value','2019','page_home','2026-02-22 13:07:36','2026-02-22 13:07:36'),(8,'stat_1_label','Established','page_home','2026-02-22 13:07:36','2026-02-22 13:07:36'),(9,'stat_2_icon','fa-solid fa-book-open','page_home','2026-02-22 13:07:36','2026-02-22 13:50:24'),(10,'stat_2_value','46','page_home','2026-02-22 13:07:36','2026-02-22 13:40:43'),(11,'stat_2_label','Courses','page_home','2026-02-22 13:07:36','2026-02-22 13:40:43'),(12,'stat_3_icon','fa-solid fa-graduation-cap','page_home','2026-02-22 13:07:36','2026-02-22 13:50:24'),(13,'stat_3_value','6','page_home','2026-02-22 13:07:36','2026-02-22 13:40:43'),(14,'stat_3_label','Programmes','page_home','2026-02-22 13:07:36','2026-02-22 13:40:43'),(15,'stat_4_icon','fa-solid fa-building-user','page_home','2026-02-22 13:07:36','2026-02-22 13:50:24'),(16,'stat_4_value','3','page_home','2026-02-22 13:07:36','2026-02-22 13:40:43'),(17,'stat_4_label','Departments','page_home','2026-02-22 13:07:36','2026-02-22 13:40:43'),(18,'hod_welcome_message','You are welcome to the Department of Computer Science, which was established as a Unit in the Department of Mathematical Sciences, Faculty of Natural and Applied Sciences in the 2003/2004 academic session and was upgraded to the status of a Department in the 2017/18 Session. With effect from the 2021//2022 academic session, two new programmes (Data Science & Technology and Cybersecurity & Forensic) shall be included with the Computer Science. The goal of the department is to be a leading edge in the area of competition, innovation, and society responsive computing solutions aligning strategically with the university’s mission. We are committed to promoting technological advancement by providing a conducive environment for teaching, learning, and research.','page_home','2026-02-22 13:07:36','2026-02-22 13:08:00'),(19,'home_programmes_badge','What We Offer','page_home','2026-02-22 13:07:36','2026-02-22 13:07:36'),(20,'home_programmes_title','Academic Programmes','page_home','2026-02-22 13:07:36','2026-02-22 13:07:36'),(21,'home_programmes_subtitle','Comprehensive undergraduate and postgraduate programmes designed to shape the next generation of global tech leaders.','page_home','2026-02-22 13:07:36','2026-02-22 13:07:36'),(22,'home_news_badge','Stay Informed','page_home','2026-02-22 13:07:36','2026-02-22 13:07:36'),(23,'home_news_title','Latest News','page_home','2026-02-22 13:07:36','2026-02-22 13:07:36'),(24,'home_events_badge','Calendar','page_home','2026-02-22 13:07:36','2026-02-22 13:07:36'),(25,'home_events_title','Upcoming Events','page_home','2026-02-22 13:07:36','2026-02-22 13:07:36'),(26,'hod_name','Dr. B. A. Ajayi','page_home','2026-02-22 13:17:20','2026-02-22 13:17:20'),(27,'hod_rank','Associate Professor','page_home','2026-02-22 13:17:20','2026-02-22 13:17:20'),(28,'hod_photo','site/page-content/home/JeS0IsiwPNLEtS7NR1QsWV8gTbVPxdQHXfynvtFO.jpg','hero','2026-02-22 13:17:20','2026-02-22 13:17:20'),(29,'stat_5_icon','fa-solid fa-award','page_home','2026-02-22 13:40:43','2026-02-22 13:50:24'),(30,'stat_5_value','NUC','page_home','2026-02-22 13:40:43','2026-02-22 13:40:43'),(31,'stat_5_label','Full Accreditation','page_home','2026-02-22 13:40:43','2026-02-22 13:40:43'),(32,'home_staff_badge','Our Team','page_home','2026-02-22 14:31:19','2026-02-22 14:31:19'),(33,'home_staff_title','Meet Our Faculty','page_home','2026-02-22 14:31:19','2026-02-22 14:31:19'),(34,'home_staff_subtitle','Dedicated academics and researchers shaping the future of computer science education.','page_home','2026-02-22 14:31:19','2026-02-22 14:31:19'),(35,'home_gallery_badge','Photo Gallery','page_home','2026-02-22 14:31:19','2026-02-22 14:31:19'),(36,'home_gallery_title','Department Life','page_home','2026-02-22 14:31:19','2026-02-22 14:31:19'),(37,'home_gallery_subtitle','Moments from events, lectures, and campus life','page_home','2026-02-22 14:31:19','2026-02-22 14:31:19'),(38,'home_systems_badge','Quick Access','page_home','2026-02-22 14:31:19','2026-02-22 14:31:19'),(39,'home_systems_title','Department Systems','page_home','2026-02-22 14:31:19','2026-02-22 14:31:19'),(40,'home_systems_subtitle','Access our online platforms, portals, and tools for students and staff.','page_home','2026-02-22 14:31:19','2026-02-22 14:31:19'),(41,'home_explore_badge','Explore','page_home','2026-02-22 14:31:19','2026-02-22 14:31:19'),(42,'home_explore_title','Discover More','page_home','2026-02-22 14:31:19','2026-02-22 14:31:19'),(43,'home_explore_subtitle','Everything you need to know about the department — all in one place.','page_home','2026-02-22 14:31:19','2026-02-22 14:31:19'),(44,'home_cta_title','Ready to Join Us?','page_home','2026-02-22 14:31:19','2026-02-22 14:31:19'),(45,'home_cta_subtitle','Whether you\'re a prospective student, an alumnus, or just curious about the department, we\'d love to hear from you.','page_home','2026-02-22 14:31:19','2026-02-22 14:31:19'),(46,'home_hod_badge','Welcome Message','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(47,'home_hod_title','From the Head of Department','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(48,'home_hod_badge_title','Excellence','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(49,'home_hod_badge_subtitle','In Leadership','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(50,'home_staff_btn_text','View All Staff','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(51,'home_staff_count','4','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(52,'home_gallery_btn_text','View All Photos','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(53,'home_gallery_count','4','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(54,'home_news_btn_text','View All','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(55,'home_events_btn_text','View Full Calendar','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(56,'home_qlink1_label','About Us','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(57,'home_qlink1_desc','Our history & vision','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(58,'home_qlink1_icon','fa-solid fa-building-columns','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(59,'home_qlink1_url','/about','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(60,'home_qlink2_label','Academics','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(61,'home_qlink2_desc','Programmes & courses','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(62,'home_qlink2_icon','fa-solid fa-graduation-cap','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(63,'home_qlink2_url','/academics','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(64,'home_qlink3_label','Our Staff','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(65,'home_qlink3_desc','Faculty directory','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(66,'home_qlink3_icon','fa-solid fa-users','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(67,'home_qlink3_url','/people','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(68,'home_qlink4_label','Blog & News','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(69,'home_qlink4_desc','Latest updates','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(70,'home_qlink4_icon','fa-solid fa-newspaper','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(71,'home_qlink4_url','/research-news','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(72,'home_qlink5_label','NACOS','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(73,'home_qlink5_desc','Contact & connect','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(74,'home_qlink5_icon','fa-solid fa-users','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(75,'home_qlink5_url','/contact-nacos','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(76,'home_qlink6_label','Gallery','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(77,'home_qlink6_desc','Photos & albums','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(78,'home_qlink6_icon','fa-solid fa-images','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(79,'home_qlink6_url','/about#gallery','page_home','2026-02-22 15:00:05','2026-02-22 15:00:05'),(80,'home_cta_btn1_text','Contact Us','page_home','2026-02-22 15:00:06','2026-02-22 15:00:06'),(81,'home_cta_btn1_url','/contact-nacos#apply','page_home','2026-02-22 15:00:06','2026-02-22 15:00:06'),(82,'home_cta_btn1_icon','fa-solid fa-envelope','page_home','2026-02-22 15:00:06','2026-02-22 15:00:06'),(83,'home_cta_btn2_text','About the Department','page_home','2026-02-22 15:00:06','2026-02-22 15:00:06'),(84,'home_cta_btn2_url','/about','page_home','2026-02-22 15:00:06','2026-02-22 15:00:06'),(85,'home_cta_btn2_icon','fa-solid fa-circle-info','page_home','2026-02-22 15:00:06','2026-02-22 15:00:06'),(86,'home_cta_btn3_text','View Programmes','page_home','2026-02-22 15:00:06','2026-02-22 15:00:06'),(87,'home_cta_btn3_url','/academics','page_home','2026-02-22 15:00:06','2026-02-22 15:00:06'),(88,'home_cta_btn3_icon','fa-solid fa-graduation-cap','page_home','2026-02-22 15:00:06','2026-02-22 15:00:06'),(89,'home_nacos_badge','Student Association','page_nacos','2026-02-22 18:02:09','2026-02-22 18:02:09'),(90,'home_nacos_title','NACOS','page_nacos','2026-02-22 18:02:09','2026-02-22 18:02:09'),(91,'home_nacos_subtitle','The National Association of Computing Students (NUK Chapter) — empowering students through leadership, innovation and community.','page_nacos','2026-02-22 18:02:09','2026-02-22 18:02:09'),(92,'home_nacos_about_title','About NACOS','page_nacos','2026-02-22 18:02:09','2026-02-22 18:02:09'),(93,'home_nacos_about_tag','NUK Chapter','page_nacos','2026-02-22 18:02:09','2026-02-22 18:02:09'),(94,'home_nacos_about_text','NACOS is the umbrella body for all computing students. We foster academic excellence, professional development, and social bonds among members through events, workshops, competitions, and community service.','page_nacos','2026-02-22 18:02:09','2026-02-22 18:02:09'),(95,'home_nacos_stat1_label','Past Leaders','page_nacos','2026-02-22 18:02:09','2026-02-22 18:02:09'),(96,'home_nacos_stat2_value','10+','page_nacos','2026-02-22 18:02:09','2026-02-22 18:02:09'),(97,'home_nacos_stat2_label','Events Hosted','page_nacos','2026-02-22 18:02:09','2026-02-22 18:02:09'),(98,'home_nacos_stat3_value','3000+','page_nacos','2026-02-22 18:02:09','2026-02-22 18:02:09'),(99,'home_nacos_stat3_label','Active Members','page_nacos','2026-02-22 18:02:09','2026-02-22 18:02:09'),(100,'home_nacos_cta_title','Explore NACOS History','page_nacos','2026-02-22 18:02:09','2026-02-22 18:02:09'),(101,'home_nacos_cta_desc','See all past leaders, their tenure and achievements','page_nacos','2026-02-22 18:02:09','2026-02-22 18:02:09'),(102,'nacos_presidents_title','Former NACOS Presidents','page_nacos','2026-02-22 18:02:09','2026-02-22 18:02:09'),(103,'nacos_presidents_subtitle','Honoring the leaders of the National Association of Computing Students (NUK Chapter)','page_nacos','2026-02-22 18:02:09','2026-02-22 18:02:09'),(104,'nacos_presidents_intro',NULL,'page_nacos','2026-02-22 18:02:09','2026-02-22 18:02:09'),(105,'contact_email','info@cmp.nsuk.edu.ng','page_contact','2026-02-22 19:00:15','2026-03-07 14:58:53'),(106,'contact_phone','+234 (0) 903 8535 530','page_contact','2026-02-22 19:00:16','2026-03-07 14:58:53'),(107,'contact_address','Nasarawa State University, Keffi,\\nKeffi, Nasarawa State','page_contact','2026-02-22 19:00:16','2026-03-07 14:56:12'),(108,'map_embed_url','https://maps.app.goo.gl/8PC9poBMih2ucmNw9','general','2026-02-22 19:00:16','2026-02-22 19:00:16'),(109,'social_facebook',NULL,'general','2026-02-22 19:00:16','2026-02-22 19:00:16'),(110,'social_twitter',NULL,'general','2026-02-22 19:00:16','2026-02-22 19:00:16'),(111,'social_linkedin',NULL,'general','2026-02-22 19:00:16','2026-02-22 19:00:16'),(112,'social_youtube',NULL,'general','2026-02-22 19:00:16','2026-02-22 19:00:16'),(113,'academic_year','2023/2024','general','2026-02-22 19:00:16','2026-02-22 19:00:16'),(114,'academic_semester','1','general','2026-02-22 19:00:16','2026-02-22 19:00:16'),(115,'admission_status','open','general','2026-02-22 19:00:16','2026-02-22 19:00:16'),(116,'color_primary','#16a34a','branding','2026-02-22 19:00:16','2026-02-22 19:00:16'),(117,'color_secondary','#15803d','branding','2026-02-22 19:00:16','2026-02-22 19:00:16'),(118,'color_accent','#22c55e','branding','2026-02-22 19:00:16','2026-02-22 19:00:16'),(119,'nacos_page_about_title','About NACOS','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(120,'nacos_page_about_text','The National Association of Computing Students (NACOS) is the umbrella body for all students studying computing-related disciplines. Our NUK Chapter is dedicated to fostering academic excellence, professional development, and strong social bonds among members.','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(121,'nacos_page_about_text2','Through workshops, hackathons, seminars, and community outreach, NACOS prepares students for the ever-evolving tech industry while building a supportive network that extends well beyond graduation.','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(122,'nacos_page_stat_events','50+','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(123,'nacos_page_stat_events_label','Events Hosted','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(124,'nacos_page_stat_members','500+','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(125,'nacos_page_stat_members_label','Active Members','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(126,'nacos_page_stat_awards','20+','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(127,'nacos_page_stat_awards_label','Awards Won','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(128,'nacos_page_pillar1_title','Our Mission','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(129,'nacos_page_pillar1_text','To promote academic excellence, advance computing knowledge, and nurture future tech leaders through hands-on learning, mentorship, and industry collaboration.','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(130,'nacos_page_pillar2_title','Our Vision','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(131,'nacos_page_pillar2_text','To be the foremost student body shaping innovative, ethical, and globally competitive computing professionals in Nigeria and beyond.','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(132,'nacos_page_pillar3_title','Our Values','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(133,'nacos_page_pillar3_text','Innovation, integrity, collaboration, inclusivity, and continuous learning form the bedrock of everything we do as an association.','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(134,'nacos_page_activities_title','Our Activities','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(135,'nacos_act1_title','Hackathons & Coding Contests','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(136,'nacos_act1_desc','Regular programming competitions that test skills and encourage creative problem-solving among members.','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(137,'nacos_act2_title','Workshops & Seminars','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(138,'nacos_act2_desc','Industry-led training sessions on trending technologies like AI, cloud computing, and cybersecurity.','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(139,'nacos_act3_title','Mentorship Programme','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(140,'nacos_act3_desc','Pairing junior students with senior peers and alumni for academic guidance and career advice.','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(141,'nacos_act4_title','Community Service','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(142,'nacos_act4_desc','Giving back through IT literacy drives, school outreach, and digital empowerment projects.','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(143,'nacos_act5_title','Social & Sports Events','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(144,'nacos_act5_desc','Building bonds beyond the classroom with get-togethers, game nights, and inter-departmental sports.','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(145,'nacos_act6_title','Annual NACOS Week','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(146,'nacos_act6_desc','A week-long celebration with talks, exhibitions, awards, and cultural events showcasing computing talent.','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(147,'nacos_page_cta_title','Want to Know More?','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(148,'nacos_page_cta_subtitle','Reach out to us for questions, collaborations, or if you want to get involved with NACOS.','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(149,'nacos_page_leaders_title','Past NACOS Presidents','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(150,'nacos_page_leaders_subtitle','Honoring the visionaries who led our chapter and shaped its legacy.','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(151,'nacos_official_website_url','https://nacosnsuk.or.ng','page_nacos','2026-03-04 17:11:03','2026-03-04 17:11:03'),(152,'nacos_official_website_label','Visit Major NACOS Website','page_nacos','2026-03-04 17:11:04','2026-03-04 17:11:04'),(153,'contact_hero_badge','Get in Touch','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(154,'contact_hero_title','Contact the Department','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(155,'contact_hero_subtitle','Have questions, feedback, or partnership inquiries? We\'d love to hear from you.','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(156,'contact_hours','Mon – Fri: 8 AM – 4 PM','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(157,'contact_form_title','Send Us a Message','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(158,'contact_form_subtitle','Fill out the form below and we\'ll get back to you as soon as possible.','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(159,'contact_about_title','About the Department','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(160,'contact_about_text','The Department of Computer Science at Nasarawa State University, Keffi is dedicated to producing world-class computing professionals through quality education, research, and community engagement.','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(161,'contact_partner_title','Partner With Us','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(162,'contact_partner_text','We collaborate with tech companies and organizations for internships, joint research, and curriculum development. Let\'s shape the next generation of IT leaders together.','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(163,'contact_partner_btn','Propose Partnership','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(164,'contact_map_mode','embed','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(165,'contact_map_embed','https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d1315.8945830128798!2d7.9077796103024305!3d8.841833078978459!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2sng!4v1772898449874!5m2!1sen!2sng','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(166,'contact_map_lat','8.8467','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(167,'contact_map_lng','7.8736','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(168,'contact_map_zoom','15','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(169,'contact_show_partnership','1','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(170,'contact_show_key_contacts','1','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(171,'contact_show_faqs','1','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(172,'contact_show_map','1','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(173,'contact_key_contacts_title','Key Department Contacts','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(174,'contact_key_contacts_subtitle','Reach out directly to the relevant office for faster assistance.','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(175,'contact_key_contacts','[{\"role\":\"Head of Department\",\"name\":\"Dr. Example Name\",\"email\":\"hod@cs.nsuk.edu.ng\",\"phone\":\"+234 800 000 0001\"},{\"role\":\"Departmental Secretary\",\"name\":\"Mrs. Example Name\",\"email\":\"secretary@cs.nsuk.edu.ng\",\"phone\":\"+234 800 000 0002\"},{\"role\":\"Exam Officer\",\"name\":\"Mr. Example Name\",\"email\":\"exams@cs.nsuk.edu.ng\",\"phone\":\"+234 800 000 0003\"}]','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(176,'contact_faq_title','Frequently Asked Questions','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(177,'contact_faq_subtitle','Quick answers to common questions about the department.','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12'),(178,'contact_faqs','[{\"q\":\"How do I apply for admission into the department?\",\"a\":\"Visit the university\'s admission portal at the start of each academic session. Select Computer Science as your preferred course and follow the application steps.\"},{\"q\":\"What are the requirements for admission?\",\"a\":\"You need at least 5 O\'Level credits including Mathematics and English Language, plus a minimum UTME score as set by JAMB for the session.\"},{\"q\":\"Can I visit the department in person?\",\"a\":\"Yes! Our offices are open Monday to Friday, 8 AM – 4 PM. We recommend scheduling an appointment for specific inquiries.\"},{\"q\":\"How can I get my transcript or academic records?\",\"a\":\"Visit the department\'s administrative office with a formal request letter. Processing typically takes 2-4 weeks.\"}]','page_contact','2026-03-07 14:56:12','2026-03-07 14:56:12');
/*!40000 ALTER TABLE `department_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `flyer_image` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `events_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Guest Lecture: Ethics in Artificial Intelligence','guest-lecture-ai-ethics','Prof. Adeola Bankole of the University of Lagos will deliver a special lecture on the ethical implications of AI deployment in developing nations, with case studies from healthcare and agriculture.','2026-03-04 15:37:00',NULL,'CSC Lecture Theatre, Block A','event_flyers/m1YnhKEQeHpOrr55GUAMhjmE6g1UtMMfX8u2prw7.jpg',1,'2026-02-22 14:37:25','2026-02-22 16:37:12'),(3,'Siwes Presentation set for 23rd','siwes-presentation-set-for-23rd-1771781739','The official opening ceremony of the annual NACOS Week featuring keynote speeches, cultural performances, and an award ceremony for outstanding students.','2026-02-23 08:00:00','2026-02-26 08:00:00','Varios venus will be announced','event_flyers/40U0Gs8tku6lZ611OqO0mbn381PYuh0ck5XMsfQ5.jpg',0,'2026-02-22 14:37:25','2026-02-22 16:35:39');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `external_systems`
--

DROP TABLE IF EXISTS `external_systems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `external_systems` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'fa-solid fa-arrow-up-right-from-square',
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `open_in_new_tab` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `external_systems`
--

LOCK TABLES `external_systems` WRITE;
/*!40000 ALTER TABLE `external_systems` DISABLE KEYS */;
INSERT INTO `external_systems` VALUES (1,'Departmental Due Payment','#','fa-solid fa-credit-card','Online portal for departmental due payments',1,1,1,'2026-02-21 19:33:10','2026-02-21 19:33:10'),(2,'Project Management System','#','fa-solid fa-diagram-project','Student project submission and management system',1,1,3,'2026-02-21 19:33:10','2026-02-22 15:11:22'),(3,'Facail Recognition System','#','fa-solid fa-chart-line','Take attendace for both the student and the lecturers.',1,1,2,'2026-02-22 14:37:25','2026-02-22 15:12:42'),(6,'NSUK Learning Management','#','fa-solid fa-laptop-code','Online classes, assignments, and course materials',1,1,4,'2026-02-22 14:37:25','2026-02-22 15:11:55');
/*!40000 ALTER TABLE `external_systems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_albums`
--

DROP TABLE IF EXISTS `gallery_albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallery_albums` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gallery_albums_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_albums`
--

LOCK TABLES `gallery_albums` WRITE;
/*!40000 ALTER TABLE `gallery_albums` DISABLE KEYS */;
INSERT INTO `gallery_albums` VALUES (1,'NUC Accreditation Visit 2025','nuc-accreditation-visit-2025','Photo highlights from the National Universities Commission accreditation team visit to the Department of Computer Science.','2025-11-15',NULL,'2026-02-22 14:37:25','2026-02-22 14:37:25'),(2,'NACOS Week 2025','nacos-week-2025','Scenes from the annual NACOS Week featuring tech exhibitions, competitions, and cultural events.','2025-10-20',NULL,'2026-02-22 14:37:25','2026-02-22 14:37:25'),(3,'Graduation Ceremony 2025','graduation-ceremony-2025','Memorable moments from the 2024/2025 convocation ceremony at Nasarawa State University, Keffi.','2025-07-08',NULL,'2026-02-22 14:37:25','2026-02-22 14:37:25');
/*!40000 ALTER TABLE `gallery_albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_images`
--

DROP TABLE IF EXISTS `gallery_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallery_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `album_id` bigint(20) unsigned NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_images_album_id_foreign` (`album_id`),
  CONSTRAINT `gallery_images_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `gallery_albums` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_images`
--

LOCK TABLES `gallery_images` WRITE;
/*!40000 ALTER TABLE `gallery_images` DISABLE KEYS */;
INSERT INTO `gallery_images` VALUES (11,1,'gallery_images/JfZfi7MLqGn1ma3ECnTa1V98y0PB1rqCeUUVrN29.jpg',NULL,0,'2026-02-22 16:22:38','2026-02-22 16:22:38'),(12,1,'gallery_images/2LqvnvGxGwV4xU6h6UY6hK9xfh7bNCmgVD3acQLn.jpg',NULL,0,'2026-02-22 16:22:38','2026-02-22 16:22:38'),(13,1,'gallery_images/pmkkaCg0QFXeJnc6JlgB5TtA4eB1ZrhOJ5W8c7uU.jpg',NULL,0,'2026-02-22 16:22:38','2026-02-22 16:22:38'),(14,2,'gallery_images/Gk5UFdXPbVeiH7Q7IwEVBw1eUpyxMUzUHpwy4u8a.jpg',NULL,0,'2026-02-22 16:24:37','2026-02-22 16:24:37'),(15,2,'gallery_images/49iQrVNg6s2bwmZG1qjUp2MIuf6j6dDU86TdSHR2.jpg',NULL,0,'2026-02-22 16:24:37','2026-02-22 16:24:37'),(16,2,'gallery_images/CQ3qPja021ouI2uvr3ptCz5A20hhcdNuEYJs0SiC.jpg',NULL,0,'2026-02-22 16:24:37','2026-02-22 16:24:37'),(17,3,'gallery_images/Q7zNWAvqWSwhc4cQtXcD8xcv0cUaFYUrDpiInLgv.jpg',NULL,0,'2026-02-22 16:25:58','2026-02-22 16:25:58'),(18,3,'gallery_images/ZoBYqflam5wPqFN3RHvb8NEXkfDt1p68CTiAkRew.jpg',NULL,0,'2026-02-22 16:25:58','2026-02-22 16:25:58'),(19,3,'gallery_images/Su45WPcRjX2D4ocj2FuNcMDYooyRPz9HiY9Rwl6Y.jpg',NULL,0,'2026-02-22 16:25:58','2026-02-22 16:25:58');
/*!40000 ALTER TABLE `gallery_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2026_02_21_164107_create_staff_table',1),(6,'2026_02_21_164109_create_publications_table',1),(7,'2026_02_21_164109_create_qualifications_table',1),(8,'2026_02_21_164110_create_programmes_table',1),(9,'2026_02_21_164111_create_courses_table',1),(10,'2026_02_21_164112_create_course_staff_table',1),(11,'2026_02_21_164113_create_news_table',1),(12,'2026_02_21_164114_create_announcements_table',1),(13,'2026_02_21_164114_create_events_table',1),(14,'2026_02_21_164115_create_alumnis_table',1),(15,'2026_02_21_164116_create_gallery_albums_table',1),(16,'2026_02_21_164117_create_gallery_images_table',1),(17,'2026_02_21_164118_create_department_settings_table',1),(18,'2026_02_22_000001_create_programme_categories_table',2),(19,'2026_02_22_000002_add_programme_category_id_to_programmes_table',2),(20,'2026_02_22_000003_create_pages_table',3),(21,'2026_02_22_000004_create_external_systems_table',4),(22,'2026_02_22_000005_create_social_links_table',5),(23,'2026_02_22_000006_create_carousel_slides_table',6),(24,'2026_02_22_000001_create_reactions_table',7),(25,'2026_02_22_142444_create_nacos_presidents_table',8),(26,'2026_02_22_142446_create_past_hods_table',8),(27,'2026_02_22_142448_add_qualifications_to_staff_table',8),(28,'2026_02_22_142448_drop_alumnis_table',8),(29,'2026_02_22_163825_add_role_to_staff_table',9),(30,'2026_02_22_171322_create_staff_roles_table',10),(31,'2026_02_22_174411_create_partners_table',11),(32,'2026_02_22_204105_add_role_to_users_table',12),(33,'2026_02_22_213600_add_is_admin_to_users_table',12),(34,'2026_02_24_145732_make_staff_email_nullable',13),(35,'2026_02_25_100000_add_address_to_staff_table',14),(36,'2026_02_25_100001_replace_is_active_with_status_on_staff',15),(37,'2026_03_07_000001_create_comments_table',16);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nacos_presidents`
--

DROP TABLE IF EXISTS `nacos_presidents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nacos_presidents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `tenure_start` varchar(255) DEFAULT NULL,
  `tenure_end` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `current_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nacos_presidents`
--

LOCK TABLES `nacos_presidents` WRITE;
/*!40000 ALTER TABLE `nacos_presidents` DISABLE KEYS */;
INSERT INTO `nacos_presidents` VALUES (1,'Kefas Kenedy Bulus','nacos-presidents/FSdImXE7aIwzEr4dN6PLQUtJ1d1hw34JQzKmGjWf.jpg','2025','Present','Best in the history of all the presidents','Graduated','2026-02-22 16:10:30','2026-02-22 16:10:30'),(2,'Mark Ishaya','nacos-presidents/ZyBuvtyI4kYMukHJ3JW1ZUxpZr2J1vtz1pLeLXkH.png','2024','2025','eqwagserhjfbb hdhdfg trvg  ve','Graduated','2026-02-22 16:17:42','2026-02-22 16:17:42');
/*!40000 ALTER TABLE `nacos_presidents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'Department News',
  `featured_image` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `news_slug_unique` (`slug`),
  KEY `news_user_id_foreign` (`user_id`),
  CONSTRAINT `news_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,NULL,'This is a test...............','this-is-a-test-1771765967','You are welcome to the Department of Computer Science, which was established as a Unit in the Department of Mathematical Sciences, Faculty of Natural and Applied Sciences in the 2003/2004 academic session and was upgraded to the status of a Department in the 2017/18 Session. With effect from the 2021//2022 academic session, two new programmes (Data Science & Technology and Cybersecurity & Forensic) shall be included with the Computer Science. The goal of the department is to be a leading edge in the area of competition, innovation, and society responsive computing solutions aligning strategically with the university’s mission. We are committed to promoting technological advancement by providing a conducive environment for teaching, learning, and research.','General','news_images/OYkswzq5GoXCNWfQwHvF1pnyoYw9Ut1Cfp6tjCgo.jpg',1,'2026-02-22 13:12:00','2026-02-22 12:12:47','2026-02-22 12:12:47'),(3,21,'NSUK CS Students Win National Hackathon','students-win-hackathon-2026','<p>A team of five Computer Science students from Nasarawa State University Keffi emerged winners of the 2026 National University Hackathon held in Abuja. The team, mentored by Dr. Chukwudi Eze, developed an AI-powered crop disease detection app for smallholder farmers.</p><p>The winning solution uses computer vision and a lightweight neural network that runs offline on low-end Android devices, making it accessible to rural farmers without internet connectivity.</p><p>The team will represent Nigeria at the pan-African finals in Nairobi next month.</p>','Student Spotlight','news_images/CB8fIvILhjzRUvWwuefcCMarhv5vT7yykRWWx8qz.jpg',1,'2026-02-17 14:37:00','2026-02-22 14:37:25','2026-02-22 16:38:23'),(5,21,'Postgraduate Admissions Now Open for 2026/2027 Session','postgraduate-admissions-open','<p>Applications are now being accepted for M.Sc. and Ph.D. programmes in Computer Science for the 2026/2027 academic session. Prospective candidates must possess a minimum of Second Class Upper (2.1) for M.Sc. and a strong M.Sc. result for Ph.D. admission.</p><p>Research areas available include Artificial Intelligence, Cybersecurity, Data Science, Software Engineering, and Computer Networks. Full and partial scholarships are available for outstanding candidates.</p><p>Application deadline: June 30, 2026.</p>','General','news_images/lBghR9je8ABxyslWBYwrQ7m3TQPH1p6Mu2oK7gm5.jpg',1,'2026-02-10 14:37:00','2026-02-22 14:37:25','2026-02-22 16:38:56');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_system` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Privacy Policy','privacy-policy','<h2>Privacy Policy</h2>\r\n<p><strong>Effective Date:</strong> January 1, 2026</p>\r\n\r\n<p>The Department of Computer Science, Nasarawa State University Keffi (\"we\", \"us\", or \"our\") is committed to protecting the privacy of all visitors, students, staff, and stakeholders who access our website and online services.</p>\r\n\r\n<h3>1. Information We Collect</h3>\r\n<p>We may collect the following types of information when you interact with our website:</p>\r\n<ul>\r\n    <li><strong>Personal Information:</strong> Name, email address, phone number, and other details you voluntarily submit through contact forms, application portals, or alumni registration.</li>\r\n    <li><strong>Academic Information:</strong> Student ID, programme details, course enrolment, and academic records where applicable.</li>\r\n    <li><strong>Technical Data:</strong> IP address, browser type, device information, and browsing patterns collected automatically via cookies and server logs.</li>\r\n</ul>\r\n\r\n<h3>2. How We Use Your Information</h3>\r\n<ul>\r\n    <li>Processing enquiries and application submissions</li>\r\n    <li>Sending departmental announcements, event notifications, and academic updates</li>\r\n    <li>Improving website functionality and user experience</li>\r\n    <li>Maintaining accurate academic and alumni records</li>\r\n    <li>Complying with regulatory and institutional requirements</li>\r\n</ul>\r\n\r\n<h3>3. Data Protection</h3>\r\n<p>We implement industry-standard security measures including encryption, access controls, and regular audits to safeguard your personal data against unauthorised access, disclosure, or misuse.</p>\r\n\r\n<h3>4. Third-Party Sharing</h3>\r\n<p>Your personal data will not be sold or shared with third parties except when required by law, university policy, or with your explicit consent.</p>\r\n\r\n<h3>5. Cookies</h3>\r\n<p>Our website uses cookies to enhance your browsing experience. You may disable cookies in your browser settings, though some features may be affected.</p>\r\n\r\n<h3>6. Your Rights</h3>\r\n<p>You have the right to request access to, correction of, or deletion of your personal data. Contact us at <a href=\"mailto:info@dcms.nsuk.edu.ng\">info@dcms.nsuk.edu.ng</a> for any data-related enquiries.</p>\r\n\r\n<h3>7. Updates to This Policy</h3>\r\n<p>We may update this privacy policy periodically. Changes will be posted on this page with an updated effective date.</p>','fa-solid fa-shield-halved',1,1,'2026-02-21 19:24:49','2026-02-21 19:24:49'),(2,'Terms of Use','terms-of-use','<h2>Terms of Use</h2>\r\n<p><strong>Last Updated:</strong> January 1, 2026</p>\r\n\r\n<p>By accessing and using the Department of Computer Science, Nasarawa State University Keffi website, you agree to be bound by the following terms and conditions.</p>\r\n\r\n<h3>1. Acceptance of Terms</h3>\r\n<p>By using this website, you acknowledge that you have read, understood, and agree to these Terms of Use. If you do not agree, please discontinue use immediately.</p>\r\n\r\n<h3>2. Intellectual Property</h3>\r\n<p>All content on this website, including text, images, graphics, logos, and software, is the property of the Department of Computer Science, NSUK, and is protected under Nigerian copyright and intellectual property laws. Unauthorised reproduction or distribution is prohibited.</p>\r\n\r\n<h3>3. Acceptable Use</h3>\r\n<p>You agree not to:</p>\r\n<ul>\r\n    <li>Use the website for any unlawful, fraudulent, or harmful purpose</li>\r\n    <li>Attempt to gain unauthorised access to any part of the website or its systems</li>\r\n    <li>Upload or transmit viruses, malware, or any harmful code</li>\r\n    <li>Reproduce, modify, or distribute website content without prior written permission</li>\r\n    <li>Impersonate any person or misrepresent your affiliation with any entity</li>\r\n</ul>\r\n\r\n<h3>4. Academic Information</h3>\r\n<p>While we strive to ensure accuracy, academic information (programmes, courses, requirements, deadlines) published on this website is subject to change. Official confirmation should always be sought from the department or university registry.</p>\r\n\r\n<h3>5. External Links</h3>\r\n<p>This website may contain links to external websites. We are not responsible for the content, privacy practices, or availability of external sites.</p>\r\n\r\n<h3>6. Limitation of Liability</h3>\r\n<p>The Department of Computer Science, NSUK, shall not be liable for any direct, indirect, incidental, or consequential damages arising from your use of this website.</p>\r\n\r\n<h3>7. Governing Law</h3>\r\n<p>These terms are governed by the laws of the Federal Republic of Nigeria. Any disputes shall be subject to the jurisdiction of Nigerian courts.</p>\r\n\r\n<h3>8. Changes to Terms</h3>\r\n<p>We reserve the right to modify these terms at any time. Continued use of the website after changes constitutes acceptance of the revised terms.</p>','fa-solid fa-file-contract',1,1,'2026-02-21 19:24:49','2026-02-21 19:24:49'),(3,'Sitemap','sitemap','<h2>Sitemap</h2>\r\n<p>Navigate through all the sections of our website using the links below.</p>\r\n\r\n<h3><i class=\"fa-solid fa-house\"></i> Main Pages</h3>\r\n<ul>\r\n    <li><a href=\"/\">Home</a> — Welcome page with latest updates and department overview</li>\r\n    <li><a href=\"/about\">About Us</a> — Department history, vision, mission, and facilities</li>\r\n    <li><a href=\"/academics\">Academics</a> — Programme categories, courses, and academic structure</li>\r\n    <li><a href=\"/people\">Faculty</a> — Academic and non-academic staff directory</li>\r\n    <li><a href=\"/research-news\">Blog</a> — News, events, and research publications</li>\r\n    <li><a href=\"/contact-alumni\">Contact & Alumni</a> — Get in touch and alumni network</li>\r\n</ul>\r\n\r\n<h3><i class=\"fa-solid fa-graduation-cap\"></i> Academic Programmes</h3>\r\n<ul>\r\n    <li><a href=\"/academics#undergraduate-full-time\">Undergraduate (Full-Time)</a></li>\r\n    <li><a href=\"/academics#undergraduate-part-time\">Undergraduate (Part-Time)</a></li>\r\n    <li><a href=\"/academics#masters\">Masters</a></li>\r\n    <li><a href=\"/academics#phd\">PhD</a></li>\r\n    <li><a href=\"/academics#doctorate\">Doctorate</a></li>\r\n    <li><a href=\"/academics#course-structure\">Course Structure</a></li>\r\n</ul>\r\n\r\n<h3><i class=\"fa-solid fa-info-circle\"></i> About</h3>\r\n<ul>\r\n    <li><a href=\"/about#our-story\">Our Story</a></li>\r\n    <li><a href=\"/about#vision-mission\">Vision & Mission</a></li>\r\n    <li><a href=\"/about#core-values\">Core Values</a></li>\r\n    <li><a href=\"/about#facilities\">Facilities & Labs</a></li>\r\n    <li><a href=\"/about#our-faculty\">Our Faculty</a></li>\r\n</ul>\r\n\r\n<h3><i class=\"fa-solid fa-file-alt\"></i> Legal</h3>\r\n<ul>\r\n    <li><a href=\"/page/privacy-policy\">Privacy Policy</a></li>\r\n    <li><a href=\"/page/terms-of-use\">Terms of Use</a></li>\r\n    <li><a href=\"/page/sitemap\">Sitemap</a> (this page)</li>\r\n</ul>','fa-solid fa-sitemap',1,1,'2026-02-21 19:24:49','2026-02-21 19:24:49'),(4,'Student Handbook','student-handbook','<h2>Student Handbook</h2><p>This handbook contains essential information for all Computer Science students at NSUK, including academic policies, examination guidelines, course registration procedures, and departmental rules and regulations.</p><h3>Academic Calendar</h3><p>The academic session runs from October to July each year, split into two semesters of roughly 18 weeks each, including examinations.</p><h3>Examination Guidelines</h3><p>Students must maintain a minimum of 75% attendance to qualify for semester examinations. Examination malpractice will result in immediate expulsion.</p>','fa-solid fa-book',1,0,'2026-02-22 14:37:25','2026-02-22 14:37:25'),(5,'Research & Innovation','research-innovation','<h2>Research & Innovation</h2><p>The Department of Computer Science is actively involved in cutting-edge research across multiple domains including Artificial Intelligence, Cybersecurity, Data Science, and Human-Computer Interaction.</p><h3>Research Groups</h3><ul><li><strong>AI & Machine Learning Lab</strong> — Led by Prof. Adewale Okafor</li><li><strong>Cybersecurity Research Group</strong> — Led by Dr. Amina Yusuf</li><li><strong>Data Science & Analytics Unit</strong> — Led by Dr. Chukwudi Eze</li></ul><p>Students and staff interested in joining any research group should contact the group lead directly.</p>','fa-solid fa-flask',1,0,'2026-02-22 14:37:25','2026-02-22 14:37:25'),(6,'Alumni Network','alumni-network','<h2>Alumni Network</h2><p>Our alumni are thriving across the globe in technology companies, research institutions, government agencies, and entrepreneurial ventures. We maintain an active alumni network to foster mentorship, collaboration, and giving back.</p><h3>Notable Alumni</h3><p>Graduates of the department have gone on to work at Google, Microsoft, Andela, Interswitch, and various government parastatals. Several alumni have founded successful tech startups in Nigeria and abroad.</p><h3>Stay Connected</h3><p>Alumni are encouraged to register on our portal and attend annual homecoming events.</p>','fa-solid fa-user-graduate',1,0,'2026-02-22 14:37:25','2026-02-22 14:37:25');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners`
--

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
INSERT INTO `partners` VALUES (1,'Huawei','partners/PoduWdSgGFQ8jmxUgLd2KNhj05LcrerMD9IJ4CSU.jpg','https://e.huawei.com/en/talent/ict-academy/',1,1,'2026-02-22 17:02:42','2026-02-22 17:13:39'),(2,'Microsoft Nigeria','partners/oiDr4D68MdnpPFic23RmkBcTyWLCXDNuPvwoBRFJ.jpg','https://learn.microsoft.com/en-us/training/',2,1,'2026-02-22 17:07:14','2026-02-22 17:14:35'),(3,'cisco','partners/hkMOuVwIBDsq5IOPRdvwJgwuhCeu38a9M1d8btum.jpg','https://www.cisco.com/site/us/en/learn/training-certifications/training/netacad/index.html',3,1,'2026-02-22 17:08:31','2026-02-22 17:15:23'),(4,'Google','partners/NncLRuQzoYT4WAn74F7bLfBpveoOY9E1xW2UNkDC.jpg','https://grow.google/intl/ssa-en/',4,1,'2026-02-22 17:09:11','2026-02-22 17:16:08');
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `past_hods`
--

DROP TABLE IF EXISTS `past_hods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `past_hods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `tenure_start` varchar(255) DEFAULT NULL,
  `tenure_end` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `past_hods`
--

LOCK TABLES `past_hods` WRITE;
/*!40000 ALTER TABLE `past_hods` DISABLE KEYS */;
INSERT INTO `past_hods` VALUES (1,'Dr. B. A. Ajayi','past-hods/L23ssWxclQRiL2NEyt3y5UDeVu0RjVGqiKAAjoy6.jpg','2023','Present',NULL,'2026-02-22 16:05:03','2026-02-22 16:05:03');
/*!40000 ALTER TABLE `past_hods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programme_categories`
--

DROP TABLE IF EXISTS `programme_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programme_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `programme_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programme_categories`
--

LOCK TABLES `programme_categories` WRITE;
/*!40000 ALTER TABLE `programme_categories` DISABLE KEYS */;
INSERT INTO `programme_categories` VALUES (1,'Undergraduate (Full-Time)','undergraduate-full-time','Full-time undergraduate degree programmes designed for students pursuing a comprehensive on-campus learning experience.','fa-solid fa-graduation-cap',1,1,'2026-02-21 19:00:59','2026-02-21 19:00:59'),(2,'Undergraduate (Part-Time)','undergraduate-part-time','Part-time undergraduate programmes for working professionals and students who prefer a flexible study schedule.','fa-solid fa-clock',2,1,'2026-02-21 19:00:59','2026-02-21 19:00:59'),(3,'Masters','masters','Postgraduate masters programmes offering advanced specialization and research opportunities in computer science.','fa-solid fa-award',3,1,'2026-02-21 19:00:59','2026-02-21 19:00:59'),(4,'PhD','phd','Doctor of Philosophy programmes focused on original research contributions and academic excellence.','fa-solid fa-flask',4,1,'2026-02-21 19:00:59','2026-02-21 19:00:59'),(5,'Doctorate','doctorate','Professional doctorate programmes combining advanced academic study with practical application in industry and leadership.','fa-solid fa-user-graduate',5,1,'2026-02-21 19:00:59','2026-02-21 19:00:59');
/*!40000 ALTER TABLE `programme_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programmes`
--

DROP TABLE IF EXISTS `programmes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programmes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `programme_category_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `mode_of_study` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `objectives` text DEFAULT NULL,
  `requirements_utme` text DEFAULT NULL,
  `requirements_de` text DEFAULT NULL,
  `career_pathways` text DEFAULT NULL,
  `handbook_pdf` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `programmes_slug_unique` (`slug`),
  KEY `programmes_programme_category_id_foreign` (`programme_category_id`),
  CONSTRAINT `programmes_programme_category_id_foreign` FOREIGN KEY (`programme_category_id`) REFERENCES `programme_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programmes`
--

LOCK TABLES `programmes` WRITE;
/*!40000 ALTER TABLE `programmes` DISABLE KEYS */;
INSERT INTO `programmes` VALUES (1,1,'BSc Computer Science','bsc-computer-science','BSc','4 Years','Full TIme','this is the dessssssss','the abbbbbbbbbb','5 Cedicts in English Language, Mathematics, Physics, Chemistry or Biology.','Must have an A in English Language','ther are many careers in this fieldsssssss',NULL,1,0,'2026-02-22 15:28:54','2026-02-22 15:28:54'),(2,3,'MSc. Cyber Security','msc-cyber-security','MSc','1 year','Maters','masters in cyber security','r treg  greg e ger',NULL,'BSc holder','ufhrufh ufhuhfie',NULL,1,0,'2026-02-22 16:48:02','2026-03-07 13:58:29');
/*!40000 ALTER TABLE `programmes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publications`
--

DROP TABLE IF EXISTS `publications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` bigint(20) unsigned NOT NULL,
  `title` text NOT NULL,
  `journal` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `doi` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `abstract` text DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `publications_staff_id_foreign` (`staff_id`),
  CONSTRAINT `publications_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publications`
--

LOCK TABLES `publications` WRITE;
/*!40000 ALTER TABLE `publications` DISABLE KEYS */;
/*!40000 ALTER TABLE `publications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qualifications`
--

DROP TABLE IF EXISTS `qualifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qualifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` bigint(20) unsigned NOT NULL,
  `degree` varchar(255) NOT NULL,
  `field_of_study` varchar(255) DEFAULT NULL,
  `institution` varchar(255) NOT NULL,
  `year` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `qualifications_staff_id_foreign` (`staff_id`),
  CONSTRAINT `qualifications_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qualifications`
--

LOCK TABLES `qualifications` WRITE;
/*!40000 ALTER TABLE `qualifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `qualifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reactions`
--

DROP TABLE IF EXISTS `reactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` bigint(20) unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reactions_news_id_session_id_unique` (`news_id`,`session_id`),
  KEY `reactions_news_id_type_index` (`news_id`,`type`),
  CONSTRAINT `reactions_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reactions`
--

LOCK TABLES `reactions` WRITE;
/*!40000 ALTER TABLE `reactions` DISABLE KEYS */;
INSERT INTO `reactions` VALUES (1,3,'like','Ab1rjlgRl6PnbCwgc3GgJOKD2XD44racaZjpppZp','127.0.0.1','2026-03-07 15:15:30','2026-03-07 15:30:36');
/*!40000 ALTER TABLE `reactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_links`
--

DROP TABLE IF EXISTS `social_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_links` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_links`
--

LOCK TABLES `social_links` WRITE;
/*!40000 ALTER TABLE `social_links` DISABLE KEYS */;
INSERT INTO `social_links` VALUES (1,'Gmail','mailto:info@dcms.nsuk.edu.ng','fa-solid fa-envelope',1,1,'2026-02-21 22:20:24','2026-02-21 22:20:24'),(2,'WhatsApp','https://wa.me/234123456789','fa-brands fa-whatsapp',1,2,'2026-02-21 22:20:24','2026-02-21 22:20:24'),(3,'Facebook','#','fa-brands fa-facebook-f',1,3,'2026-02-21 22:20:24','2026-02-21 22:20:24'),(4,'X (Twitter)','#','fa-brands fa-x-twitter',1,4,'2026-02-21 22:20:24','2026-02-21 22:20:24');
/*!40000 ALTER TABLE `social_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `qualifications` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `rank` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `specialisation` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Tenure',
  `office_location` varchar(255) DEFAULT NULL,
  `google_scholar_url` varchar(255) DEFAULT NULL,
  `researchgate_url` varchar(255) DEFAULT NULL,
  `is_hod` tinyint(1) NOT NULL DEFAULT 0,
  `accepting_pg` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `staff_slug_unique` (`slug`),
  UNIQUE KEY `staff_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1190 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1180,'Binyamin Adeniyi Ajayi','Ph. D Information Technology (IIUM), Masters in Information Technology (IIUM), M.Sc. Computer Science (UNILAG), PGD Computer Science (UNILAG), B. Sc. Mathematics (LASU)','Dr.','Senior Lecturer','Head of Department','binyamin-adeniyi-ajayi','badeniyiajayi@nsuk.edu.ng','08083701713','Main Block Department Building','staff_photos/UvEM70yIYbUoGoe5htgoqlh6uGUaMA77MCSK6vV8.jpg','Dr. B. A. Ajayi is a Senior Lecturer with research interests in Information System Mixed Method Research; Optimization. He has published extensively in top-tier journals and supervised numerous postgraduate students.','Information System Mixed Method Research; Optimization','Tenure','Room 201, Computer Science Building',NULL,NULL,1,1,1,'2026-03-01 11:48:00','2026-03-04 17:03:10'),(1181,'Davou Nyap Choji','Ph. D. Computer Science (ATBU, Bauchi), M. Sc. Computer Science (ATBU, Bauchi), PG Diploma in Computer Science (ABU, Zaria), PG Diploma in Education (ABU, Zaria), M. Sc. Statistics (ABU, Zaria), B. Sc. Statistics (ABU, Zaria)','Prof.','Professor',NULL,'davou-nyap-choji','chojid@gmail.com','0803 595 7341','Main Block Department Building','staff_photos/JDhNOr0x3fF8JGCEHWOVCOaSMLcLKCJc1CQUCt0m.jpg','Davou Nyap Choji specializes in Software Simulation, Modelling and Algorithm. He is passionate about improving software development practices in African institutions.','Simulation, Modelling and Algorithm','Visiting','Room 5, Main Block Department Building',NULL,NULL,0,1,2,'2026-03-01 11:48:00','2026-03-04 17:17:02'),(1182,'Afolayan Ayodele Obiniyi','Ph. D. Computer Science (FUT, Yola), M. Tech Computer Science (FUTA), PGD Computer Science (FUTA), B. Sc. Mathematics (ABU, Zaria)','Prof.','Professor',NULL,'afolayan-ayodele-obiniyi','aaobiniyi@gmail.com','0803 451 8843','Main Block Department Building','staff_photos/rKR0f76LCwzD3yXtKWjmhDyzMVxuYpF8v1uj7B8F.jpg','Professor Afolayan Ayodele Obiniyiu is a distinguished academic with over 20 years of experience in Network Security. He has served on several national and international committees.','Network Security','Visiting','Room 10, Main Department Building',NULL,NULL,0,1,3,'2026-03-01 11:48:00','2026-03-04 18:02:01'),(1183,'Halima Abdullahi','B.Sc., M.Sc., Ph.D. Information Technology','Dr.','Lecturer I','Lecturer','halima-abdullahi','h.abdullahi@university.edu.ng','08034567890',NULL,NULL,'Dr. Halima Abdullahi is a Lecturer with interests in Data Science and Cloud Computing. She is actively involved in mentoring female students in STEM fields.','Data Science & Cloud Computing','Tenure','Room 210, Computer Science Building',NULL,NULL,0,1,4,'2026-03-01 11:48:01','2026-03-01 11:48:01'),(1184,'Oluwaseun Bakare','B.Sc., M.Sc. Computer Science','Mr.','Lecturer II','Lecturer','oluwaseun-bakare','o.bakare@university.edu.ng','08035678901',NULL,NULL,'Mr. Oluwaseun Bakare is a Lecturer II and a Ph.D. candidate researching Internet of Things and Embedded Systems. He coordinates the department\'s hardware laboratory.','Internet of Things & Embedded Systems','Tenure','Room 108, Computer Science Building',NULL,NULL,0,0,5,'2026-03-01 11:48:01','2026-03-01 11:48:01'),(1185,'Ngozi Eze','B.Sc., M.Sc., Ph.D. Computer Science','Dr.','Senior Lecturer','Lecturer','ngozi-eze','n.eze@university.edu.ng','08036789012',NULL,NULL,'Dr. Ngozi Eze is a Senior Lecturer whose research focuses on Database Systems and Information Retrieval. She has contributed to several open-source projects and published widely in reputable journals.','Database Systems & Information Retrieval','Tenure','Room 203, Computer Science Building',NULL,NULL,0,1,6,'2026-03-01 11:48:01','2026-03-01 11:48:01'),(1186,'Taiwo Afolabi','B.Sc., M.Sc., Ph.D. Computer Science','Dr.','Lecturer I','Lecturer','taiwo-afolabi','t.afolabi@university.edu.ng','08037890123',NULL,NULL,'Dr. Taiwo Afolabi is a Lecturer I specializing in Computer Vision and Image Processing. His current research explores the application of deep learning in medical imaging.','Computer Vision & Image Processing','Tenure','Room 212, Computer Science Building',NULL,NULL,0,1,7,'2026-03-01 11:48:01','2026-03-01 11:48:01'),(1187,'Ibrahim Musa','B.Sc., M.Sc. Computer Science','Mr.','Assistant Lecturer','Lecturer','ibrahim-musa','i.musa@university.edu.ng','08038901234',NULL,NULL,'Mr. Ibrahim Musa is an Assistant Lecturer with a focus on Web Technologies and Mobile Application Development. He is currently pursuing his doctoral degree.','Web Technologies & Mobile Development','Tenure','Room 115, Computer Science Building',NULL,NULL,0,0,8,'2026-03-01 11:48:01','2026-03-01 11:48:01'),(1188,'Blessing Okafor','B.Sc., M.Sc., Ph.D. Computer Science','Dr.','Reader','Lecturer','blessing-okafor','b.okafor@university.edu.ng','08039012345',NULL,NULL,'Dr. Blessing Okafor is a Reader with expertise in Natural Language Processing and Computational Linguistics. She leads the department\'s NLP research group and has secured multiple research grants.','Natural Language Processing','Tenure','Room 202, Computer Science Building',NULL,NULL,0,1,9,'2026-03-01 11:48:02','2026-03-01 11:48:02'),(1189,'Samuel Okonkwo','B.Sc., M.Sc., Ph.D. Computer Science','Prof.','Professor','Lecturer','samuel-okonkwo','s.okonkwo@university.edu.ng','08030123456',NULL,NULL,'Professor Samuel Okonkwo is a Professor of Computer Science with a distinguished career spanning over 25 years. His research covers Algorithms, Computational Complexity, and Bioinformatics.','Algorithms & Bioinformatics','Tenure','Room 102, Computer Science Building',NULL,NULL,0,1,10,'2026-03-01 11:48:02','2026-03-01 11:48:02');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_roles`
--

DROP TABLE IF EXISTS `staff_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `staff_roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_roles`
--

LOCK TABLES `staff_roles` WRITE;
/*!40000 ALTER TABLE `staff_roles` DISABLE KEYS */;
INSERT INTO `staff_roles` VALUES (1,'Head of Department',0,'2026-02-22 16:18:20','2026-02-22 16:18:20'),(2,'Exam Officer',1,'2026-02-22 16:18:20','2026-02-22 16:18:20'),(3,'SIWES Director',2,'2026-02-22 16:18:20','2026-02-22 16:18:20'),(4,'Project Coordinator',3,'2026-02-22 16:18:20','2026-02-22 16:18:20'),(5,'Level Coordinator 100L',4,'2026-02-22 16:18:20','2026-02-22 16:18:20'),(6,'Level Coordinator 200L',5,'2026-02-22 16:18:20','2026-02-22 16:18:20'),(7,'Level Coordinator 300L',6,'2026-02-22 16:18:20','2026-02-22 16:18:20'),(8,'Level Coordinator 400L',7,'2026-02-22 16:18:20','2026-02-22 16:18:20'),(9,'Lab Coordinator',8,'2026-02-22 16:18:20','2026-02-22 16:18:20'),(14,'Departmental PG Coordinator',13,'2026-02-22 16:18:20','2026-02-22 16:18:20'),(15,'Timetable Officer',14,'2026-02-22 16:18:20','2026-02-22 16:18:20'),(16,'Student Welfare Officer',15,'2026-02-22 16:18:20','2026-02-22 16:18:20'),(17,'Research Coordinator',16,'2026-02-22 16:18:20','2026-02-22 16:18:20'),(18,'ICT Coordinator',17,'2026-02-22 16:18:20','2026-02-22 16:18:20'),(19,'Accreditation Officer',18,'2026-02-22 16:18:20','2026-02-22 16:18:20');
/*!40000 ALTER TABLE `staff_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `role` varchar(20) NOT NULL DEFAULT 'admin',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (21,'System Administrator','admin@nsuk.edu.ng',1,'super_admin',NULL,'$2y$12$xJooE4gS2zfksqGqyHImbeYZY8dnQNXih2BZyQWe2trw6S5sQTVMa','R0qpVeu9YYE1luIZPOF6gW8dS5TCfvVzXGkwxEFLO4d9FFuntCKWhPIOPDAx','2026-02-21 19:06:12','2026-02-22 19:49:48'),(22,'Admin','admin@example.com',1,'admin',NULL,'$2y$12$bMKNxLxSxDJxJ1T9sKPmdeXh1s.f0WPgsGsdSl44SKqzvYXsp9SR2',NULL,'2026-02-22 11:44:36','2026-02-23 14:26:37'),(23,'Super Admin','admin@dcms.nsuk.edu.ng',1,'super_admin','2026-02-23 14:25:01','$2y$12$gjgp.PVvCCG5uB5Y/s4wHOkN6apDw7igS.kYGp61bKQ1WFSVuziqe','UGqMyb597QnEmGiSzqjdZJRGoCznNb0fGVuNjPgB6M8woZF3MQXw6yCVZf8c','2026-02-22 19:50:06','2026-02-23 14:25:01'),(24,'Admin User','staff@dcms.nsuk.edu.ng',1,'admin','2026-02-23 14:25:01','$2y$12$a2U1i61NNH/bw75fiaZMlOyT1z0LMPDodrW1UL3mPctQM2mz6B0eu','CRVlqPoBhWhRectpHWJo9LuvOI93fRL8xNtdE1R6DB2SPLUL3a341duaP4dN','2026-02-23 14:25:01','2026-02-23 14:25:01');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-18 12:47:20
