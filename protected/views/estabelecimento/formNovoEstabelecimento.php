<?php
	echo CHtml::beginForm('cadastrarEstabelecimento', 'POST');
	echo CHtml::label('Nome do estabelecimento: ', false);
	echo CHtml::textField('Estabelecimento[NomeEstabelecimento]', '');
	echo "<br />";
	echo CHtml::label('Categoria: ', false);
	
	$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
		'name'=>'Estabelecimento[NomeCategoria]',
		'source'=>array('site/autoCompleteCategoria'),
		'options'=>array(
			'minLength'=>'3',
		),
	));
	echo "<br />";
	echo CHtml::submitButton('Enviar');
	echo CHtml::endForm() ;
?>