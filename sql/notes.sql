-- -------------------------------------------------------------
-- TablePlus 5.3.4(492)
--
-- https://tableplus.com/
--
-- Database: simplenote
-- Generation Time: 2023-05-27 23:12:28.6490
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `notes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `notes` (`id`, `title`, `body`, `date`, `user_id`) VALUES
(157, 'BUGS', '- Form size doesnt back to initial height after submit note\n- Form size in edit note doesnt follow the text length, initial state doesnt let user scroll while content is overflow\n- Note card text doesnt follow text formatting', '2023-05-14 19:37:53', 1),
(158, 'UPCOMING FEATURES', '- Note card is clickable to view and edit content\n- Drag and drop to change notes\' order\n- Add tag to filter notes', '2023-05-14 19:39:05', 1),
(160, 'CODE', '- Refactor notes.js', '2023-05-14 22:45:45', 1),
(161, 'SQL', 'SWAP id primary key:\r\nBEGIN TRANSACTION;\r\n\r\nSELECT id INTO @id1 FROM notes WHERE id = \'n\';\r\nSELECT id INTO @id2 FROM notes WHERE id = \'m\';\r\n\r\nUPDATE notes SET id \'temp\' WHERE id = \'n\';\r\nUPDATE notes SET id = @id1 WHERE id = \'m\';\r\nUPDATE notes SET id = @id2 WHERE id = \'temp\';\r\n\r\nCOMMIT', '2023-05-14 22:48:44', 1),
(162, '000webhost 404', 'If 404 error occurs:\r\n1. Create .htsaccess file in public_html directory\r\n2. Paste this code into the file\r\n<IfModule mod_rewrite.c>\r\n    <IfModule mod_negotiation.c>\r\n        Options -MultiViews -Indexes\r\n    </IfModule>\r\n\r\n    RewriteEngine On\r\n\r\n    # Handle Authorization Header\r\n    RewriteCond %{HTTP:Authorization} .\r\n    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]\r\n\r\n    # Redirect Trailing Slashes If Not A Folder...\r\n    RewriteCond %{REQUEST_FILENAME} !-d\r\n    RewriteCond %{REQUEST_URI} (.+)/$\r\n    RewriteRule ^ %1 [L,R=301]\r\n\r\n    # Send Requests To Front Controller...\r\n    RewriteCond %{REQUEST_FILENAME} !-d\r\n    RewriteCond %{REQUEST_FILENAME} !-f\r\n    RewriteRule ^ index.php [L]\r\n</IfModule>\r\n\r\nor access the repository on Github\r\nhttps://github.com/laravel/laravel/blob/master/public/.htaccess', '2023-05-15 01:06:21', 1),
(169, 'asdaasdasda', 'asdaasdaasd', '2023-05-15 20:12:26', 1);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;