<fieldset><legend>Estabelecimentos</legend>
	<div align='center'>
		<?php
			//FORMULÁRIO
			echo CHtml::beginForm(Yii::app()->createAbsoluteUrl("disciplina/salvarDisciplina"), 'POST', array());
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
			echo CHtml::endForm();
			//FIM DO FORM
		?>
	</div>
	<?php	
		$this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$arr,
			'columns'=>array(
				array(
					'name'=>'CodEstabelecimento',
					'header'=>'Código',
				),
				array(
					'name'=>'NomeEstabelecimento',
					'header'=>'Nome do Estabelecimento',
				),
				array
				(
					'header'=>'Operações',
					'class'=>'CButtonColumn',
					'template'=>'{update}{delete}',
					'buttons'=>array(
						'update'=>array(
							'url'=>'$data->CodEstabelecimento',
							'options'=> array(
								'onclick'=>'js:preencherCampos($(this).attr("href"));return false;',
							),
						),
						'delete'=>array(
							'url'=>'Yii::app()->createUrl("disciplina/deletarDisciplina", array("CodEstabelecimento"=>$data->CodEstabelecimento))',
						),
					),
				),
			),
		));
	?>
</fieldset>
<script>
	function preencherCampos(Cod)
	{
		alert(Cod);
	}
</script>