<style>
div.form-login {
    text-align: center;
}
</style>

<fieldset>
	<legend>Login</legend>
	<div class="form-login">
		<?php
			echo CHtml::beginForm(Yii::app()->createAbsoluteUrl("site/novoLogin"), 'POST', array());
			?>
			<div class="row">
			<div class="column medium-7" style="text-align: end;">
			<?php
				echo CHtml::label('CPF: ', 'label_cpf');
				echo CHtml::textField('Pessoa[CPF]', '', array('maxlength'=>11, 'style'=>'margin-bottom: 8px;'));
				echo "<br />";
				
				echo CHtml::label('Senha: ', 'label_senha');
				echo CHtml::passwordField('Pessoa[Senha]', '', array('maxlength'=>14));
				echo "<br /><br />";
			?>
			</div>
			<div class="column medium-5"></div>
			</div>
			<?php
			
			echo CHtml::submitButton('Enviar', array('class' => 'btn',));
		?>
	</div>
</fieldset>