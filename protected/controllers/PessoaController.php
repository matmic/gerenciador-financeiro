<?php

class PessoaController extends BaseController
{
	public function beforeAction($action) 
	{
		if( parent::beforeAction($action)) 
		{
			/* @var $cs CClientScript */
			$baseUrl = Yii::app()->baseUrl; 
			$cs = Yii::app()->clientScript;
			/* @var $theme CTheme */
			$cs->registerScriptFile($baseUrl . '/js/jquery.mask.js' );
			$cs->registerScriptFile($baseUrl . '/js/jquery.min.js' );
			$cs->registerScriptFile($baseUrl . '/js/jquery.maskMoney.js' );
			return true;
		}
		
		return false;
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionMeuPerfil()
	{
		if (!isset($_POST['Pessoa']))
		{
			if (!Yii::app()->user->isGuest)
			{
				$pessoa = Pessoa::model()->findByPk(Yii::app()->user->CodPessoa);
				$endereco = Endereco::model()->findByPk($pessoa->CodEndereco);
			}
			else
			{
				$pessoa = new Pessoa;
				$endereco = new Endereco;
			}
			
			$escolaridade = Escolaridade::model()->findAll();
			$arrEscolaridade = CHtml::listData($escolaridade, 'CodEscolaridade', 'NomeEscolaridade');
			
			$estado = Estado::model()->findAll();
			$arrEstado = CHtml::listData($estado, 'CodEstado', 'UF');
			
			$this->render('meuPerfil', array('pessoa'=>$pessoa, 'endereco'=>$endereco, 'arrEscolaridade'=>$arrEscolaridade, 'arrEstado'=>$arrEstado));
		}
		else
		{
			$temErro = false;
			
			if (!empty($_POST['Pessoa']['CodPessoa']))
			{
				$pessoa = Pessoa::model()->findByPk($_POST['Pessoa']['CodPessoa']);
				$endereco = Endereco::model()->findByPk($_POST['Endereco']['CodEndereco']);
				
			}
			else
			{
				$pessoa = new Pessoa;
				$endereco = new Endereco;
			}
			
			$pessoa->attributes = $_POST['Pessoa'];
			$endereco->attributes = $_POST['Endereco'];
			
			if (!empty($_POST['Pessoa']['NovaSenha']) && !empty($_POST['Pessoa']['SenhaRepetida']))
			{
				if ($_POST['Pessoa']['NovaSenha'] == $_POST['Pessoa']['SenhaRepetida'])
					$pessoa->SenhaPessoa = md5($_POST['Pessoa']['NovaSenha']);
				else
					$temErro = true;
			}
			
			$isNew = false;
			if ($pessoa->isNewRecord)
				$isNew = true;	
			
			$pessoa->IndicadorExclusao = 'N';
			$endereco->IndicadorExclusao = 'N';
			
			//CVarDumper::dump($pessoa,10,true);die;
			
			if (!$temErro)
			{
				$endereco->save();				
				
				$pessoa->CodEndereco = $endereco->CodEndereco;
				
				if($pessoa->save())				
					Yii::app()->user->setFlash('success', "Informações salvas com sucesso!");
				else
					Yii::app()->user->setFlash('error', "Não foi possível salvar as informações!");
			}
			else
				Yii::app()->user->setFlash('error', "As senhas informadas são diferentes!");
			
			if ($isNew)
				$this->redirect(array('pessoa/login'));
			else
				$this->redirect(array('orcamento/index'));
		}
	}
	
	public function actionLogin()
	{
		if (isset($_POST['Pessoa']))
		{
			//CVarDumper::dump($_POST['Pessoa']);die;
			$username = $_POST['Pessoa']['CPF'];
			$password = $_POST['Pessoa']['Senha'];
					
			$identity = new UserIdentity($username,$password);
			
			if($identity->authenticate())
			{
				Yii::app()->user->login($identity);
				Yii::app()->user->setFlash('success', "Você está logado!");
				$this->redirect(array('orcamento/index'));
				
			}
			else
			{
				Yii::app()->user->setFlash('error', "Não foi possível logar-se! Verifique as informações preenchidas!");
				$this->redirect(array('pessoa/login'));
			}
		}
		else
			$this->render('novoLogin');
	}
	
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}