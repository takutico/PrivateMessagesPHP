{\rtf1\ansi\ansicpg1252\cocoartf1265
{\fonttbl\f0\fswiss\fcharset0 Helvetica;}
{\colortbl;\red255\green255\blue255;}
\paperw11900\paperh16840\margl1440\margr1440\vieww10800\viewh8400\viewkind0
\pard\tx566\tx1133\tx1700\tx2267\tx2834\tx3401\tx3968\tx4535\tx5102\tx5669\tx6236\tx6803\pardirnatural

\f0\fs24 \cf0 -- \
-- Table structure for table `privado_users`\
-- \
\
CREATE TABLE `privado_users ` (\
  `id` int(11) NOT NULL AUTO_INCREMENT,\
  `name` varchar(200) DEFAULT NULL,\
  `lastname` varchar(200) DEFAULT NULL,\
  `email` varchar(200) DEFAULT NULL,\
  `admin` tinyint(1) DEFAULT NULL,\
  `active` tinyint(1) DEFAULT NULL,\
  `nick` varchar(128) DEFAULT NULL,\
  `registereddate` date DEFAULT NULL,\
  `pass` varchar(50) DEFAULT NULL,\
  PRIMARY KEY (`id`),\
  UNIQUE KEY `email` (`email`)\
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;\
\
-- \
-- Dumping data for table `privado_users `\
-- \
\
INSERT INTO `privado_users ` VALUES (1, 'admin', 'admin', \'91xxx@xxx\'92, 1, 1, 'admin', '2013-04-24', '1');\
INSERT INTO `privado_users ` VALUES (9, 'takuya', \'91yyy\'92, \'91yyy@yyy\'92, 0, 1, 'taku', '2013-04-24', '1');\
INSERT INTO `privado_users ` VALUES (10, 'adrian', \'91zzz\'92, \'91zzz@zzz\'92, 0, 1, 'adrian', '2013-04-28', 'adrian');\
}