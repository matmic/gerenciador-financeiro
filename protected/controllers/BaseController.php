<?php

class BaseController extends CController
{
	public function accessRules()
    {
        if (isset($_SESSION['CodIdentidade']) and ! isset($_SESSION['CodPessoa'])) { /// o usu�rio logado � um Candidato
            return array(
                array(
                    'allow',
                    'users' => array('@'),
                    'controllers' => array('portal'),
                    'actions' => array('inscricao', 'dados', 'documentacao', 'provas', 'boletim', 'trocaSenha'),
                ),
                array(
                    'allow',
                    'controllers' => array('documentacao'),
                    'users' => array('@'),
                ),
			);
		}
	}

?>