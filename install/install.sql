SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `tff_albums`;
CREATE TABLE IF NOT EXISTS `tff_albums` (
  `alb_id` int(11) NOT NULL AUTO_INCREMENT,
  `alb_title` varchar(255) NOT NULL DEFAULT '',
  `artwork` varchar(255) NOT NULL DEFAULT '',
  `copyrighted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`alb_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `tff_blog_categories`;
CREATE TABLE IF NOT EXISTS `tff_blog_categories` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `handle` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`cat_id`),
  FULLTEXT KEY `handle` (`handle`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `tff_blog_posts`;
CREATE TABLE IF NOT EXISTS `tff_blog_posts` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `comments_allowed` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `headimg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contents` text COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL DEFAULT '1',
  `rel_id` int(11) NOT NULL DEFAULT '2',
  `times` int(11) NOT NULL DEFAULT '0',
  `vws` int(10) unsigned NOT NULL DEFAULT '0',
  `vis` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`p_id`),
  KEY `vis` (`vis`),
  FULLTEXT KEY `title` (`title`,`contents`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='Blog Contents' AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `tff_blog_relations`;
CREATE TABLE IF NOT EXISTS `tff_blog_relations` (
  `rel_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rel_id`),
  KEY `blog_id` (`blog_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `tff_categories`;
CREATE TABLE IF NOT EXISTS `tff_categories` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `handle` varchar(255) NOT NULL DEFAULT '',
  `category_description` text NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `tff_cmspages`;
CREATE TABLE IF NOT EXISTS `tff_cmspages` (
  `p_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `visible` int(11) NOT NULL DEFAULT '1',
  `cat_id` int(10) NOT NULL DEFAULT '0',
  `handle` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `headimg` varchar(255) DEFAULT NULL,
  `contents` text NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `handle` (`handle`),
  FULLTEXT KEY `title` (`title`,`contents`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `tff_comments`;
CREATE TABLE IF NOT EXISTS `tff_comments` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `blogid` int(10) unsigned NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `stamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `tff_songs`;
CREATE TABLE IF NOT EXISTS `tff_songs` (
  `song_id` int(11) NOT NULL AUTO_INCREMENT,
  `song_name` varchar(255) NOT NULL DEFAULT '',
  `song_genre` varchar(255) NOT NULL DEFAULT '',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `alb_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`song_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `tff_users`;
CREATE TABLE IF NOT EXISTS `tff_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(64) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL,
  `lvl` tinyint(4) NOT NULL,
  `user_mail` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `tff_votes`;
CREATE TABLE IF NOT EXISTS `tff_votes` (
  `stmp` int(11) NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vote` int(11) unsigned NOT NULL,
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`cid`),
  KEY `vote` (`vote`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `tff_comments`;
CREATE TABLE IF NOT EXISTS `tff_comments` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `blogid` int(10) unsigned NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `stamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=108 ;



--- Standards ---
insert into tff_cmspages (visible,cat_id,handle,title,headimg,contents,keywords) values (0,0,'index','TFF3-Start','','<p>TFF3 wurde installiert. Bitte logge dich nun ein</p>','');
insert into tff_blog_categories (cat_id,handle) values (1,'qload');
insert into tff_categories (cat_id,handle,category_description) values (1,'impressum','Impressum');
insert into tff_cmspages (visible,cat_id,handle,title,contents) values(1,1,'index','Impressum','Bitte Impressum nachpflegen');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


