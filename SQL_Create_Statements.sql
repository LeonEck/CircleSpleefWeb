SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `circlespleef` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `circlespleef`;

DROP TABLE IF EXISTS `gameFields`;
CREATE TABLE IF NOT EXISTS `gameFields` (
`id` int(255) NOT NULL,
  `lobbyId` int(255) NOT NULL,
  `currentTurnUserId` int(255) NOT NULL,
  `c1r1` int(255) NOT NULL DEFAULT '5',
  `c2r1` int(255) NOT NULL DEFAULT '5',
  `c3r1` int(255) NOT NULL DEFAULT '5',
  `c4r1` int(255) NOT NULL DEFAULT '5',
  `c5r1` int(255) NOT NULL DEFAULT '5',
  `c1r2` int(255) NOT NULL DEFAULT '5',
  `c2r2` int(255) NOT NULL DEFAULT '5',
  `c3r2` int(255) NOT NULL DEFAULT '5',
  `c4r2` int(255) NOT NULL DEFAULT '5',
  `c5r2` int(255) NOT NULL DEFAULT '5',
  `c1r3` int(255) NOT NULL DEFAULT '5',
  `c2r3` int(255) NOT NULL DEFAULT '5',
  `c3r3` int(255) NOT NULL DEFAULT '5',
  `c4r3` int(255) NOT NULL DEFAULT '5',
  `c5r3` int(255) NOT NULL DEFAULT '5',
  `c1r4` int(255) NOT NULL DEFAULT '5',
  `c2r4` int(255) NOT NULL DEFAULT '5',
  `c3r4` int(255) NOT NULL DEFAULT '5',
  `c4r4` int(255) NOT NULL DEFAULT '5',
  `c5r4` int(255) NOT NULL DEFAULT '5',
  `c1r5` int(255) NOT NULL DEFAULT '5',
  `c2r5` int(255) NOT NULL DEFAULT '5',
  `c3r5` int(255) NOT NULL DEFAULT '5',
  `c4r5` int(255) NOT NULL DEFAULT '5',
  `c5r5` int(255) NOT NULL DEFAULT '5'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `lobbys`;
CREATE TABLE IF NOT EXISTS `lobbys` (
`id` int(255) unsigned NOT NULL,
  `playerCount` int(255) unsigned NOT NULL DEFAULT '1',
  `creatorId` int(255) unsigned NOT NULL,
  `isInGame` int(255) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`id` int(255) unsigned NOT NULL,
  `lobbyId` int(255) unsigned NOT NULL DEFAULT '0',
  `color` int(255) unsigned NOT NULL DEFAULT '0',
  `isReadyInLobby` int(255) unsigned NOT NULL DEFAULT '0',
  `gameFieldPosition` varchar(255) NOT NULL DEFAULT 'N',
  `infoFlag` int(255) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


ALTER TABLE `gameFields`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `lobbys`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);


ALTER TABLE `gameFields`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `lobbys`
MODIFY `id` int(255) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `users`
MODIFY `id` int(255) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;