
CREATE TABLE `fontier_identities` (
  `id` mediumint(24) NOT NULL AUTO_INCREMENT,
  `identity` varchar(45) DEFAULT '',
  `base` varchar(1) DEFAULT '',
  `second` varchar(2) DEFAULT '',
  `thirds` varchar(3) DEFAULT '',
  `downloads` int(13) DEFAULT '0',
  `views` int(13) DEFAULT '0',
  `css` tinytext,
  `glyphs` tinytext,
  `json` mediumtext,
  `diz` mediumtext,
  `name` varchar(255) DEFAULT '',
  `barcode` varchar(32) DEFAULT '',
  `referee` varchar(128) DEFAULT '',
  `polled` int(13) DEFAULT '0',
  `last` int(13) DEFAULT '0',
  `downloaded` int(13) DEFAULT '0',
  `glyphed` int(13) DEFAULT '0',
  `notified` int(13) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `fontier_indexes` (
  `id` mediumint(24) NOT NULL AUTO_INCREMENT,
  `parent_id` mediumint(24) NOT NULL DEFAULT '0',
  `base` varchar(3) DEFAULT '',
  `fonts` int(13) DEFAULT '0',
  `downloads` int(13) DEFAULT '0',
  `views` int(13) DEFAULT '0',
  `last` int(13) DEFAULT '0',
  `notified` int(13) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `fontier_identities_indexes` (
  `id` mediumint(27) NOT NULL AUTO_INCREMENT,
  `index_id` mediumint(24) NOT NULL DEFAULT '0',
  `identity_id` mediumint(24) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
