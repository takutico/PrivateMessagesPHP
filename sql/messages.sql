{\rtf1\ansi\ansicpg1252\cocoartf1265
{\fonttbl\f0\fswiss\fcharset0 Helvetica;}
{\colortbl;\red255\green255\blue255;}
\paperw11900\paperh16840\margl1440\margr1440\vieww10800\viewh8400\viewkind0
\pard\tx566\tx1133\tx1700\tx2267\tx2834\tx3401\tx3968\tx4535\tx5102\tx5669\tx6236\tx6803\pardirnatural

\f0\fs24 \cf0 -- \
-- Table structure for table `privado_mensajes`\
-- \
\
CREATE TABLE `privado_mensajes ` (\
  `idmessage` bigint(20) unsigned NOT NULL AUTO_INCREMENT,\
  `msg_from` text NOT NULL,\
  `msg_to` text NOT NULL,\
  `msg_subject` text NOT NULL,\
  `msg_body` text NOT NULL,\
  `msg_isread` tinyint(1) DEFAULT '0',\
  `msg_isactive` tinyint(1) DEFAULT '1',\
  `msg_send_date` date DEFAULT NULL,\
  `msg_reply_date` date DEFAULT NULL,\
  PRIMARY KEY (`idmessage`),\
  UNIQUE KEY `idmessage` (`idmessage`)\
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;\
\
-- \
-- Dumping data for table `privado_mensajes `\
-- \
\
INSERT INTO `privado_mensajes ` VALUES (15, \'91xxx@xxxx\'92, \'91yyy@yyy\'92, 'Yeahhh, ur the best', 'Hello ccc,\\r\\n\\r\\nGood luck in ur new adventure. I hope that they catch u at work in fffff.\\r\\n\\r\\nSee u soon', 1, 1, '2013-04-25', NULL);\
INSERT INTO `privado_mensajes ` VALUES (16, \'91xxx@xxx\'92, \'91zzz@zzz\'92, 'yo', 'yy', 1, 1, '2013-04-28', NULL);\
}