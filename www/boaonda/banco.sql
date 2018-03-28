/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Version : 50144
 Source Host           : localhost
 Source Database       : projeto_novomanager

 Target Server Version : 50144
 File Encoding         : utf-8

 Date: 02/14/2012 09:37:48 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `mgr_grupos`
-- ----------------------------
DROP TABLE IF EXISTS `mgr_grupos`;
CREATE TABLE `mgr_grupos` (
  `codgrupo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `publicar` char(1) NOT NULL,
  PRIMARY KEY (`codgrupo`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mgr_grupos`
-- ----------------------------
BEGIN;
INSERT INTO `mgr_grupos` VALUES ('1', 'Administradores', 'S');
COMMIT;

-- ----------------------------
--  Table structure for `mgr_grupos_modulos`
-- ----------------------------
DROP TABLE IF EXISTS `mgr_grupos_modulos`;
CREATE TABLE `mgr_grupos_modulos` (
  `codgrupo` int(11) NOT NULL,
  `codmodulo` int(11) NOT NULL,
  PRIMARY KEY (`codgrupo`,`codmodulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mgr_grupos_modulos`
-- ----------------------------
BEGIN;
INSERT INTO `mgr_grupos_modulos` VALUES ('1', '1'), ('1', '2'), ('1', '3'), ('1', '4'), ('1', '5');
COMMIT;

-- ----------------------------
--  Table structure for `mgr_grupos_usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `mgr_grupos_usuarios`;
CREATE TABLE `mgr_grupos_usuarios` (
  `codgrupo` int(11) NOT NULL,
  `codusuario` int(11) NOT NULL,
  PRIMARY KEY (`codgrupo`,`codusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mgr_grupos_usuarios`
-- ----------------------------
BEGIN;
INSERT INTO `mgr_grupos_usuarios` VALUES ('1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `mgr_modulos`
-- ----------------------------
DROP TABLE IF EXISTS `mgr_modulos`;
CREATE TABLE `mgr_modulos` (
  `codmodulo` int(11) NOT NULL AUTO_INCREMENT,
  `classe` varchar(50) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `codcategoria` int(11) NOT NULL,
  `ordem` int(11) DEFAULT NULL,
  PRIMARY KEY (`codmodulo`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mgr_modulos`
-- ----------------------------
BEGIN;
INSERT INTO `mgr_modulos` VALUES ('1', 'Modulo', 'MÓDULOS', '1', null), ('2', 'Grupo', 'GRUPOS', '1', null), ('3', 'Usuario', 'USUÁRIOS', '1', null), ('4', 'Cliente', 'CLIENTES', '2', null), ('5', 'Novidades', 'NOVIDADES', '2', null), ('6', 'Agenda', 'AGENDA', '2', null), ('7', 'Galerias', 'GALERIAS DE FOTOS', '2', null), ('8', 'Produto', 'PRODUTO', '2', null), ('9', 'ProdutoAplicacao', 'PRODUTO APLICAÇÃO', '2', null), ('10', 'Videos', 'VÍDEOS', '2', null);
COMMIT;

-- ----------------------------
--  Table structure for `mgr_modulos_categorias`
-- ----------------------------
DROP TABLE IF EXISTS `mgr_modulos_categorias`;
CREATE TABLE `mgr_modulos_categorias` (
  `codcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  PRIMARY KEY (`codcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mgr_modulos_categorias`
-- ----------------------------
BEGIN;
INSERT INTO `mgr_modulos_categorias` VALUES ('1', 'Configurações'), ('2', 'Gerenciar Conteúdo');
COMMIT;

-- ----------------------------
--  Table structure for `mgr_usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `mgr_usuarios`;
CREATE TABLE `mgr_usuarios` (
  `codusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `publicar` char(1) NOT NULL,
  PRIMARY KEY (`codusuario`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mgr_usuarios`
-- ----------------------------
BEGIN;
INSERT INTO `mgr_usuarios` VALUES ('1', 'Afirma.cc', 'contato@afirma.cc', 'afirma', 'afirma', 'S');
COMMIT;

-- ----------------------------
--  Table structure for `site_agenda`
-- ----------------------------
DROP TABLE IF EXISTS `site_agenda`;
CREATE TABLE `site_agenda` (
  `AgendaID` int(11) NOT NULL AUTO_INCREMENT,
  `GaleriaID` int(11) NOT NULL,
  `Titulo` varchar(200) NOT NULL,
  `Url` varchar(200) NOT NULL,
  `Corpo` text NOT NULL,
  `Data` datetime NOT NULL,
  `Ativo` char(1) NOT NULL,
  PRIMARY KEY (`AgendaID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `site_cliente`
-- ----------------------------
DROP TABLE IF EXISTS `site_cliente`;
CREATE TABLE `site_cliente` (
  `ClienteID` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(200) NOT NULL,
  `Imagem` varchar(150) NOT NULL,
  `Ativo` char(1) NOT NULL,
  PRIMARY KEY (`ClienteID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `site_cliente`
-- ----------------------------
BEGIN;
INSERT INTO `site_cliente` VALUES ('1', 'testeando', 'photos_82.jpg', 'N'), ('2', 'fdsafasfas', '', 'N');
COMMIT;

-- ----------------------------
--  Table structure for `site_galerias`
-- ----------------------------
DROP TABLE IF EXISTS `site_galerias`;
CREATE TABLE `site_galerias` (
  `GaleriaID` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(255) NOT NULL,
  PRIMARY KEY (`GaleriaID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `site_novidades`
-- ----------------------------
DROP TABLE IF EXISTS `site_novidades`;
CREATE TABLE `site_novidades` (
  `NovidadeID` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(200) NOT NULL,
  `Url` varchar(200) NOT NULL,
  `Introducao` text NOT NULL,
  `Corpo` text NOT NULL,
  `Imagem` varchar(150) NOT NULL,
  `Fonte` varchar(200) NOT NULL,
  `NoticiaData` datetime NOT NULL,
  `PublicadoData` datetime NOT NULL,
  `Ativo` char(1) NOT NULL,
  PRIMARY KEY (`NovidadeID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `site_novidades`
-- ----------------------------
BEGIN;
INSERT INTO `site_novidades` VALUES ('1', 'fdasfas', 'fdasfas', 'afasdfas', '<p>dfasfasfsa</p>', 'photos_44.jpg', 'asdfasfsa', '2012-01-21 14:34:00', '2012-01-21 14:34:17', 'N');
COMMIT;

-- ----------------------------
--  Table structure for `site_produto`
-- ----------------------------
DROP TABLE IF EXISTS `site_produto`;
CREATE TABLE `site_produto` (
  `ProdutoID` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(200) NOT NULL,
  `Url` varchar(200) NOT NULL,
  `Descricao` text NOT NULL,
  `DataPublicacao` datetime NOT NULL,
  `Ativo` char(1) NOT NULL,
  PRIMARY KEY (`ProdutoID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `site_produto_aplicacao`
-- ----------------------------
DROP TABLE IF EXISTS `site_produto_aplicacao`;
CREATE TABLE `site_produto_aplicacao` (
  `ProdutoAplicacaoID` int(11) NOT NULL AUTO_INCREMENT,
  `ProdutoID` int(11) DEFAULT NULL,
  `Nome` varchar(200) NOT NULL,
  `Descricao` text,
  `Imagem` varchar(150) NOT NULL,
  PRIMARY KEY (`ProdutoAplicacaoID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `site_videos`
-- ----------------------------
DROP TABLE IF EXISTS `site_videos`;
CREATE TABLE `site_videos` (
  `VideoID` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(200) NOT NULL,
  `Descricao` text,
  `Link` varchar(200) NOT NULL,
  `Ativo` char(1) NOT NULL,
  PRIMARY KEY (`VideoID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;
