-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29-Jun-2016 às 21:55
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ihc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `CodCategoria` int(2) NOT NULL,
  `CodPessoa` int(2) NOT NULL,
  `NomeCategoria` varchar(50) NOT NULL,
  `IndicadorExclusao` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `CodEndereco` int(2) NOT NULL,
  `Logradouro` varchar(50) NOT NULL,
  `Numero` int(5) DEFAULT NULL,
  `Complemento` varchar(20) DEFAULT NULL,
  `Bairro` varchar(30) NOT NULL,
  `CEP` varchar(9) NOT NULL,
  `Cidade` varchar(30) NOT NULL,
  `CodEstado` int(2) NOT NULL,
  `IndicadorExclusao` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `escolaridade`
--

CREATE TABLE `escolaridade` (
  `CodEscolaridade` int(2) NOT NULL,
  `NomeEscolaridade` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `escolaridade`
--

INSERT INTO `escolaridade` (`CodEscolaridade`, `NomeEscolaridade`) VALUES
(1, 'Analfabeto'),
(2, 'Ensino Fundamental Incompleto'),
(3, 'Ensino Fundamental Completo'),
(4, 'Ensino Médio Incompleto'),
(5, 'Ensino Médio Completo'),
(6, 'Ensino Superior Incompleto'),
(7, 'Graduação'),
(8, 'Mestrado'),
(9, 'Doutorado'),
(10, 'Especialização'),
(11, 'Pós-Doutorado'),
(12, 'Ensino Técnico');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estabelecimento`
--

CREATE TABLE `estabelecimento` (
  `CodEstabelecimento` int(2) NOT NULL,
  `CodPessoa` int(2) NOT NULL,
  `NomeEstabelecimento` varchar(50) NOT NULL,
  `IndicadorExclusao` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `CodEstado` int(2) NOT NULL,
  `NomeEstado` varchar(50) NOT NULL,
  `UF` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`CodEstado`, `NomeEstado`, `UF`) VALUES
(1, 'Acre', 'AC'),
(2, 'Alagoas', 'AL'),
(3, 'Amapá', 'AP'),
(4, 'Amazonas', 'AM'),
(5, 'Bahia', 'BA'),
(6, 'Ceará', 'CE'),
(7, 'Distrito Federal', 'DF'),
(8, 'Espírito Santo', 'ES'),
(9, 'Goiás', 'GO'),
(10, 'Maranhão', 'MA'),
(11, 'Mato Grosso', 'MT'),
(12, 'Mato Grosso do Sul', 'MS'),
(13, 'Minas Gerais', 'MG'),
(14, 'Pará', 'PA'),
(15, 'Paraíba', 'PB'),
(16, 'Paraná', 'PR'),
(17, 'Pernambuco', 'PE'),
(18, 'Piauí', 'PI'),
(19, 'Rio de Janeiro', 'RJ'),
(20, 'Rio Grande do Norte', 'RN'),
(21, 'Rio Grande do Sul', 'RS'),
(22, 'Rondônia', 'RO'),
(23, 'Roraima', 'RR'),
(24, 'Santa Catarina', 'SC'),
(25, 'São Paulo', 'SP'),
(26, 'Sergipe', 'SE'),
(27, 'Tocantins', 'TO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento`
--

CREATE TABLE `orcamento` (
  `CodOrcamento` int(2) NOT NULL,
  `CodPessoa` int(2) NOT NULL,
  `CodTipoOrcamento` int(1) NOT NULL,
  `DescricaoOrcamento` varchar(50) DEFAULT NULL,
  `CodCategoria` int(2) DEFAULT NULL,
  `CodEstabelecimento` int(2) DEFAULT NULL,
  `ValorOrcamento` decimal(6,2) NOT NULL,
  `DataOrcamento` date NOT NULL,
  `IndicadorPago` varchar(1) NOT NULL,
  `IndicadorExclusao` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `CodPessoa` int(2) NOT NULL,
  `NomePessoa` varchar(20) NOT NULL,
  `CPFPessoa` varchar(11) NOT NULL,
  `EmailPessoa` varchar(20) NOT NULL,
  `GeneroPessoa` varchar(1) NOT NULL,
  `CodEndereco` int(2) NOT NULL,
  `CodEscolaridade` int(2) NOT NULL,
  `TelefonePessoa` varchar(13) NOT NULL,
  `DataNascimentoPessoa` date NOT NULL,
  `SenhaPessoa` varchar(32) NOT NULL,
  `SaldoPessoa` decimal(10,2) NOT NULL,
  `IndicadorExclusao` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoorcamento`
--

CREATE TABLE `tipoorcamento` (
  `CodTipoOrcamento` int(1) NOT NULL,
  `NomeTipoOrcamento` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipoorcamento`
--

INSERT INTO `tipoorcamento` (`CodTipoOrcamento`, `NomeTipoOrcamento`) VALUES
(1, 'Receita'),
(2, 'Despesa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`CodCategoria`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`CodEndereco`),
  ADD UNIQUE KEY `CodEndereco` (`CodEndereco`);

--
-- Indexes for table `escolaridade`
--
ALTER TABLE `escolaridade`
  ADD PRIMARY KEY (`CodEscolaridade`);

--
-- Indexes for table `estabelecimento`
--
ALTER TABLE `estabelecimento`
  ADD PRIMARY KEY (`CodEstabelecimento`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`CodEstado`),
  ADD UNIQUE KEY `CodEstado` (`CodEstado`);

--
-- Indexes for table `orcamento`
--
ALTER TABLE `orcamento`
  ADD PRIMARY KEY (`CodOrcamento`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`CodPessoa`),
  ADD UNIQUE KEY `CPFPessoa` (`CPFPessoa`),
  ADD UNIQUE KEY `EmailPessoa` (`EmailPessoa`);

--
-- Indexes for table `tipoorcamento`
--
ALTER TABLE `tipoorcamento`
  ADD PRIMARY KEY (`CodTipoOrcamento`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `CodCategoria` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `CodEndereco` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `escolaridade`
--
ALTER TABLE `escolaridade`
  MODIFY `CodEscolaridade` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `estabelecimento`
--
ALTER TABLE `estabelecimento`
  MODIFY `CodEstabelecimento` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `CodEstado` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `orcamento`
--
ALTER TABLE `orcamento`
  MODIFY `CodOrcamento` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `CodPessoa` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipoorcamento`
--
ALTER TABLE `tipoorcamento`
  MODIFY `CodTipoOrcamento` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
