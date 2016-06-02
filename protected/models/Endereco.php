<?php

/**
 * This is the model class for table "endereco".
 *
 * The followings are the available columns in table 'endereco':
 * @property integer $CodEndereco
 * @property string $Logradouro
 * @property integer $Numero
 * @property string $Complemento
 * @property string $Bairro
 * @property string $CEP
 * @property string $Cidade
 * @property integer $CodEstado
 * @property string $IndicadorExclusao
 */
class Endereco extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'endereco';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Logradouro, Bairro, CEP, Cidade, CodEstado, IndicadorExclusao', 'required'),
			array('Numero, CodEstado', 'numerical', 'integerOnly'=>true),
			array('Logradouro', 'length', 'max'=>50),
			array('Complemento', 'length', 'max'=>20),
			array('Bairro, Cidade', 'length', 'max'=>30),
			array('CEP', 'length', 'max'=>9),
			array('IndicadorExclusao', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodEndereco, Logradouro, Numero, Complemento, Bairro, CEP, Cidade, CodEstado, IndicadorExclusao', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CodEndereco' => 'Cod Endereco',
			'Logradouro' => 'Logradouro',
			'Numero' => 'Numero',
			'Complemento' => 'Complemento',
			'Bairro' => 'Bairro',
			'CEP' => 'Cep',
			'Cidade' => 'Cidade',
			'CodEstado' => 'Cod Estado',
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

		$criteria->compare('CodEndereco',$this->CodEndereco);
		$criteria->compare('Logradouro',$this->Logradouro,true);
		$criteria->compare('Numero',$this->Numero);
		$criteria->compare('Complemento',$this->Complemento,true);
		$criteria->compare('Bairro',$this->Bairro,true);
		$criteria->compare('CEP',$this->CEP,true);
		$criteria->compare('Cidade',$this->Cidade,true);
		$criteria->compare('CodEstado',$this->CodEstado);
		$criteria->compare('IndicadorExclusao',$this->IndicadorExclusao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Endereco the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
