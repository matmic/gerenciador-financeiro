<?php

class BaseController extends CController
{
	public function accessRules()
    {
		return array(
			array(
				'deny',
				'users' => array('?'),
				'controllers' => array('estabelecimento'),
				'actions' => array('cadastrar', 'listar', 'excluir'),
			),
			array(
				'allow',
				'users' => array('?'),
				'controllers' => array('pessoa'),

			),
		);
	}
}
?>