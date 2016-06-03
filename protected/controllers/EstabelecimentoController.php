<?php

class EstabelecimentoController extends Controller
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
	
	public function actionShowFrmEstabelecimento()
	{
		if (isset($_GET['CodEstabelecimento']))
		{
			$estabelecimento = Estabelecimento::model()->findByPk($_GET['CodEstabelecimento']);
			$this->renderPartial('formNovoEstabelecimento', array('estabelecimento'=>$estabelecimento));
		}
	}
	
	public function actionCadastrar()
	{
		if (isset($_GET['CodEstabelecimento']))
		{
			$estabelecimento = Estabelecimento::model()->findByPk($_GET['CodEstabelecimento']);
			$this->render('formNovoEstabelecimento', array('estabelecimento'=>$estabelecimento, 'legend'=>'Editar Estabelecimento'));
		}
		else
			if (isset($_POST['Estabelecimento']))
			{
				if (empty($_POST['Estabelecimento']['CodEstabelecimento']))
					$estabelecimento = new Estabelecimento;
				else
					$estabelecimento = Estabelecimento::model()->findByPk($_POST['Estabelecimento']['CodEstabelecimento']);

				$estabelecimento->attributes = $_POST['Estabelecimento'];
				$estabelecimento->IndicadorExclusao = 'N';
				$estabelecimento->CodPessoa = Yii::app()->user->CodPessoa;
				
				if($estabelecimento->save())
					Yii::app()->user->setFlash('success', "Estabelecimento salvo com sucesso!");
				else
					Yii::app()->user->setFlash('error', "Não foi possível salvar o estabelecimento!");
				
				$this->redirect('listar');
			}
			else
			{
				$estabelecimento = new Estabelecimento;
				$this->render('formNovoEstabelecimento', array('estabelecimento'=>$estabelecimento, 'legend'=>'Novo Estabelecimento'));
			}
	}
	
	public function actionListar()
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition("t.IndicadorExclusao = 'N'");
		$criteria->addCondition("t.CodPessoa = " . Yii::app()->user->CodPessoa);
		
		$estabelecimentos = Estabelecimento::model()->findAll($criteria);
		$estabelecimento = new Estabelecimento;
		$arrayEstabelecimentos=new CArrayDataProvider($estabelecimentos, array(
			'keyField'=>'CodEstabelecimento',
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
		
		$this->render('listarEstabelecimentos', array('estabelecimento'=>$estabelecimento, 'arr'=>$arrayEstabelecimentos));
	}
	
	public function actionExcluir()
	{
		if (isset($_GET['CodEstabelecimento']))
		{
			$est = Estabelecimento::model()->findByPk($_GET['CodEstabelecimento']);
			$est->IndicadorExclusao = 'S';
			$est->save();
			Yii::app()->user->setFlash('success', "Estabelecimento excluído com sucesso!");	
		}
		else
			Yii::app()->user->setFlash('error', "Não foi possível encontrar nenhum estabelecimento!");	
			
		$this->redirect('listar');
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