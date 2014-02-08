CREATE TABLE IF NOT EXISTS `games` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `player1` int(4) NOT NULL,
  `player2` int(4) NOT NULL,
  `hash` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`),
  KEY `player1` (`player1`,`player2`),
  KEY `player2` (`player2`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `game_stats` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `player_id` int(5) NOT NULL,
  `game_id` int(5) NOT NULL,
  `x` int(5) NOT NULL,
  `y` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `player_id` (`player_id`,`game_id`),
  KEY `game_id` (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'offline',
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `score` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `player_id` int(5) NOT NULL,
  `game_id` int(5) NOT NULL,
  `points` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `player_id` (`player_id`,`game_id`),
  KEY `game_id` (`game_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`player1`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `games_ibfk_2` FOREIGN KEY (`player2`) REFERENCES `players` (`id`);

ALTER TABLE `game_stats`
  ADD CONSTRAINT `game_stats_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `game_stats_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`);

ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `score_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`);