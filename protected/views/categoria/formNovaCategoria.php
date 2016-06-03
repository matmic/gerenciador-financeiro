<fieldset><legend><?=$legend?></legend>
	<div style="width: 58%; text-align: right;">
		<?php
			echo CHtml::beginForm(Yii::app()->createAbsoluteUrl("categoria/cadastrar"), 'POST');
			echo CHtml::activeHiddenField($categoria, 'CodCategoria');
			echo CHtml::label('Nome do categoria: ', 'nome');
			echo CHtml::activeTextField($categoria, 'NomeCategoria', array('required'=>true));
			echo "<br /><br />";

			echo CHtml::submitButton('Enviar', array('style'=>'margin-left: 50%'));
			echo CHtml::endForm() ;
		?>
	</div>
</fieldset>