<?php

class OrcamentoController extends BaseController
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
	
	public function actionCadastrar()
	{
		if (isset($_GET['CodOrcamento']))
		{
			$orcamento = Orcamento::model()->findByPk($_GET['CodOrcamento']);
			$this->render('formNovoOrcamento', array('orcamento'=>$orcamento, 'legend'=>'Editar'));
		}
		else
			if (isset($_POST['Orcamento']))
			{
				if (empty($_POST['Orcamento']['CodOrcamento']))
					$orcamento = new orcamento;
				else
					$orcamento = Orcamento::model()->findByPk($_POST['Orcamento']['CodOrcamento']);
				
				$newIndicadorPago = $_POST['Orcamento']['IndicadorPago'];
				$newValorOrcamento = $_POST['Orcamento']['ValorOrcamento'];
				if (!$orcamento->isNewRecord)
				{
					$oldIndicadorPago = $orcamento->IndicadorPago;
					$oldValorOrcamento = $orcamento->ValorOrcamento;
				}
				
				
				$orcamento->attributes = $_POST['Orcamento'];
				$orcamento->IndicadorExclusao = 'N';
				$orcamento->CodPessoa = Yii::app()->user->CodPessoa;
				
				$pessoa = Pessoa::model()->findByPk(Yii::app()->user->CodPessoa);
				
				// SE NÃO FOR UM NOVO REGISTRO
				if (!$orcamento->isNewRecord)
				{
					// SE FOR RECEITA
					if ($orcamento->CodTipoOrcamento == '1')
					{
						if ($newIndicadorPago != $oldIndicadorPago)
						{
							if ($newIndicadorPago == '0')
								$pessoa->SaldoPessoa -= $oldValorOrcamento;
							else
								$pessoa->SaldoPessoa += $orcamento->ValorOrcamento;
						}
						else
						{
							if ($newIndicadorPago == '1')
							{
								if ($oldValorOrcamento != $newValorOrcamento)
								{
									$pessoa->SaldoPessoa -= $oldValorOrcamento;
									$pessoa->SaldoPessoa += $newValorOrcamento;
								}
							}
						}
					}
					else
					{
						if ($newIndicadorPago != $oldIndicadorPago)
						{
							if ($newIndicadorPago == '0')
									$pessoa->SaldoPessoa += $oldValorOrcamento;
							else
								$pessoa->SaldoPessoa -= $orcamento->ValorOrcamento;
						}
						else
						{
							if ($newIndicadorPago == '1')
							{
								if ($oldValorOrcamento != $newValorOrcamento)
								{
									$pessoa->SaldoPessoa += $oldValorOrcamento;
									$pessoa->SaldoPessoa -= $orcamento->ValorOrcamento;
								}
							}
						}
					}
				}
				else
				{
					if ($orcamento->CodTipoOrcamento == '1')
					{
						if ($newIndicadorPago == '1')
							$pessoa->SaldoPessoa += $orcamento->ValorOrcamento;
					}
					else
					{
						if ($newIndicadorPago == '1')
							$pessoa->SaldoPessoa -= $orcamento->ValorOrcamento;
					}
				}
				
				Yii::app()->user->setState('SaldoPessoa', $pessoa->SaldoPessoa);
				
				$pessoa->save();
				
				if (empty($_POST['Orcamento']['CodCategoria']) && !empty($_POST['Orcamento']['NomeCategoria']))
				{
					$cat = new Categoria;
					$cat->NomeCategoria = $_POST['Orcamento']['NomeCategoria'];
					$cat->IndicadorExclusao = 'N';
					$cat->CodPessoa = Yii::app()->user->CodPessoa;
					$cat->save();
					$orcamento->CodCategoria = $cat->CodCategoria;
				}
				
				if (empty($_POST['Orcamento']['CodEstabelecimento']) && !empty($_POST['Orcamento']['NomeEstabelecimento']))
				{
					$est = new Estabelecimento;
					$est->NomeEstabelecimento = $_POST['Orcamento']['NomeEstabelecimento'];
					$est->IndicadorExclusao = 'N';
					$est->CodPessoa = Yii::app()->user->CodPessoa;
					$est->save();
					$orcamento->CodEstabelecimento = $est->CodEstabelecimento;
				}
				
				$msg = '';
				if ($orcamento->CodTipoOrcamento == '1')
					$msg .= 'Receita';
				else
					$msg .= 'Despesa';
				
				if($orcamento->save())
				{	//CVarDumper::dump($orcamento->getErrors(), 10, true);die;
					Yii::app()->user->setFlash('success', $msg . " salva com sucesso!");
				}
				else
					Yii::app()->user->setFlash('error', "Não foi possível salvar a " . $msg);
				
				if ($orcamento->CodTipoOrcamento == '1')
					$tipo = '1';
				else
					$tipo = '2';
				
				$this->redirect('listar?tipo=' . $tipo);
			}
			else
			{
				$orcamento = new Orcamento;
				
				if($_GET['tipo'] == 1)
				{
					$orcamento->CodTipoOrcamento = '1';
					$legend = 'Nova Receita';
				}
				else
				{
					$orcamento->CodTipoOrcamento = '2';
					$legend = 'Nova Despesa';
				}
				
				$this->render('formNovoOrcamento', array('orcamento'=>$orcamento, 'legend'=>$legend));
			}
	}
	
	public function actionListar()
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition("t.IndicadorExclusao = 'N'");
		$criteria->addCondition("t.CodPessoa = " . Yii::app()->user->CodPessoa);
		if ($_GET['tipo'] == 1)
		{
			$criteria->addCondition("t.CodTipoOrcamento = 1");
			$legend = 'Receitas';
			$header = 'Recebido de';
		}
		else
		{
			$criteria->addCondition("t.CodTipoOrcamento = 2");
			$legend = 'Despesas';
			$header = 'Pago a';
		}
		$criteria->order = 't.DataOrcamento DESC';
		
		$sort = new CSort();
        // One attribute for each column of data
        $sort->attributes = array(
			'DataOrcamento',
			'ValorOrcamento',
			'IndicadorPago',
			'NomeEstabelecimento'=>array(
				'asc'=>'Estabelecimento.NomeEstabelecimento',
				'desc'=>'Estabelecimento.NomeEstabelecimento DESC',
			),
			'NomeCategoria'=>array(
				'asc'=>'Categoria.NomeCategoria',
				'desc'=>'Categoria.NomeCategoria DESC',
			),
        );
		
		$params = array();
		$params['DataInicio'] = '';
		$params['DataFim'] = '';
		$params['CodEstabelecimento'] = '';
		$params['NomeEstabelecimento'] = '';
		$params['CodCategoria'] = '';
		$params['NomeCategoria'] = '';
		$params['IndicadorPago'] = '';
		
		if (isset($_POST['Filtro']))
		{
			
			//CVarDumper::dump($_POST['Filtro'], 10, true);die;
			Yii::app()->user->setFlash('success', 'Filtro(s) aplicado(s) com sucesso!');
			if (!empty($_POST['Filtro']['CodCategoria']))
			{
				$criteria->addCondition("t.CodCategoria = " . $_POST['Filtro']['CodCategoria']);
				$params['CodCategoria'] = $_POST['Filtro']['CodCategoria'];
				$params['NomeCategoria'] = $_POST['Filtro']['NomeCategoria'];
			}
			
			if (!empty($_POST['Filtro']['CodEstabelecimento']))
			{
				$criteria->addCondition("t.CodEstabelecimento = " . $_POST['Filtro']['CodEstabelecimento']);
				$params['CodEstabelecimento'] = $_POST['Filtro']['CodEstabelecimento'];
				$params['NomeEstabelecimento'] = $_POST['Filtro']['NomeEstabelecimento'];
			}
			
			if (!empty($_POST['Filtro']['DataInicio']))
			{
				$partesData = explode('/', $_POST['Filtro']['DataInicio']);
				$dataInicio = $partesData[2]."-".$partesData[1]."-".$partesData[0];
				$partesData = explode('/', $_POST['Filtro']['DataFim']);
				$dataFim = $partesData[2]."-".$partesData[1]."-".$partesData[0];
				$criteria->addCondition("t.DataOrcamento >= '" . $dataInicio . "' AND t.DataOrcamento <= '" . $dataFim . "'");
				$params['DataInicio'] = $_POST['Filtro']['DataInicio'];
				$params['DataFim'] = $_POST['Filtro']['DataFim'];
			}
			
			if (!empty($_POST['Filtro']['IndicadorPago']))
			{
				if ($_POST['Filtro']['IndicadorPago'] == '1')
				{
					$criteria->addCondition("t.IndicadorPago = 1");
					$params['IndicadorPago'] = 1;
				}
				else
					if ($_POST['Filtro']['IndicadorPago'] == '2')
					{
						$criteria->addCondition("t.IndicadorPago = 0");
						$params['IndicadorPago'] = 2;
					}
					else
						$params['IndicadorPago'] = 3;
			}
		}
		
		$orcamentos = Orcamento::model()->with(array('Estabelecimento', 'Categoria'))->findAll($criteria);
		$arrayOrcamentos=new CArrayDataProvider($orcamentos, array(
			'keyField'=>'CodCategoria',
			'pagination'=>array(
				'pageSize'=>10,
			),
			'sort'=>$sort,
		));
		
		$this->render('listarOrcamentos', array('arr'=>$arrayOrcamentos, 'legend'=>$legend, 'header'=>$header, 'params'=>$params));
	}
	
	public function actionExcluir()
	{
		if (isset($_GET['CodOrcamento']))
		{
			$orc = Orcamento::model()->findByPk($_GET['CodOrcamento']);
			$orc->IndicadorExclusao = 'S';
			$orc->save();
			
			$pessoa = Pessoa::model()->findByPk(Yii::app()->user->CodPessoa);
			
			$msg = '';
			
			if ($orc->CodTipoOrcamento == '1')
			{
				if ($orc->IndicadorPago == '1')
					$pessoa->SaldoPessoa -= $orc->ValorOrcamento;

				$msg .= 'Receita';
				$tipo = '1';
			}
			else
			{
				if ($orc->IndicadorPago == '1')
					$pessoa->SaldoPessoa += $orc->ValorOrcamento;

				$msg .= 'Despesa';
				$tipo = '2';
			}
			
			Yii::app()->user->setState('SaldoPessoa', $pessoa->SaldoPessoa);
			$pessoa->save();
			
			Yii::app()->user->setFlash('success', $msg . " excluída com sucesso!");	
		}
		else
			Yii::app()->user->setFlash('error', "Não foi possível encontrar nenhuma " . $msg . "!");	
			
		$this->redirect('listar?tipo=' . $tipo);
	}
	
	public function actionGrafico()
	{
		if (isset($_POST['Grafico']))
		{
			$tipo = $_POST['Grafico']['CodTipoOrcamento'];	
			$criteria = new CDbCriteria;
			$criteria->addCondition("t.CodPessoa = " . Yii::app()->user->CodPessoa);
			$criteria->addCondition("t.IndicadorExclusao = 'N'");
			
			if ($_POST['Grafico']['IndicadorPago'] == '1')
				$criteria->addCondition("t.IndicadorPago = '1'");
			
			$criteria->addCondition("t.CodTipoOrcamento = " . $tipo);
			
			$partesData = explode('/', $_POST['Grafico']['DataInicio']);
			$dataInicio = $partesData[2]."-".$partesData[1]."-".$partesData[0];
			$partesData = explode('/', $_POST['Grafico']['DataFim']);
			$dataFim = $partesData[2]."-".$partesData[1]."-".$partesData[0];
			
			//CVarDumper::dump($dataInicio, 10, true);die;
			$criteria->addCondition("t.DataOrcamento >= '" . $dataInicio . "' AND t.DataOrcamento <= '" . $dataFim . "'");
			
			
			$orcamentos = Orcamento::model()->with(array('Categoria'))->findAll($criteria);
			
			$arrayTmp = array();
			$arrayCategorias = array();
			foreach ($orcamentos as $arr)
			{
				if ($arr->Categoria == NULL)
					$arrayTmp['Sem Categoria'][] = $arr->ValorOrcamento;
				else
					$arrayTmp[$arr->Categoria->NomeCategoria][] = $arr->ValorOrcamento;
			}
			
			foreach ($arrayTmp as $key => $value)
				$arrayCategorias[] = array($key, array_sum($value));
				
				$this->render('grafico', array('arr'=>$arrayCategorias));
		}
		else
		{
			if ($_GET['tipo'] == '1')
				$str = 'receitas';
			else
				$str = 'despesas';
			
			$this->render('formGrafico', array('tipo'=>$_GET['tipo'], 'str'=>$str));
		}
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