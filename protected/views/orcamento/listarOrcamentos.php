<fieldset><legend><?=$legend?></legend>
	<!-- 
	<fieldset class="moldura fieldInfo" style="clear:none;"><legend style='font-size:18px;'>Informações</legend>
		<p style='font-size:14px;'>Para editar ou excluir <?=strtolower($legend)?> use os botões da coluna 'Operações'!</p>
	</fieldset>
	-->
	<?php
		$this->renderPartial('filtroOrcamento', array('tipo'=>$_GET['tipo'], 'params'=>$params));
		
		$this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$arr,
			/*'rowCssClassExpression' => '
				( !empty($data["SituacaoEspecial"]) ? " rowEspecial " :  ( $row%2 ? $this->rowCssClass[1] : $this->rowCssClass[0] ) )
			',*/
			'htmlOptions'=>array('style'=>'text-align:center;'),
			'columns'=>array(
				array(
					'name'=>'DataOrcamento',
					'header'=>'Data',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'name'=>'DescricaoOrcamento',
					'header'=>'Descrição',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'name'=>'ValorOrcamento',
					'header'=>'Valor (R$)',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'value'=>'empty($data->Estabelecimento->NomeEstabelecimento) ? "-" : $data->Estabelecimento->NomeEstabelecimento',
					'header'=>$header,
					'name'=>'NomeEstabelecimento',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'value'=>'empty($data->Categoria->NomeCategoria) ? "-" : $data->Categoria->NomeCategoria',
					'header'=>'Categoria',
					'name'=>'NomeCategoria',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'name'=>'IndicadorPago',
					'header'=>'Pago',
					'type'=>'html',
					'value'=>'($data->IndicadorPago == 1) ? CHtml::image(Yii::app()->request->baseUrl . "/img/certo.jpg", "",array("style"=>"width:15px;height:15px;")):CHtml::image(Yii::app()->request->baseUrl . "/img/errado.jpg", "",array("style"=>"width:15px;height:15px;"))',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array
				(
					'header'=>'Operações',
					'class'=>'CButtonColumn',
					'template'=>'{update}{delete}',
					'buttons'=>array(
						'update' => array(
							'url' => 'Yii::app()->createUrl("orcamento/cadastrar", array(
								"CodOrcamento"=>$data->CodOrcamento,
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
							'url'=>'Yii::app()->createUrl("orcamento/excluir", array("CodOrcamento"=>$data->CodOrcamento))',
						),
					),
				),
			),
		));
	?>
</fieldset>