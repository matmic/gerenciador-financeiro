-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22-Jun-2016 às 16:31
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.5.34

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

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`CodCategoria`, `CodPessoa`, `NomeCategoria`, `IndicadorExclusao`) VALUES
(1, 1, 'Alimentação', 'N'),
(2, 1, 'Lazer', 'N'),
(3, 1, 'Futebol', 'N'),
(4, 1, 'Teste', 'S'),
(8, 1, 'Academia', 'N'),
(9, 1, 'Compras', 'N'),
(10, 1, 'Roupas', 'S'),
(11, 1, 'Estudos', 'S'),
(12, 1, 'categoria1', 'S'),
(13, 1, 'categoria1', 'S'),
(14, 1, 'categoria2', 'S'),
(15, 1, 'Salário', 'N'),
(16, 1, 'Depósito', 'N'),
(17, 1, 'Adiantamento', 'N'),
(18, 1, 'Vestuário', 'N'),
(19, 1, 'Gasolina', 'N'),
(20, 2, 'Salário', 'N'),
(21, 2, 'Depósito', 'N');

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

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`CodEndereco`, `Logradouro`, `Numero`, `Complemento`, `Bairro`, `CEP`, `Cidade`, `CodEstado`, `IndicadorExclusao`) VALUES
(1, 'Rua TF', 171, '666', 'BF', '12345-689', 'Porto Alegre', 21, 'N'),
(2, 'Rua Tomas Flores', 171, '801', 'Bom Fim', '90035-201', 'Porto Alegre', 21, 'N');

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

--
-- Extraindo dados da tabela `estabelecimento`
--

INSERT INTO `estabelecimento` (`CodEstabelecimento`, `CodPessoa`, `NomeEstabelecimento`, `IndicadorExclusao`) VALUES
(1, 1, 'Cavanhas', 'N'),
(2, 1, 'Zaffari', 'N'),
(3, 1, 'Teste', 'N'),
(8, 1, 'categoria2', 'S'),
(9, 1, 'categoria2', 'S'),
(10, 1, 'categoria 3', 'S'),
(11, 1, 'CPD', 'N'),
(12, 1, 'Internacional', 'N'),
(13, 1, 'Izabel', 'N'),
(14, 1, 'Guilherme', 'N'),
(15, 1, 'Renner', 'N'),
(16, 1, 'CPD2', 'N'),
(17, 1, 'CPD', 'N'),
(18, 2, 'INSS', 'N'),
(19, 2, 'Matheus', 'N');

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

--
-- Extraindo dados da tabela `orcamento`
--

INSERT INTO `orcamento` (`CodOrcamento`, `CodPessoa`, `CodTipoOrcamento`, `DescricaoOrcamento`, `CodCategoria`, `CodEstabelecimento`, `ValorOrcamento`, `DataOrcamento`, `IndicadorPago`, `IndicadorExclusao`) VALUES
(1, 1, 1, 'CPD2', 15, 17, '3000.00', '2016-06-06', '1', 'N'),
(2, 1, 2, 'Internacional', 2, 12, '390.00', '2016-06-07', '1', 'N'),
(3, 1, 1, 'Depósito', 16, 13, '100.00', '2016-06-07', '1', 'N'),
(4, 1, 1, 'Teste', 17, 14, '200.00', '2016-06-06', '0', 'N'),
(5, 1, 2, 'Xis Salada', 1, 1, '17.00', '2016-06-16', '1', 'N'),
(6, 1, 2, 'Casaco', 19, 15, '250.00', '2016-06-22', '1', 'N'),
(7, 1, 1, 'Teste', 8, 12, '100.00', '2016-06-30', '0', 'N'),
(8, 2, 1, 'INSS', 20, 18, '3500.00', '2016-06-05', '1', 'N'),
(9, 2, 1, 'Teste', 21, 19, '500.00', '2016-06-10', '0', 'N');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `CodPessoa` int(2) NOT NULL,
  `NomePessoa` varchar(50) NOT NULL,
  `CPFPessoa` varchar(11) NOT NULL,
  `EmailPessoa` varchar(50) NOT NULL,
  `GeneroPessoa` varchar(1) NOT NULL,
  `CodEndereco` int(2) NOT NULL,
  `CodEscolaridade` int(2) NOT NULL,
  `TelefonePessoa` varchar(13) NOT NULL,
  `DataNascimentoPessoa` date NOT NULL,
  `SenhaPessoa` varchar(32) NOT NULL,
  `SaldoPessoa` decimal(9,2) NOT NULL,
  `IndicadorExclusao` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`CodPessoa`, `NomePessoa`, `CPFPessoa`, `EmailPessoa`, `GeneroPessoa`, `CodEndereco`, `CodEscolaridade`, `TelefonePessoa`, `DataNascimentoPessoa`, `SenhaPessoa`, `SaldoPessoa`, `IndicadorExclusao`) VALUES
(1, 'Matheus Michel', '11111111111', 'matmic08@gmail.com', 'M', 1, 6, '(51) 81913203', '1993-10-08', '202cb962ac59075b964b07152d234b70', '12286.00', 'N'),
(2, 'Izabel Schilling', '20633416053', 'izabel.sch@hotmail.com', 'F', 2, 7, '(51) 33113973', '1956-08-10', '202cb962ac59075b964b07152d234b70', '13500.00', 'N');

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
  MODIFY `CodCategoria` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `CodEndereco` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `escolaridade`
--
ALTER TABLE `escolaridade`
  MODIFY `CodEscolaridade` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `estabelecimento`
--
ALTER TABLE `estabelecimento`
  MODIFY `CodEstabelecimento` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `CodEstado` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `orcamento`
--
ALTER TABLE `orcamento`
  MODIFY `CodOrcamento` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `CodPessoa` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tipoorcamento`
--
ALTER TABLE `tipoorcamento`
  MODIFY `CodTipoOrcamento` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
