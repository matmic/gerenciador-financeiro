<?php

/**
 * This is the model class for table "pessoa".
 *
 * The followings are the available columns in table 'pessoa':
 * @property integer $CodPessoa
 * @property string $NomePessoa
 * @property string $CPFPessoa
 * @property string $EmailPessoa
 * @property string $GeneroPessoa
 * @property integer $CodEndereco
 * @property string $TelefonePessoa
 * @property string $DataNascimentoPessoa
 * @property string $SenhaPessoa
 * @property string $SaldoPessoa
 * @property string $IndicadorExclusao
 */
class Pessoa extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pessoa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NomePessoa, CPFPessoa, EmailPessoa, GeneroPessoa, CodEndereco, TelefonePessoa, DataNascimentoPessoa, SenhaPessoa, SaldoPessoa, IndicadorExclusao', 'required'),
			array('CodEndereco, CodEscolaridade', 'numerical', 'integerOnly'=>true),
			array('NomePessoa, EmailPessoa', 'length', 'max'=>20),
			array('CPFPessoa', 'length', 'max'=>11),
			array('GeneroPessoa, IndicadorExclusao', 'length', 'max'=>1),
			array('TelefonePessoa', 'length', 'max'=>13),
			array('SenhaPessoa', 'length', 'max'=>32),
			array('SaldoPessoa', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodPessoa, NomePessoa, CPFPessoa, EmailPessoa, GeneroPessoa, CodEndereco, CodEscolaridade, TelefonePessoa, DataNascimentoPessoa, SenhaPessoa, SaldoPessoa, IndicadorExclusao', 'safe', 'on'=>'search'),
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
			'Endereco' => array(self::HAS_ONE, 'Endereco', array('CodEndereco'=>'CodEnderecoPessoa')),
			'Escolaridade'=>array(self::HAS_ONE, 'Escolaridade', array('CodEscolaridade'=>'CodEscolaridadeEscolaridade')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CodPessoa' => 'Cod Pessoa',
			'NomePessoa' => 'Nome Pessoa',
			'CPFPessoa' => 'Cpfpessoa',
			'EmailPessoa' => 'Email Pessoa',
			'GeneroPessoa' => 'Genero Pessoa',
			'CodEndereco' => 'Cod Endereco',
			'TelefonePessoa' => 'Telefone Pessoa',
			'DataNascimentoPessoa' => 'Data Nascimento Pessoa',
			'SenhaPessoa' => 'Senha Pessoa',
			'SaldoPessoa' => 'Saldo Pessoa',
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

		$criteria->compare('CodPessoa',$this->CodPessoa);
		$criteria->compare('NomePessoa',$this->NomePessoa,true);
		$criteria->compare('CPFPessoa',$this->CPFPessoa,true);
		$criteria->compare('EmailPessoa',$this->EmailPessoa,true);
		$criteria->compare('GeneroPessoa',$this->GeneroPessoa,true);
		$criteria->compare('CodEndereco',$this->CodEndereco);
		$criteria->compare('TelefonePessoa',$this->TelefonePessoa,true);
		$criteria->compare('DataNascimentoPessoa',$this->DataNascimentoPessoa,true);
		$criteria->compare('SenhaPessoa',$this->SenhaPessoa,true);
		$criteria->compare('SaldoPessoa',$this->SaldoPessoa,true);
		$criteria->compare('IndicadorExclusao',$this->IndicadorExclusao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pessoa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
