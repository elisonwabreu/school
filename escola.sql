-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 18-Jan-2015 às 22:42
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `escola`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `level` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `level`) VALUES
(1, 'Mr. Admin', 'elisonwabreu@gmail.com', '123456', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `al_id` int(11) NOT NULL AUTO_INCREMENT,
  `al_nome` varchar(250) NOT NULL,
  `al_nome_mae` varchar(250) NOT NULL,
  `al_data_nasc` date NOT NULL,
  `al_ano` varchar(255) NOT NULL,
  `al_cpf` char(11) DEFAULT NULL,
  `al_rg` varchar(50) DEFAULT NULL,
  `al_org_emissor` varchar(45) NOT NULL,
  `al_sexo` char(1) NOT NULL,
  `al_cep` char(9) NOT NULL,
  `al_logradouro` varchar(150) NOT NULL,
  `al_numero` int(11) NOT NULL,
  `al_complemento` varchar(150) DEFAULT NULL,
  `al_bairro` varchar(150) NOT NULL,
  `al_fone` int(8) DEFAULT NULL,
  `al_celular` int(8) DEFAULT NULL,
  `al_email` varchar(50) DEFAULT NULL,
  `al_foto` varchar(255) DEFAULT NULL,
  `al_sanguineo` char(2) DEFAULT NULL,
  `al_cidade` varchar(100) NOT NULL,
  `al_uf` char(2) NOT NULL,
  `al_status` char(1) DEFAULT 'A',
  `al_cod_usuario` int(11) NOT NULL,
  `al_data_alteracao` timestamp(6) NOT NULL,
  PRIMARY KEY (`al_id`),
  UNIQUE KEY `aluno_cpf_UNIQUE` (`al_cpf`),
  UNIQUE KEY `pr_email_UNIQUE` (`al_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL COMMENT '0 undefined , 1 present , 2  absent',
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`attendance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `author` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `name_numeric` longtext COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `class_routine`
--

CREATE TABLE IF NOT EXISTS `class_routine` (
  `class_routine_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `time_start` int(11) NOT NULL,
  `time_end` int(11) NOT NULL,
  `day` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`class_routine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas_receber`
--

CREATE TABLE IF NOT EXISTS `contas_receber` (
  `ctr_id` int(11) NOT NULL AUTO_INCREMENT,
  `ctr_` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ctr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `conta_despesa`
--

CREATE TABLE IF NOT EXISTS `conta_despesa` (
  `ctd_id` int(11) NOT NULL AUTO_INCREMENT,
  `ctd_descricao` varchar(150) NOT NULL,
  `ctd_status` char(1) NOT NULL,
  `ctd_cod_usuario` int(11) NOT NULL,
  `ctd_data_alteracao` timestamp(6) NOT NULL,
  PRIMARY KEY (`ctd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `dis_id` int(11) NOT NULL AUTO_INCREMENT,
  `dis_descricao` varchar(250) NOT NULL,
  `dis_status` char(1) NOT NULL DEFAULT 'A',
  `dis_cod_usuario` int(11) NOT NULL,
  `dis_data_alteracao` timestamp(6) NOT NULL,
  `dis_aprovado` char(1) DEFAULT NULL,
  PRIMARY KEY (`dis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dormitory`
--

CREATE TABLE IF NOT EXISTS `dormitory` (
  `dormitory_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `number_of_room` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`dormitory_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `est_id` int(11) NOT NULL AUTO_INCREMENT,
  `est_nome` varchar(50) DEFAULT NULL,
  `est_sigla` char(2) DEFAULT NULL,
  PRIMARY KEY (`est_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`est_id`, `est_nome`, `est_sigla`) VALUES
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
-- Estrutura da tabela `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext COLLATE utf8_unicode_ci NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `forma_pagamento`
--

CREATE TABLE IF NOT EXISTS `forma_pagamento` (
  `frmp_id` int(11) NOT NULL AUTO_INCREMENT,
  `frmp_descricao` varchar(150) NOT NULL,
  `frmp_tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`frmp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
  `grade_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `grade_point` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mark_from` int(11) NOT NULL,
  `mark_upto` int(11) NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`grade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
  `hr_id` int(11) NOT NULL AUTO_INCREMENT,
  `hr_descricao` varchar(50) NOT NULL,
  `hr_turma_cod` int(11) NOT NULL,
  `hr_cod_disciplina` int(11) NOT NULL,
  `hr_inicio` time(4) NOT NULL,
  `hr_fim` time(4) NOT NULL,
  `hr_cod_sala` int(11) NOT NULL,
  `hr_status` char(1) NOT NULL,
  `hr_cod_usuario` int(11) NOT NULL,
  `hr_data_alteracao` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`hr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `creation_timestamp` int(11) NOT NULL,
  `payment_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` longtext COLLATE utf8_unicode_ci NOT NULL,
  `payment_details` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'paid or unpaid',
  PRIMARY KEY (`invoice_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `phrase_id` int(11) NOT NULL AUTO_INCREMENT,
  `phrase` longtext COLLATE utf8_unicode_ci NOT NULL,
  `english` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pt_br` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`phrase_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=261 ;

--
-- Extraindo dados da tabela `language`
--

INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `pt_br`) VALUES
(1, 'login', 'login', ''),
(2, 'account_type', 'account type', ''),
(3, 'admin', 'admin', ''),
(4, 'teacher', 'Teacher', 'Professor'),
(5, 'student', 'student', 'Aluno'),
(6, 'parent', 'parent', 'Responsável'),
(7, 'email', 'email', ''),
(8, 'password', 'password', 'Senha'),
(9, 'forgot_password ?', 'forgot password ?', 'Esqueceu sua senha?'),
(10, 'reset_password', 'reset password', 'Limpar Senha'),
(11, 'reset', 'reset', 'Limpar'),
(12, 'admin_dashboard', 'Admin Dashboard', 'Painel Administrativo'),
(13, 'account', 'account', 'Conta'),
(14, 'profile', 'profile', ''),
(15, 'change_password', 'change password', 'Mudar senha'),
(16, 'logout', 'logout', 'Sair'),
(17, 'panel', 'panel', 'Painel'),
(18, 'dashboard_help', 'dashboard help', ''),
(19, 'dashboard', 'dashboard', ''),
(20, 'student_help', 'student help', ''),
(21, 'teacher_help', 'teacher help', ''),
(22, 'subject_help', 'subject help', ''),
(23, 'subject', 'subject', ''),
(24, 'class_help', 'class help', ''),
(25, 'class', 'class', 'Ano'),
(26, 'exam_help', 'exam help', ''),
(27, 'exam', 'exam', 'Prova'),
(28, 'marks_help', 'marks help', ''),
(29, 'marks-attendance', 'marks-attendance', ''),
(30, 'grade_help', 'grade help', ''),
(31, 'exam-grade', 'exam-grade', ''),
(32, 'class_routine_help', 'class routine help', ''),
(33, 'class_routine', 'class routine', ''),
(34, 'invoice_help', 'invoice help', ''),
(35, 'payment', 'payment', 'Pagamento'),
(36, 'book_help', 'book help', ''),
(37, 'library', 'library', 'Biblioteca'),
(38, 'transport_help', 'transport help', ''),
(39, 'transport', 'transport', 'Transporte'),
(40, 'dormitory_help', 'dormitory help', ''),
(41, 'dormitory', 'dormitory', ''),
(42, 'noticeboard_help', 'noticeboard help', ''),
(43, 'noticeboard-event', 'noticeboard-event', ''),
(44, 'bed_ward_help', 'bed ward help', ''),
(45, 'settings', 'settings', 'Configurações'),
(46, 'system_settings', 'system settings', 'Configurações de Sistema'),
(47, 'manage_language', 'manage language', 'Gerenciamento de Idioma'),
(48, 'backup_restore', 'backup restore', 'Restaurar Backup'),
(49, 'profile_help', 'profile help', ''),
(50, 'manage_student', 'manage student', 'Gerenciar Aluno'),
(51, 'manage_teacher', 'Manage Teacher', 'Gerenciar Professor'),
(52, 'noticeboard', 'noticeboard', ''),
(53, 'language', 'language', 'Idioma'),
(54, 'backup', 'backup', 'Backup'),
(55, 'calendar_schedule', 'calendar schedule', ''),
(56, 'select_a_class', 'select a class', 'Selecione um Ano'),
(57, 'student_list', 'student list', 'Lista de Alunos'),
(58, 'add_student', 'add student', 'Adicionar Aluno'),
(59, 'roll', 'roll', ''),
(60, 'photo', 'photo', 'Foto'),
(61, 'student_name', 'student name', 'Nome Aluno'),
(62, 'address', 'address', 'Endereço'),
(63, 'options', 'options', 'Opções'),
(64, 'marksheet', 'marksheet', ''),
(65, 'id_card', 'id card', ''),
(66, 'edit', 'edit', 'Editar'),
(67, 'delete', 'delete', 'Deletar'),
(68, 'personal_profile', 'personal profile', ''),
(69, 'academic_result', 'academic result', ''),
(70, 'name', 'name', 'Nome'),
(71, 'birthday', 'birthday', 'Aniversário'),
(72, 'sex', 'sex', 'Sexo'),
(73, 'male', 'male', 'Masculino'),
(74, 'female', 'female', 'Feminino'),
(75, 'religion', 'religion', 'Religião'),
(76, 'blood_group', 'blood group', 'Grupo Sanguíneo'),
(77, 'phone', 'phone', 'Fone'),
(78, 'father_name', 'father name', 'Nome do Pai'),
(79, 'mother_name', 'mother name', 'Nome da Mãe'),
(80, 'edit_student', 'edit student', 'Editar Aluno'),
(81, 'teacher_list', 'teacher list', 'Lista de Professores'),
(82, 'add_teacher', 'add teacher', 'Adicionar Professor'),
(83, 'teacher_name', 'teacher name', 'Nome Professor'),
(84, 'edit_teacher', 'edit teacher', 'Editar Professor'),
(85, 'manage_parent', 'manage parent', 'Gerenciar Responsáveis'),
(86, 'parent_list', 'parent list', 'Lista de Responsáveis'),
(87, 'parent_name', 'parent name', 'Nome do Responsável'),
(88, 'relation_with_student', 'relation with student', 'Grau de Parentesco'),
(89, 'parent_email', 'parent email', 'E-mail do Responsável'),
(90, 'parent_phone', 'parent phone', 'Fone do Responsável'),
(91, 'parrent_address', 'parrent address', 'Endereço do Responsável'),
(92, 'parrent_occupation', 'parrent occupation', 'Profissão do Responsável'),
(93, 'add', 'add', 'Adicionar'),
(94, 'parent_of', 'parent of', ''),
(95, 'profession', 'profession', 'Profissão'),
(96, 'edit_parent', 'edit parent', 'Editar Responsável'),
(97, 'add_parent', 'add parent', 'Adicionar Responsável'),
(98, 'manage_subject', 'manage subject', ''),
(99, 'subject_list', 'subject list', ''),
(100, 'add_subject', 'add subject', ''),
(101, 'subject_name', 'subject name', ''),
(102, 'edit_subject', 'edit subject', ''),
(103, 'manage_class', 'manage class', ''),
(104, 'class_list', 'class list', ''),
(105, 'add_class', 'add class', ''),
(106, 'class_name', 'class name', ''),
(107, 'numeric_name', 'numeric name', ''),
(108, 'name_numeric', 'name numeric', ''),
(109, 'edit_class', 'edit class', ''),
(110, 'manage_exam', 'manage exam', ''),
(111, 'exam_list', 'exam list', ''),
(112, 'add_exam', 'add exam', ''),
(113, 'exam_name', 'exam name', ''),
(114, 'date', 'date', ''),
(115, 'comment', 'comment', ''),
(116, 'edit_exam', 'edit exam', ''),
(117, 'manage_exam_marks', 'manage exam marks', ''),
(118, 'manage_marks', 'manage marks', ''),
(119, 'select_exam', 'select exam', ''),
(120, 'select_class', 'select class', ''),
(121, 'select_subject', 'select subject', ''),
(122, 'select_an_exam', 'select an exam', ''),
(123, 'mark_obtained', 'mark obtained', ''),
(124, 'attendance', 'attendance', ''),
(125, 'manage_grade', 'manage grade', ''),
(126, 'grade_list', 'grade list', ''),
(127, 'add_grade', 'add grade', ''),
(128, 'grade_name', 'grade name', ''),
(129, 'grade_point', 'grade point', ''),
(130, 'mark_from', 'mark from', ''),
(131, 'mark_upto', 'mark upto', ''),
(132, 'edit_grade', 'edit grade', ''),
(133, 'manage_class_routine', 'manage class routine', ''),
(134, 'class_routine_list', 'class routine list', ''),
(135, 'add_class_routine', 'add class routine', ''),
(136, 'day', 'day', 'Dia'),
(137, 'starting_time', 'starting time', ''),
(138, 'ending_time', 'ending time', ''),
(139, 'edit_class_routine', 'edit class routine', ''),
(140, 'manage_invoice/payment', 'manage invoice/payment', 'Gerenciar Faturas e Pagamentos'),
(141, 'invoice/payment_list', 'invoice/payment list', 'Lista de Faturas e Pagamentos'),
(142, 'add_invoice/payment', 'add invoice/payment', 'Adicionar Fatura / Pagamento'),
(143, 'title', 'title', 'Titulo'),
(144, 'description', 'description', 'Descrição'),
(145, 'amount', 'amount', ''),
(146, 'status', 'status', ''),
(147, 'view_invoice', 'view invoice', ''),
(148, 'paid', 'paid', 'Pago'),
(149, 'unpaid', 'unpaid', 'Não Pago'),
(150, 'add_invoice', 'add invoice', 'Adicionar Fatura'),
(151, 'payment_to', 'payment to', ''),
(152, 'bill_to', 'bill to', ''),
(153, 'invoice_title', 'invoice title', ''),
(154, 'invoice_id', 'invoice id', ''),
(155, 'edit_invoice', 'edit invoice', ''),
(156, 'manage_library_books', 'manage library books', 'Gerenciar Biblioteca'),
(157, 'book_list', 'book list', 'Lista de Livros'),
(158, 'add_book', 'add book', 'Adicionar Livro'),
(159, 'book_name', 'book name', 'Nome do Livro'),
(160, 'author', 'author', 'Autor'),
(161, 'price', 'price', 'Valor'),
(162, 'available', 'available', 'Disponivel'),
(163, 'unavailable', 'unavailable', 'Indisponivel'),
(164, 'edit_book', 'edit book', 'Editar Livro'),
(165, 'manage_transport', 'manage transport', 'Gerenciar Transporte'),
(166, 'transport_list', 'transport list', 'Lista de Transportes'),
(167, 'add_transport', 'add transport', 'Adicionar Transporte'),
(168, 'route_name', 'route name', ''),
(169, 'number_of_vehicle', 'number of vehicle', ''),
(170, 'route_fare', 'route fare', ''),
(171, 'edit_transport', 'edit transport', ''),
(172, 'manage_dormitory', 'manage dormitory', ''),
(173, 'dormitory_list', 'dormitory list', ''),
(174, 'add_dormitory', 'add dormitory', ''),
(175, 'dormitory_name', 'dormitory name', ''),
(176, 'number_of_room', 'number of room', ''),
(177, 'manage_noticeboard', 'manage noticeboard', ''),
(178, 'noticeboard_list', 'noticeboard list', ''),
(179, 'add_noticeboard', 'add noticeboard', ''),
(180, 'notice', 'notice', ''),
(181, 'add_notice', 'add notice', ''),
(182, 'edit_noticeboard', 'edit noticeboard', ''),
(183, 'system_name', 'system name', ''),
(184, 'save', 'save', ''),
(185, 'system_title', 'system title', ''),
(186, 'paypal_email', 'paypal email', ''),
(187, 'currency', 'currency', ''),
(188, 'phrase_list', 'phrase list', ''),
(189, 'add_phrase', 'add phrase', ''),
(190, 'add_language', 'add language', ''),
(191, 'phrase', 'phrase', ''),
(192, 'manage_backup_restore', 'manage backup restore', ''),
(193, 'restore', 'restore', ''),
(194, 'mark', 'mark', ''),
(195, 'grade', 'grade', ''),
(196, 'invoice', 'invoice', ''),
(197, 'book', 'book', 'Livro'),
(198, 'all', 'all', 'Todos'),
(199, 'upload_&_restore_from_backup', 'upload & restore from backup', ''),
(200, 'manage_profile', 'manage profile', ''),
(201, 'update_profile', 'update profile', ''),
(202, 'new_password', 'new password', ''),
(203, 'confirm_new_password', 'confirm new password', ''),
(204, 'update_password', 'update password', ''),
(205, 'teacher_dashboard', 'teacher dashboard', ''),
(206, 'backup_restore_help', 'backup restore help', ''),
(207, 'student_dashboard', 'student dashboard', ''),
(208, 'parent_dashboard', 'parent dashboard', ''),
(209, 'view_marks', 'view marks', ''),
(210, 'delete_language', 'delete language', 'Deletar Idioma'),
(211, 'settings_updated', 'settings updated', ''),
(212, 'update_phrase', 'update phrase', 'Salvar Alterações'),
(213, 'login_failed', 'login failed', ''),
(214, 'live_chat', 'live chat', ''),
(215, 'client 1', 'client 1', ''),
(216, 'buyer', 'buyer', ''),
(217, 'purchase_code', 'purchase code', ''),
(218, 'system_email', 'system email', ''),
(219, 'option', 'option', ''),
(220, 'edit_phrase', 'edit phrase', ''),
(221, 'marks', '', ''),
(222, 'message', '', ''),
(223, 'manage_message', '', ''),
(224, '0', '', ''),
(225, '0', '', ''),
(226, 'notice_updated', '', ''),
(227, 'payment_cancelled', '', ''),
(228, '0', '', ''),
(229, '0', '', ''),
(230, 'payment_successfull', '', ''),
(231, 'admit_student', '', 'Matricular Aluno'),
(232, 'student_information', '', 'Informações dos Estudantes'),
(233, 'student_marksheet', '', ''),
(234, 'daily_attendance', '', ''),
(235, 'exam_grades', '', ''),
(236, 'general_settings', '', 'Configurações Gerais'),
(237, 'language_settings', '', 'Configurações de Idioma'),
(238, 'edit_profile', '', ''),
(239, 'event_schedule', '', ''),
(240, 'cancel', '', 'Cancelar'),
(241, 'addmission_form', '', 'Formulário de Cadastro'),
(242, 'value_required', '', 'Campo Obrigatório'),
(243, 'select', '', 'Selecione'),
(244, 'gender', '', 'Sexo'),
(245, 'add_new_student', '', 'Adicionar Novo Estudante'),
(246, 'language_list', '', 'Lista de Idiomas'),
(247, 'text_align', '', ''),
(248, 'mae', '', 'Nome da Mãe'),
(251, 'cep', 'null', 'CEP'),
(252, 'numero', 'null', 'Número'),
(253, 'complemento', 'null', 'Complemento'),
(254, 'estado', 'null', 'Estado'),
(255, 'cidade', 'null', 'Cidade'),
(256, 'bairro', 'null', 'Bairro'),
(257, 'celular', 'null', 'Celular'),
(258, 'rg', 'null', 'RG'),
(259, 'emissor', 'null', 'Emissor'),
(260, 'cpf', 'null', 'CPF');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mark`
--

CREATE TABLE IF NOT EXISTS `mark` (
  `mark_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `mark_obtained` int(11) NOT NULL DEFAULT '0',
  `mark_total` int(11) NOT NULL DEFAULT '100',
  `attendance` int(11) NOT NULL DEFAULT '0',
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`mark_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula`
--

CREATE TABLE IF NOT EXISTS `matricula` (
  `mtr_id` int(11) NOT NULL,
  `mtr_cod_aluno` int(11) NOT NULL,
  PRIMARY KEY (`mtr_id`),
  UNIQUE KEY `mtr_id_UNIQUE` (`mtr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `notas`
--

CREATE TABLE IF NOT EXISTS `notas` (
  `nt_aluno_id` int(11) NOT NULL,
  `nt_disciplina_id` int(11) DEFAULT NULL,
  `nt_turma_id` int(11) DEFAULT NULL,
  `nt_prova1` decimal(2,2) DEFAULT NULL,
  `nt_prova2` decimal(2,2) DEFAULT NULL,
  `nt_prova3` decimal(2,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticeboard`
--

CREATE TABLE IF NOT EXISTS `noticeboard` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `notice` longtext COLLATE utf8_unicode_ci NOT NULL,
  `create_timestamp` int(11) NOT NULL,
  PRIMARY KEY (`notice_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `parent`
--

CREATE TABLE IF NOT EXISTS `parent` (
  `parent_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  `relation_with_student` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `profession` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `method` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `pr_id` int(11) NOT NULL AUTO_INCREMENT,
  `pr_nome` varchar(250) NOT NULL,
  `prl_nome_mae` varchar(250) NOT NULL,
  `pr_data_nasc` date NOT NULL,
  `pr_cpf` char(11) DEFAULT NULL,
  `pr_rg` varchar(50) DEFAULT NULL,
  `pr_org_emissor` varchar(45) NOT NULL,
  `pr_sexo` char(1) NOT NULL,
  `pr_cep` char(9) NOT NULL,
  `pr_logradouro` varchar(150) NOT NULL,
  `pr_numero` int(11) NOT NULL,
  `pr_complemento` varchar(150) DEFAULT NULL,
  `pr_bairro` varchar(150) NOT NULL,
  `pr_fone` int(8) DEFAULT NULL,
  `pr_celular` int(8) DEFAULT NULL,
  `pr_email` varchar(50) DEFAULT NULL,
  `pr_formacao` varchar(200) NOT NULL,
  `pr_foto` varchar(255) DEFAULT NULL,
  `pr_cidade` varchar(100) NOT NULL,
  `pr_uf` char(2) NOT NULL,
  `pr_status` char(1) DEFAULT NULL,
  `pr_cod_usuario` int(11) NOT NULL,
  `pr_data_alteracao` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`pr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `prova`
--

CREATE TABLE IF NOT EXISTS `prova` (
  `prv_id` int(11) NOT NULL AUTO_INCREMENT,
  `prv_disciplina_id` int(11) NOT NULL,
  `prv_data` date NOT NULL,
  `prv_hora_inicio` time(4) NOT NULL,
  `prv_hora_fim` time(4) NOT NULL,
  `prv_professor_id` int(11) NOT NULL,
  `prv_realizada` char(1) NOT NULL,
  `prv_cod_usuario` int(11) NOT NULL,
  `prv_data_alteracao` timestamp(6) NOT NULL,
  PRIMARY KEY (`prv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala`
--

CREATE TABLE IF NOT EXISTS `sala` (
  `sl_id` int(11) NOT NULL AUTO_INCREMENT,
  `sl_descricao` varchar(50) NOT NULL,
  `sl_status` char(1) DEFAULT NULL,
  `sl_cod_usuario` int(11) NOT NULL,
  `sl_data_alteracao` timestamp(6) NOT NULL,
  PRIMARY KEY (`sl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'Teste'),
(2, 'system_title', 'Teste'),
(3, 'address', 'Dhaka, Bangladesh'),
(4, 'phone', '+8012654159'),
(5, 'paypal_email', 'payment@school.com'),
(6, 'currency', 'usd'),
(7, 'system_email', 'school@ekattor.com'),
(8, 'buyer', 'nulledphp.com'),
(9, 'purchase_code', '0'),
(11, 'language', 'pt_br'),
(12, 'text_align', 'left-to-right');

-- --------------------------------------------------------

--
-- Estrutura da tabela `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `birthday` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `religion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `father_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mother_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `roll` longtext COLLATE utf8_unicode_ci NOT NULL,
  `transport_id` int(11) NOT NULL,
  `dormitory_id` int(11) NOT NULL,
  `dormitory_room_number` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `student`
--

INSERT INTO `student` (`student_id`, `name`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `email`, `password`, `father_name`, `mother_name`, `class_id`, `roll`, `transport_id`, `dormitory_id`, `dormitory_room_number`) VALUES
(1, '0', '0', '0', '', '', '0', '0', '0', '0', '', '', '0', '0', 0, 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `birthday` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `religion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `transport`
--

CREATE TABLE IF NOT EXISTS `transport` (
  `transport_id` int(11) NOT NULL AUTO_INCREMENT,
  `route_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `number_of_vehicle` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `route_fare` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`transport_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE IF NOT EXISTS `turma` (
  `trm_id` int(11) NOT NULL AUTO_INCREMENT,
  `trm_descricao` varchar(45) NOT NULL,
  `trm_status` char(1) DEFAULT NULL,
  `trm_cod_usuario` int(11) NOT NULL,
  `trm_data_alteracao` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`trm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
