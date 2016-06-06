<fieldset><legend><?=$legend?></legend>
	<div style="width: 58%; text-align: right;">
		<?php
			$data = '';
			echo CHtml::beginForm(Yii::app()->createAbsoluteUrl("orcamento/cadastrar"), 'POST');
			echo CHtml::activeHiddenField($orcamento, 'CodOrcamento');
			echo CHtml::activeHiddenField($orcamento, 'CodTipoOrcamento');
			
			echo CHtml::label('Data: ', '', array());
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name' => 'Orcamento[DataOrcamento]',
					'value'=>$orcamento->DataOrcamento,
					'options' => array(
						'showAnim' => 'slideDown',
						'dateFormat'=>'dd/mm/yy',
					),
					
					'language' => 'pt',
					'htmlOptions'=>array('required'=>true),
				));
			echo "<br /><br />";
			
			echo CHtml::label('Descricao: ', 'descricao');
			echo CHtml::activeTextField($orcamento, 'DescricaoOrcamento', array('required'=>true, 'maxlength'=>50));
			echo "<br /><br />";
			
			echo CHtml::label('Valor: ', 'valor');
			echo CHtml::activeTextField($orcamento, 'ValorOrcamento', array('required'=>true, 'maxlength'=>10));
			echo "<br /><br />";
			
			echo CHtml::label('Categoria: ', 'cat');
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
              'sourceUrl'=>array('auxiliar/autoCompleteCategoria'),
              'name'=>'Orcamento[NomeCategoria]',
              'value' => empty($orcamento->Categoria->NomeCategoria) ? '' : $orcamento->Categoria->NomeCategoria,
              'options'=>array(
                'minLength'=>'0',
                'select'=>"js: function(event, ui) {
                    $('#iptCodCategoria').val(ui.item['CodCategoria']);                   
                }"
              ),
              'htmlOptions'=>array(
                //'style'=>'width:95.5%; padding-right: 25px;',
                'placeholder'=>'Digite a categoria',
              ),
            ));
            echo CHtml::activeHiddenField($orcamento,'CodCategoria',array('id'=>'iptCodCategoria'));
			echo "<br /><br />";
			
			echo CHtml::label($orcamento->CodTipoOrcamento == 1 ? 'Recebido de: ' : 'Pago a: ', 'est');
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
              'sourceUrl'=>array('auxiliar/autoCompleteEstabelecimento'),
              'name'=>'Orcamento[NomeEstabelecimento]',
              'value' => empty($orcamento->Estabelecimento->NomeEstabelecimento) ? '' : $orcamento->Estabelecimento->NomeEstabelecimento,
              'options'=>array(
                'minLength'=>'0',
                'select'=>"js: function(event, ui) {
                    $('#iptCodEstabelecimento').val(ui.item['CodEstabelecimento']);                   
                }"
              ),
              'htmlOptions'=>array(
                //'style'=>'width:95.5%; padding-right: 25px;',
                'placeholder'=>'Digite o estabelecimento',
              ),
            ));
            echo CHtml::activeHiddenField($orcamento,'CodEstabelecimento',array('id'=>'iptCodEstabelecimento'));
			echo "<br /><br />";
			
			echo CHtml::label('Pago: ', 'pago');
			echo CHtml::activeCheckBox($orcamento, 'IndicadorPago');
			echo "<br /><br />";
			
			echo CHtml::submitButton('Enviar', array('style'=>'margin-left: 50%'));
			echo CHtml::endForm() ;
		?>
	</div>
</fieldset>

<script>
	$('#Orcamento_ValorOrcamento').maskMoney({prefix:'R$ ', allowNegative: false, thousands:'', decimal:',', affixesStay: false});
</script>