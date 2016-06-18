<?php

/**
 * This is the model class for table "orcamento".
 *
 * The followings are the available columns in table 'orcamento':
 * @property integer $CodOrcamento
 * @property integer $CodPessoa
 * @property integer $CodTipoOrcamento
 * @property string $Descricao
 * @property integer $CodCategoria
 * @property integer $CodEstabelecimento
 * @property string $ValorOrcamento
 * @property string $DataOrcamento
 * @property string $IndicadorPago
 * @property string $IndicadorExclusao
 */
class Orcamento extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orcamento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CodPessoa, CodTipoOrcamento, ValorOrcamento, DataOrcamento, IndicadorPago, IndicadorExclusao', 'required'),
			array('CodPessoa, CodTipoOrcamento, CodCategoria, CodEstabelecimento', 'numerical', 'integerOnly'=>true),
			array('DescricaoOrcamento', 'length', 'max'=>50),
			array('ValorOrcamento', 'length', 'max'=>7),
			array('IndicadorPago, IndicadorExclusao', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodOrcamento, CodPessoa, CodTipoOrcamento, DescricaoOrcamento, CodCategoria, CodEstabelecimento, ValorOrcamento, DataOrcamento, IndicadorPago, IndicadorExclusao', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		// BELONGS_TO: UM CAMPO DO MODELO É CHAVE PRIMÁRIA DO OUTRO
		// HAS_ONE: O OUTRO MODELO TEM UMA CHAVE QUE APONTA PARA A CHAVE PRIMÁRIA DESTE
		return array(
			'Categoria' => array(self::BELONGS_TO, 'Categoria', 'CodCategoria', 'on'=>"Categoria.IndicadorExclusao = 'N'"),
			'Estabelecimento' => array(self::BELONGS_TO, 'Estabelecimento', 'CodEstabelecimento', 'on'=>"Estabelecimento.IndicadorExclusao = 'N'"),
			'Pessoa'=> array(self::BELONGS_TO, 'Pessoa', 'CodPessoa'),
		);
	}
	
	public function beforeSave()
	{
		$partesData = explode('/', $this->DataOrcamento);
		$date = $partesData[2]."-".$partesData[1]."-".$partesData[0];
		$this->DataOrcamento = $date;
		
		$this->ValorOrcamento = str_replace(",",".",$this->ValorOrcamento);
		
		return parent::beforeSave();
	}
	
	public function afterFind()
	{
		$partesData = explode('-', $this->DataOrcamento);
		$this->DataOrcamento = $partesData[2]."/".$partesData[1]."/".$partesData[0];
		
		$this->ValorOrcamento = str_replace(".",",",$this->ValorOrcamento);
		
		return parent::afterFind();
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CodOrcamento' => 'Cod Orcamento',
			'CodPessoa' => 'Cod Pessoa',
			'CodTipoOrcamento' => 'Cod Tipo Orcamento',
			'Descricao' => 'Descricao',
			'CodCategoria' => 'Cod Categoria',
			'CodEstabelecimento' => 'Cod Estabelecimento',
			'ValorOrcamento' => 'Valor Orcamento',
			'DataOrcamento' => 'Data Orcamento',
			'IndicadorPago' => 'Indicador Pago',
			'IndicadorExclusao' => 'Indicador Exclusao',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('CodOrcamento',$this->CodOrcamento);
		$criteria->compare('CodPessoa',$this->CodPessoa);
		$criteria->compare('CodTipoOrcamento',$this->CodTipoOrcamento);
		$criteria->compare('Descricao',$this->Descricao,true);
		$criteria->compare('CodCategoria',$this->CodCategoria);
		$criteria->compare('CodEstabelecimento',$this->CodEstabelecimento);
		$criteria->compare('ValorOrcamento',$this->ValorOrcamento,true);
		$criteria->compare('DataOrcamento',$this->DataOrcamento,true);
		$criteria->compare('IndicadorPago',$this->IndicadorPago,true);
		$criteria->compare('IndicadorExclusao',$this->IndicadorExclusao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orcamento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
