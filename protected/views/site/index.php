<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>



<fieldset><legend>Bem-vindo ao <?php echo CHtml::encode(Yii::app()->name); ?></legend>
	<p>Para se logar, preencha o seu CPF e senha na página de <?php echo CHtml::link('login', Yii::app()->createAbsoluteUrl("site/login")); ?>!</p>
	<p>Para se cadastrar acesse a <?php echo CHtml::link('página', Yii::app()->createAbsoluteUrl("pessoa/meuPerfil")); ?> de cadastro!</p>
</fieldset>