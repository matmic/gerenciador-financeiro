<fieldset class="moldura" style="background-color: #fff; clear:none; width: 650px"><legend style='font-size:16px;'>Filtrar</legend>
	<?php
		echo CHtml::beginForm(Yii::app()->createAbsoluteUrl("orcamento/listar?tipo=". $tipo), 'POST', array('id'=>'form-filtro'));
		
		echo CHtml::label('Categoria: ', 'cat', array('style'=>'margin-left: 25px;'));
		$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
		  'sourceUrl'=>array('auxiliar/autoCompleteCategoria'),
		  'name'=>'Filtro[NomeCategoria]',
		  'value' => $params['NomeCategoria'],
		  'options'=>array(
			'minLength'=>'0',
			'select'=>"js: function(event, ui) {
				$('#iptCodCategoria').val(ui.item['CodCategoria']);                   
			}"
		  ),
		  'htmlOptions'=>array(
			//'style'=>'width:95.5%; padding-right: 25px;',
			'placeholder'=>'Digite a categoria',
			//'size'=>50,
		  ),
		));
		echo CHtml::hiddenField('Filtro[CodCategoria]', $params['CodCategoria'],array('id'=>'iptCodCategoria'));
		
		echo CHtml::label($_GET['tipo'] == 1 ? 'Recebido de: ' : 'Pago a: ', 'est', array('style'=>'margin-left:30px;'));
		$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
		  'sourceUrl'=>array('auxiliar/autoCompleteEstabelecimento'),
		  'name'=>'Filtro[NomeEstabelecimento]',
		  'value' => $params['NomeEstabelecimento'],
		  'options'=>array(
			'minLength'=>'0',
			'select'=>"js: function(event, ui) {
				$('#iptCodEstabelecimento').val(ui.item['CodEstabelecimento']);                   
			}"
		  ),
		  'htmlOptions'=>array(
			//'style'=>'width:95.5%; padding-right: 25px;',
			'placeholder'=>'Digite o estabelecimento',
			//'size'=>50,
		  ),
		));
		echo CHtml::hiddenField('Filtro[CodEstabelecimento]', $params['CodEstabelecimento'],array('id'=>'iptCodEstabelecimento'));
		echo "<br /><br />";
		echo CHtml::label('Data de início: ', '', array());
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name' => 'Filtro[DataInicio]',
			'value'=>$params['DataInicio'],
			'options' => array(
				'showAnim' => 'slideDown',
				'dateFormat'=>'dd/mm/yy',
			),
			'htmlOptions'=>array(
				'size'=>10,
			),
			'language' => 'pt',
		));

		echo CHtml::label('Data final: ', '', array('style'=>'margin-left: 116px;'));
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name' => 'Filtro[DataFim]',
			'value'=>$params['DataFim'],
			'options' => array(
				'showAnim' => 'slideDown',
				'dateFormat'=>'dd/mm/yy',
			),
			'htmlOptions'=>array(
				'size'=>10,
			),
			'language' => 'pt',
		));
		
		echo "<br /><br />";
		
		if ($_GET['tipo'] == 1)
			$str = 'receitas';
		else
			$str = 'despesas';
		
		echo CHtml::radioButtonList('Filtro[IndicadorPago]', $params['IndicadorPago'], array(
			1=>($_GET['tipo'] == 1 ? 'Somente receitas recebidas' : 'Somente despesas pagas'), 
			2=>($_GET['tipo'] == 1 ? 'Somente receitas a receber' : 'Somente despesas a pagar'),
			3=>'Todas',
		),
		array(
			'style'=>'text-align: center;', 
			'required'=>true, 
			'separator' => "<br />",
		));
		
		echo "<br />";
		echo CHtml::button('Enviar', array('onClick'=>'validar()', 'style'=>'margin-left: 45%;'));
		echo CHtml::endForm();
	?>
</fieldset>
<script>
	$('#Filtro_DataInicio').change(function(){
		if ($(this).val().length === 0)
			$('#Filtro_DataFim').attr('required', false);
		else
			$('#Filtro_DataFim').attr('required', true);
	});
	
	$('#Filtro_DataFim').change(function(){
		if ($(this).val().length === 0)
			$('#Filtro_DataInicio').attr('required', false);
		else
			$('#Filtro_DataInicio').attr('required', true);
	});
	
	$('#Filtro_NomeEstabelecimento').change(function(){
		$('#iptCodEstabelecimento').val('');
	});
	
	$('#Filtro_NomeCategoria').change(function(){
		$('#iptCodCategoria').val('');
	});
	
	function validar()
	{
		var hasError = false;
		if ($('#Filtro_DataInicio').val().length !== 0)
		{
			var DataInicio = $("#Filtro_DataInicio").val();
			var DataFim = $("#Filtro_DataFim").val();

			if (DataInicio > DataFim) {
				alert('A data inicial deve ser anterior ou igual à data final!');
				hasError = true;
			}
		}
		
		if (!hasError)
			$('#form-filtro').submit();
	}
</script>