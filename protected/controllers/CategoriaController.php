<?php

class CategoriaController extends Controller
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
	
	public function actionShowFrmCategoria()
	{
		if (isset($_GET['CodCategoria']))
		{
			$categoria = Categoria::model()->findByPk($_GET['CodCategoria']);
			$this->renderPartial('formNovaCategoria', array('categoria'=>$categoria));
		}
	}
	
	public function actionCadastrar()
	{
		if (isset($_GET['CodCategoria']))
		{
			$categoria = Categoria::model()->findByPk($_GET['CodCategoria']);
			$this->render('formNovaCategoria', array('categoria'=>$categoria, 'legend'=>'Editar Categoria'));
		}
		else
			if (isset($_POST['Categoria']))
			{
				if (empty($_POST['Categoria']['CodCategoria']))
					$categoria = new Categoria;
				else
					$categoria = Categoria::model()->findByPk($_POST['Categoria']['CodCategoria']);

				$categoria->attributes = $_POST['Categoria'];
				$categoria->IndicadorExclusao = 'N';
				$categoria->CodPessoa = Yii::app()->user->CodPessoa;
				
				if($categoria->save())
					Yii::app()->user->setFlash('success', "Categoria salva com sucesso!");
				else
					Yii::app()->user->setFlash('error', "Não foi possível salvar a categoria!");
				
				$this->redirect('listar');
			}
			else
			{
				$categoria = new Categoria;
				$this->render('formNovaCategoria', array('categoria'=>$categoria, 'legend'=>'Nova Categoria'));
			}
	}
	
	public function actionListar()
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition("t.IndicadorExclusao = 'N'");
		$criteria->addCondition("t.CodPessoa = " . Yii::app()->user->CodPessoa);
		
		$categorias = Categoria::model()->findAll($criteria);
		$categoria = new Categoria;
		$arrayCategorias=new CArrayDataProvider($categorias, array(
			'keyField'=>'CodCategoria',
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
		
		$this->render('listarCategorias', array('categoria'=>$categoria, 'arr'=>$arrayCategorias));
	}
	
	public function actionExcluir()
	{
		if (isset($_GET['CodCategoria']))
		{
			$categoria = Categoria::model()->findByPk($_GET['CodCategoria']);
			$categoria->IndicadorExclusao = 'S';
			$categoria->save();
			Yii::app()->user->setFlash('success', "Categoria excluída com sucesso!");	
		}
		else
			Yii::app()->user->setFlash('error', "Não foi possível encontrar nenhuma categoria!");	
			
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