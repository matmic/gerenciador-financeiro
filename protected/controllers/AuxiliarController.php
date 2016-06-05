<?php

class AuxiliarController extends BaseController
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
	
	public function actionAutoCompleteCategoria($term) 
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'UPPER(NomeCategoria) LIKE UPPER(:termo)';
		$criteria->addCondition('t.CodPessoa = ' . Yii::app()->user->CodPessoa);
		$criteria->addCondition("t.IndicadorExclusao = 'N'");
		$criteria->params = array(':termo' => '%'.utf8_decode($term).'%');
		$criteria->order = 'NomeCategoria ASC';
		$criteria->limit = 10;
		$results = array();
		foreach(Categoria::model()->findAll($criteria) as $cat)
		{
		  $results[] = array(
			  'label' => $cat->NomeCategoria,
			  'CodCategoria' => $cat->CodCategoria,
		  );
		}
		echo CJSON::encode($results);
		Yii::app()->end();
  }
  
	public function actionAutoCompleteEstabelecimento($term) 
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'UPPER(NomeEstabelecimento) LIKE UPPER(:termo)';
		$criteria->addCondition('t.CodPessoa = ' . Yii::app()->user->CodPessoa);
		$criteria->addCondition("t.IndicadorExclusao = 'N'");
		$criteria->params = array(':termo' => '%'.utf8_decode($term).'%');
		$criteria->order = 'NomeEstabelecimento ASC';
		$criteria->limit = 10;
		$results = array();
		foreach(Estabelecimento::model()->findAll($criteria) as $est)
		{
		  $results[] = array(
			  'label' => $est->NomeEstabelecimento,
			  'CodEstabelecimento' => $est->CodEstabelecimento,
		  );
		}
		echo CJSON::encode($results);
		Yii::app()->end();
	}
}
?>