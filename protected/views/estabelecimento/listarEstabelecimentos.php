<fieldset><legend>Estabelecimentos</legend>
	<div id='divForm'>
		<?php
			/*//FORMULÁRIO
			echo "<br>" . CHtml::beginForm(Yii::app()->createAbsoluteUrl("estabelecimento/cadastrar"), 'POST');
			echo CHtml::activeHiddenField($estabelecimento, 'CodEstabelecimento');
			echo CHtml::label('Nome do estabelecimento: ', 'nome');
			echo CHtml::activeTextField($estabelecimento, 'NomeEstabelecimento');
			echo "<br /><br />";
	
			echo CHtml::submitButton('Enviar');
			echo CHtml::endForm() ;
			//FIM DO FORM*/
		?>
	</div>
	<?php
		$this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$arr,
			'columns'=>array(
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
						'update' => array(
							'url' => 'Yii::app()->createUrl("estabelecimento/cadastrar", array(
								"CodEstabelecimento"=>$data->CodEstabelecimento,
							))',
							/*'click'=>"function(event){
								$.ajax({
									method:'POST',
									url:$(this).attr('href'),
									success:function(data) {
										$('#divForm').html(data);
									}
								});
								
								event.preventDefault();
							 }",*/
						),
						'delete'=>array(
							'url'=>'Yii::app()->createUrl("estabelecimento/excluir", array("CodEstabelecimento"=>$data->CodEstabelecimento))',
						),
					),
				),
			),
		));
	?>
</fieldset>