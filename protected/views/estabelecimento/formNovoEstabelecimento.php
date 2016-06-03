<fieldset><legend><?=$legend?></legend>
	<div style="width: 58%; text-align: right;">
		<?php
			echo CHtml::beginForm(Yii::app()->createAbsoluteUrl("estabelecimento/cadastrar"), 'POST');
			echo CHtml::activeHiddenField($estabelecimento, 'CodEstabelecimento');
			echo CHtml::label('Nome do estabelecimento: ', 'nome');
			echo CHtml::activeTextField($estabelecimento, 'NomeEstabelecimento', array('required'=>true));
			echo "<br /><br />";

			echo CHtml::submitButton('Enviar', array('style'=>'margin-left: 50%'));
			echo CHtml::endForm() ;
		?>
	</div>
</fieldset>