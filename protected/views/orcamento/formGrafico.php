<fieldset><legend>Relatório</legend>
	<?php
		echo CHtml::beginForm(Yii::app()->createAbsoluteUrl("orcamento/grafico"), 'POST');
		echo CHtml::hiddenField('Grafico[CodTipoOrcamento]', $tipo);
		echo CHtml::label('Data de início: ', '', array());
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name' => 'Grafico[DataInicio]',
			'value'=>'',
			'options' => array(
				'showAnim' => 'slideDown',
				'dateFormat'=>'dd/mm/yy',
			),
			
			'language' => 'pt',
			'htmlOptions'=>array('required'=>true),
		));
		echo "<br /><br />";
		
		echo CHtml::label('Data final: ', '', array());
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name' => 'Grafico[DataFim]',
			'value'=>'',
			'options' => array(
				'showAnim' => 'slideDown',
				'dateFormat'=>'dd/mm/yy',
			),
			
			'language' => 'pt',
			'htmlOptions'=>array('required'=>true),
		));
		echo "<br /><br />";
		
		echo CHtml::radioButtonList('Grafico[IndicadorPago]', '', array(1=>'Somente ' . $str . ' pagas', 2=>'Todas'), array('required'=>true, 'separator' => "<br />"));
		echo "<br /><br />";
		echo CHtml::submitButton('Enviar', array());
		echo CHtml::endForm() ;
	?>
</fieldset>
<script>
	$('#Grafico_DataInicio').mask('00/00/0000');
	$('#Grafico_DataFim').mask('00/00/0000');
</script>