<fieldset><legend>Bem vindo</legend>
	<p>Para cadastrar uma receita, acesse a seguinte <?php echo CHtml::link('página', Yii::app()->createAbsoluteUrl("orcamento/cadastrar?tipo=1")); ?>!</p>
	<p>Para visualizar suas receitas acesse o <?php echo CHtml::link('painel', Yii::app()->createAbsoluteUrl("orcamento/listar?tipo=1")); ?> de receitas!</p>
	<br />
	<p>Para cadastrar uma despesa, acesse a seguinte <?php echo CHtml::link('página', Yii::app()->createAbsoluteUrl("orcamento/cadastrar?tipo=2")); ?>!</p>
	<p>Para visualizar suas receitas acesse o <?php echo CHtml::link('painel', Yii::app()->createAbsoluteUrl("orcamento/listar?tipo=2")); ?> de despesas!</p>
</fieldset>