<?php
	echo CHtml::activeHiddenField($endereco, 'CodEndereco', array('style'=>'margin-bottom: 8px;'));
	echo "<br />";

	echo CHtml::label('Endereço: ', 'label_endereco');
	echo CHtml::activeTextField($endereco, 'Logradouro', array('required'=>true, 'maxlenght'=>50, 'style'=>'margin-bottom: 8px; margin-top: 5px;'));
	echo "<br />";

	echo CHtml::label('Número: ', 'label_numero');
	echo CHtml::activeTextField($endereco, 'Numero', array('maxlenght'=>5, 'style'=>'margin-bottom: 8px;'));
	echo "<br />";

	echo CHtml::label('Complemento: ', 'label_complemento');
	echo CHtml::activeTextField($endereco, 'Complemento', array('maxlenght'=>5, 'style'=>'margin-bottom: 8px;'));
	echo "<br />";

	echo CHtml::label('Bairro: ', 'label_bairro');
	echo CHtml::activeTextField($endereco, 'Bairro', array('required'=>true, 'maxlenght'=>20, 'style'=>'margin-bottom: 8px;'));
	echo "<br />";

	echo CHtml::label('CEP: ', 'label_cep');
	echo CHtml::activeTextField($endereco, 'CEP', array('required'=>true, 'maxlenght'=>9, 'style'=>'margin-bottom: 8px;'));
	echo "<br />";

	echo CHtml::label('Cidade: ', 'label_cidade');
	echo CHtml::activeTextField($endereco, 'Cidade', array('required'=>true, 'maxlenght'=>30, 'style'=>'margin-bottom: 8px;'));
	echo "<br />";

	echo CHtml::label('Estado: ', 'label_estado');
	echo CHtml::activeDropDownList($endereco, 'CodEstado', $arrEstado, array('empty'=>'Selecione um estado...', 'required'=>true, 'style'=>'margin-bottom: 8px;width: 173px; margin-top: 10px;'));
	echo "<br />";
?>