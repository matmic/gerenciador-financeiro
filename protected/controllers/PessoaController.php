<?php

class PessoaController extends Controller
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
			$data = '';
			if (!Yii::app()->user->isGuest)
			{
				$pessoa = Pessoa::model()->findByPk(Yii::app()->user->CodPessoa);
				$partesData = explode('-', $pessoa->DataNascimentoPessoa);
				$data = $partesData[2]."/".$partesData[1]."/".$partesData[0];
				
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
			
			$this->render('meuPerfil', array('data'=>$data, 'pessoa'=>$pessoa, 'endereco'=>$endereco, 'arrEscolaridade'=>$arrEscolaridade, 'arrEstado'=>$arrEstado));
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
			
			// Tratamento do campo data
			$partesData = explode('/', $_POST['Pessoa']['DataNascimentoPessoa']);
			$date = $partesData[2]."-".$partesData[1]."-".$partesData[0];
			$pessoa->DataNascimentoPessoa = $date;
			
			if (!empty($_POST['Pessoa']['NovaSenha']) && !empty($_POST['Pessoa']['SenhaRepetida']))
			{
				if ($_POST['Pessoa']['NovaSenha'] == $_POST['Pessoa']['SenhaRepetida'])
					$pessoa->SenhaPessoa = md5($_POST['Pessoa']['NovaSenha']);
				else
					$temErro = true;
			}
			
			if ($pessoa->isNewRecord)
				$pessoa->SaldoPessoa = 0;
						
			$pessoa->IndicadorExclusao = 'N';
			$endereco->IndicadorExclusao = 'N';
			
			
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
			
			$this->redirect('meuPerfil');
		}
	}
	
	public function actionInserirCredito()
	{
		if (isset($_POST['Pessoa']))
		{
			$pessoa = Pessoa::model()->findByPk(Yii::app()->user->CodPessoa);
			$pessoa->SaldoPessoa += $_POST['Pessoa']['Depositar'];
			$pessoa->save();
			$this->render('index');
		}
		else
			$this->render('formInserirCredito');
	}
	
	public function actionSacarCredito()
	{
		if (isset($_POST['Pessoa']))
		{
			$pessoa = Pessoa::model()->findByPk(Yii::app()->user->CodPessoa);
			$qtdSacar = $_POST['Pessoa']['Sacar'];
			
			if ($pessoa->SaldoPessoa < $qtdSacar)
				$pessoa->SaldoPessoa -= $pessoa->SaldoPessoa;
			else
				$pessoa->SaldoPessoa -= $_POST['Pessoa']['Sacar'];
			
			$pessoa->save();
			$this->render('index');
		}
		else
			$this->render('formSacarCredito');
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