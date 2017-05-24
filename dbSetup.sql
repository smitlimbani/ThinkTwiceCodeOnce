/*
        -> login as root in mysql command line.
        -> Enter the query:
            > CREATE DATABASE warehouse;
            > GRANT ALL PRIVILEGES ON warehouse.* TO 'hello'@'localhost' IDENTIFIED BY 'universe';
            > exit;

        -> On the terminal run this command after substituting it with your details:
            > mysql -h <yourhostname> -u hello -p warehouse < /absolute/path/of/dbSetup.sql

        -> Your database is all set to be populated with data. ;)
*/



SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- Table structure for table: competitionDetails
CREATE TABLE IF NOT EXISTS `competitionDetails` (
    `competitionId` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `noOfQuestions` int(11) NOT NULL,
    `marksPerQuestion` int(11) NOT NULL,
    `negMarking` boolean NOT NULL DEFAULT 0,
    `timeDurationInHrs` int(11) DEFAULT 2,
    PRIMARY KEY (`competitionId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;



-- Table structure for table: credentials
CREATE TABLE IF NOT EXISTS `credentials` (
    `userId` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(100) NOT NULL UNIQUE,
    `password` varchar(100) NOT NULL,
    PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;



-- Table structure for table: scoreBoard
CREATE TABLE IF NOT EXISTS `scoreboard` (
    `userId` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(100) NOT NULL,
    `score` int(11) DEFAULT 0,
    PRIMARY KEY(`userId`),
    FOREIGN KEY(`userId`) REFERENCES credentials(`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;



-- Table structure for table: submissionList
CREATE TABLE IF NOT EXISTS `submissionList` (
    `submissionId` int(11) NOT NULL AUTO_INCREMENT,
    `userId` int(11)  NOT NULL,
    `timeOfSubmission` timestamp DEFAULT CURRENT_TIMESTAMP,
    `status` varchar(100),
    PRIMARY KEY (`submissionId`),
    FOREIGN KEY (`userId`) REFERENCES credentials(`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;



-- Table structure for table: problems
CREATE TABLE IF NOT EXISTS `problems` (
  `problemId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `content` mediumblob NOT NULL,
  `size` int(255) NOT NULL,
  PRIMARY KEY (`problemId`)

) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;