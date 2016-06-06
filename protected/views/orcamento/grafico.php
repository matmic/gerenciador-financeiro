<fieldset><legend>Gráfico</legend>
<?php
	$this->Widget('ext.highcharts.HighchartsWidget', array(
		'options' => array(
		  'colors'=>array('#5cbae6', '#b6d957', '#fac364', '#8cd3ff', '#d998cb', '#f2d249', '#93b9c6', '#ccc5a8', '#52bacc', '#dbdb46', '#98aafb'),
		  'gradient' => array('enabled'=> false),
		  'credits' => array('enabled' => false),
		  'exporting' => array('enabled' => false),
		  'chart' => array(
			'plotBackgroundColor' => '#F7F7F7',
			'plotBorderWidth' => null,
			'plotShadow' => false,
			'height' => 400,
		  ),
		  'title' => false,
		  'tooltip' => array(
			// 'pointFormat' => '{series.name}: <b>{point.percentage.1f}%</b>',
			// 'percentageDecimals' => 1,
			//'formatter'=> 'js:function() { return this.point.name+":  <b>"+Math.round(this.point.percentage)+"</b>%"; }',
			'formatter'=> 'js:function() { return this.point.name+":  <b> R$: "+this.point.y+",00</b>"; }',
				//the reason it didnt work before was because you need to use javascript functions to round and refrence the JSON as this.<array>.<index> ~jeffrey
		  ),
		  'plotOptions' => array(
			'pie' => array(
			  'allowPointSelect' => true,
			  'cursor' => 'pointer',
			  'dataLabels' => array(
				'enabled' => true,
				'connectorColor' => '#AAAAAA',
				'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
			  ),
			  'showInLegend'=>true,
			)
		  ),
		  'series' => array(
			array(
			  'type' => 'pie',
			  'name' => 'Gastos-Categoria',
			  'data'=>$arr,
			),
		  ),
		)
	  ));
?>
</fieldset>