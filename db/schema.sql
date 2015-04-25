-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 25, 2015 at 12:46 PM
-- Server version: 5.6.22-log
-- PHP Version: 5.5.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `model`
--
CREATE DATABASE IF NOT EXISTS `model` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `model`;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `KEY` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `ci_sessions`
--

TRUNCATE TABLE `ci_sessions`;
-- --------------------------------------------------------

--
-- Table structure for table `compartments`
--

CREATE TABLE IF NOT EXISTS `compartments` (
  `compartment_id` int(11) NOT NULL AUTO_INCREMENT,
  `compartment` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `value` float NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`compartment_id`),
  KEY `fk_compartments_projects1_idx` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `compartments`
--

TRUNCATE TABLE `compartments`;
-- --------------------------------------------------------

--
-- Table structure for table `components`
--

CREATE TABLE IF NOT EXISTS `components` (
  `idcomponents` int(11) NOT NULL AUTO_INCREMENT,
  `component` varchar(45) DEFAULT NULL,
  `states` tinytext,
  `definition` text,
  `idmolecule` int(11) NOT NULL DEFAULT '0',
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`idcomponents`),
  KEY `fk_components_molecule1_idx` (`idmolecule`),
  KEY `fk_components_projects1_idx` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `components`
--

TRUNCATE TABLE `components`;
-- --------------------------------------------------------

--
-- Table structure for table `daily_build`
--

CREATE TABLE IF NOT EXISTS `daily_build` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notes` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `file_link` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `daily_build`
--

TRUNCATE TABLE `daily_build`;
-- --------------------------------------------------------

--
-- Table structure for table `diagrams`
--

CREATE TABLE IF NOT EXISTS `diagrams` (
  `diagram_id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`diagram_id`),
  KEY `fk_diagrams_projects1_idx` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `diagrams`
--

TRUNCATE TABLE `diagrams`;
-- --------------------------------------------------------

--
-- Table structure for table `doi`
--

CREATE TABLE IF NOT EXISTS `doi` (
  `iddoi` int(11) NOT NULL AUTO_INCREMENT,
  `doi` varchar(100) NOT NULL,
  `idmolecule` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`iddoi`),
  KEY `doi_molecule` (`idmolecule`),
  KEY `fk_doi_projects1_idx` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contains external links to UniProt.' AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `doi`
--

TRUNCATE TABLE `doi`;
-- --------------------------------------------------------

--
-- Table structure for table `ecmnote`
--

CREATE TABLE IF NOT EXISTS `ecmnote` (
  `idecm` int(11) NOT NULL AUTO_INCREMENT,
  `ecmnote` varchar(45) DEFAULT NULL,
  `comment` text,
  `project_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`idecm`),
  KEY `fk_ecmnote_projects1_idx` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `ecmnote`
--

TRUNCATE TABLE `ecmnote`;
-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `protected` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `groups`
--

TRUNCATE TABLE `groups`;
--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `protected`) VALUES
(0, 'sys_admin', 'System Administrator', 1),
(1, 'group_admin', 'Group Administrator', 0),
(2, 'users', 'Users', 0),
(3, 'guest_users', 'Guest Users', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `login_attempts`
--

TRUNCATE TABLE `login_attempts`;
-- --------------------------------------------------------

--
-- Table structure for table `molecule`
--

CREATE TABLE IF NOT EXISTS `molecule` (
  `idmolecule` int(11) NOT NULL AUTO_INCREMENT,
  `molecule` tinytext NOT NULL,
  `comment` text,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`idmolecule`),
  KEY `fk_molecule_projects1_idx` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `molecule`
--

TRUNCATE TABLE `molecule`;
-- --------------------------------------------------------

--
-- Table structure for table `parameters`
--

CREATE TABLE IF NOT EXISTS `parameters` (
  `parameter_id` int(11) NOT NULL AUTO_INCREMENT,
  `parameter` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `value` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`parameter_id`),
  KEY `fk_parameters_projects1_idx` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `parameters`
--

TRUNCATE TABLE `parameters`;
-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `projects`
--

TRUNCATE TABLE `projects`;
-- --------------------------------------------------------

--
-- Table structure for table `projects_groups`
--

CREATE TABLE IF NOT EXISTS `projects_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_projects_groups_projects1_idx` (`project_id`),
  KEY `fk_projects_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `projects_groups`
--

TRUNCATE TABLE `projects_groups`;
-- --------------------------------------------------------

--
-- Table structure for table `pubauth`
--

CREATE TABLE IF NOT EXISTS `pubauth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `LastName` varchar(45) DEFAULT NULL,
  `ForeName` varchar(45) DEFAULT NULL,
  `Initials` varchar(5) DEFAULT NULL,
  `pubmed_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`pubmed_id`),
  KEY `fk_pubauth_pubmed1_idx` (`pubmed_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `pubauth`
--

TRUNCATE TABLE `pubauth`;
-- --------------------------------------------------------

--
-- Table structure for table `pubmed`
--

CREATE TABLE IF NOT EXISTS `pubmed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(200) DEFAULT NULL,
  `PubDate` year(4) DEFAULT NULL,
  `Volume` int(6) DEFAULT NULL,
  `Issue` int(6) DEFAULT NULL,
  `idecm` int(10) DEFAULT NULL,
  `PMID` int(11) DEFAULT NULL,
  `ELocationID` varchar(45) DEFAULT NULL,
  `AbstractText` text,
  `ArticleTitle` varchar(175) DEFAULT NULL,
  `MedlinePgn` varchar(20) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_pubmed_projects1_idx` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `pubmed`
--

TRUNCATE TABLE `pubmed`;
-- --------------------------------------------------------

--
-- Table structure for table `rulemol`
--

CREATE TABLE IF NOT EXISTS `rulemol` (
  `idrulemol` int(11) NOT NULL AUTO_INCREMENT,
  `idrules` int(11) NOT NULL,
  `idmolecule` int(11) NOT NULL,
  PRIMARY KEY (`idrulemol`),
  KEY `fk_rulemol_molecule1_idx` (`idmolecule`),
  KEY `fk_rulemol_rules1_idx` (`idrules`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `rulemol`
--

TRUNCATE TABLE `rulemol`;
-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE IF NOT EXISTS `rules` (
  `idrules` int(11) NOT NULL AUTO_INCREMENT,
  `rule` text,
  `rulenote` text,
  `idecm` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idrules`),
  KEY `fk_rules_ecmnote1_idx` (`idecm`),
  KEY `fk_rules_projects1_idx` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `rules`
--

TRUNCATE TABLE `rules`;
-- --------------------------------------------------------

--
-- Table structure for table `rule_compartments`
--

CREATE TABLE IF NOT EXISTS `rule_compartments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idrules` int(11) NOT NULL,
  `compartment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rule_compartments_compartments1_idx` (`compartment_id`),
  KEY `fk_rule_compartments_rules1_idx` (`idrules`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `rule_compartments`
--

TRUNCATE TABLE `rule_compartments`;
-- --------------------------------------------------------

--
-- Table structure for table `rule_params`
--

CREATE TABLE IF NOT EXISTS `rule_params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idrules` int(11) NOT NULL,
  `parameter_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rule_params_parameters1_idx` (`parameter_id`),
  KEY `fk_rule_params_rules1_idx` (`idrules`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `rule_params`
--

TRUNCATE TABLE `rule_params`;
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(0, '', 'Initialize', '$2y$08$/iLe8KemHYWvfkM3LGZDc.4uqUJVe8Hfi9wAgkOdA81qraNWEkBNy', NULL, 'initialize@earth.milkyway', NULL, NULL, NULL, NULL, 1429979422, NULL, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `users_groups`
--

TRUNCATE TABLE `users_groups`;
--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 0, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `compartments`
--
ALTER TABLE `compartments`
  ADD CONSTRAINT `fk_compartments_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `components`
--
ALTER TABLE `components`
  ADD CONSTRAINT `fk_components_molecule1` FOREIGN KEY (`idmolecule`) REFERENCES `molecule` (`idmolecule`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_components_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `daily_build`
--
ALTER TABLE `daily_build`
  ADD CONSTRAINT `fk_daily_build_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `diagrams`
--
ALTER TABLE `diagrams`
  ADD CONSTRAINT `fk_diagrams_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `doi`
--
ALTER TABLE `doi`
  ADD CONSTRAINT `doi_molecule1` FOREIGN KEY (`idmolecule`) REFERENCES `molecule` (`idmolecule`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_doi_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ecmnote`
--
ALTER TABLE `ecmnote`
  ADD CONSTRAINT `fk_ecmnote_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `molecule`
--
ALTER TABLE `molecule`
  ADD CONSTRAINT `fk_molecule_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `parameters`
--
ALTER TABLE `parameters`
  ADD CONSTRAINT `fk_parameters_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `projects_groups`
--
ALTER TABLE `projects_groups`
  ADD CONSTRAINT `fk_projects_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_projects_groups_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `pubauth`
--
ALTER TABLE `pubauth`
  ADD CONSTRAINT `fk_pubauth_pubmed1` FOREIGN KEY (`pubmed_id`) REFERENCES `pubmed` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `pubmed`
--
ALTER TABLE `pubmed`
  ADD CONSTRAINT `fk_pubmed_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `rulemol`
--
ALTER TABLE `rulemol`
  ADD CONSTRAINT `fk_rulemol_molecule1` FOREIGN KEY (`idmolecule`) REFERENCES `molecule` (`idmolecule`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rulemol_rules1` FOREIGN KEY (`idrules`) REFERENCES `rules` (`idrules`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `rules`
--
ALTER TABLE `rules`
  ADD CONSTRAINT `fk_rules_ecmnote1` FOREIGN KEY (`idecm`) REFERENCES `ecmnote` (`idecm`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rules_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `rule_compartments`
--
ALTER TABLE `rule_compartments`
  ADD CONSTRAINT `fk_rule_compartments_compartments1` FOREIGN KEY (`compartment_id`) REFERENCES `compartments` (`compartment_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rule_compartments_rules1` FOREIGN KEY (`idrules`) REFERENCES `rules` (`idrules`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `rule_params`
--
ALTER TABLE `rule_params`
  ADD CONSTRAINT `fk_rule_params_parameters1` FOREIGN KEY (`parameter_id`) REFERENCES `parameters` (`parameter_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rule_params_rules1` FOREIGN KEY (`idrules`) REFERENCES `rules` (`idrules`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1_idx` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1_idx` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
