<fieldset><legend>Estabelecimentos</legend>
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
			),
		));
	?>
</fieldset>