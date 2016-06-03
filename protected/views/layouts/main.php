<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/views.css">
	<?php
		$baseUrl = Yii::app()->baseUrl; 
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($baseUrl.'/js/jquery.mask.min.js');
		$cs->registerScriptFile($baseUrl.'/js/jquery.min.js');
	?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php 
		
			/*$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Home', 'url'=>array('/site/index')),
					array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
					array('label'=>'Contact', 'url'=>array('/site/contact')),
					array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
				),
			));	*/

			$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'ADMINISTRAÇÃO', 'items'=>array(
						array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
						array('label'=>'Logout ('. (!isset(Yii::app()->user->NomePessoa) ? '' : Yii::app()->user->NomePessoa).')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>Yii::app()->user->isGuest ? 'Cadastrar' : 'Meu Perfil', 'url'=>array('/pessoa/meuPerfil')),
						),
					),
					array('label'=>'RECEITAS E DESPESAS', 'visible' => !Yii::app()->user->isGuest, 'items'=>array(
						array('label'=>'Cadastrar Receita', 'url'=>array('/pessoa/inserirCredito')),
						array('label'=>'Cadastrar Despesa', 'url'=>array('/pessoa/sacarCredito')),
						),
					),
					array('label'=>'ESTABELECIMENTOS', 'visible' => !Yii::app()->user->isGuest, 'items'=>array(
						array('label'=>'Cadastrar Estabelecimento', 'url'=>array("/estabelecimento/cadastrar")),
						array('label'=>'Editar Estabelecimentos', 'url'=>array("/estabelecimento/listar")),	
						),		
					),
					array('label'=>'CATEGORIAS', 'visible' => !Yii::app()->user->isGuest, 'items'=>array(
						array('label'=>'Cadastrar Categoria', 'url'=>array("/categoria/cadastrar")),
						array('label'=>'Editar Categorias', 'url'=>array("/categoria/listar")),	
						),		
					),
				),
			));
		?>
	</div><!-- mainmenu -->
	<div class='flash'>
	<?php
		$flashMessages = Yii::app()->user->getFlashes();
		if ($flashMessages) {
			echo '<ul class="flashes">';
			foreach($flashMessages as $key => $message) {
				echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
			}
			echo '</ul>';
		}
	?>
	</div>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>
</div><!-- page -->

</body>
</html>
