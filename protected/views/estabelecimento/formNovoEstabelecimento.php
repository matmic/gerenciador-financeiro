<fieldset>

<div style="width: 58%; text-align: right;">
<?php
	echo "<br>" . CHtml::beginForm('cadastrarEstabelecimento', 'POST');
	echo CHtml::label('Nome do estabelecimento: ', false);
	echo CHtml::textField('Estabelecimento[NomeEstabelecimento]', '');
	echo "<br /><br />";
	echo CHtml::label('Categoria: ', false);
	
	$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
		'name'=>'Estabelecimento[NomeCategoria]',
		'source'=>array('site/autoCompleteCategoria'),
		'options'=>array(
			'minLength'=>'3',
		),
	));
	echo "<br /><br />";
?>
</div>
<?php
	echo CHtml::submitButton('Enviar', array('style'=>'margin-left: 50%'));
	echo CHtml::endForm() ;
?>
</fieldset>