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
	
	public function actionCadastrarEstabelecimento()
	{
		if (isset($_POST) && !empty($_POST))
		{
			$estabelecimento = new Estabelecimento;
			$estabelecimento->NomeEstabelecimento = $_POST['nome'];
			$estabelecimento->save();
		}
		
		$this->render('formNovoEstabelecimento');
	}
	
	public function actionListarEstabelecimentos()
	{
		$estabelecimentos = Estabelecimento::model()->findAll();
		
		$arrayEstabelecimentos=new CArrayDataProvider($estabelecimentos, array(
			'keyField'=>'CodEstabelecimento',
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
		
		$this->render('listarEstabelecimentos', array('arr'=>$arrayEstabelecimentos));
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