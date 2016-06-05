<style>
div.form-perfil {
    text-align: center;
}
</style>

<?php
	if ($pessoa->isNewRecord)
		$legend = 'Cadastro';
	else
		$legend = 'Editar Perfil';
?>
<fieldset style="margin-top: -27.5px;">
	<legend><?=$legend;?></legend>
	<div class="form-perfil">
		<?php
			echo CHtml::beginForm(Yii::app()->createAbsoluteUrl("pessoa/meuPerfil"), 'POST', array());
		?>
		<div class="row">
			<div class="column medium-5" style="text-align: right; margin-right: 10px;">
				<?php
					echo CHtml::activeHiddenField($pessoa, 'CodPessoa', array('style'=>'margin-bottom: 8px;'));
					
					echo CHtml::label('Nome*: ', 'label_nome');
					echo CHtml::activeTextField($pessoa, 'NomePessoa', array('required'=>true, 'maxlenght'=>50, 'style'=>'margin-bottom: 8px;'));
					echo "<br />";
										
					echo CHtml::label('CPF*: ', 'label_cpf');
					echo CHtml::activeTextField($pessoa, 'CPFPessoa', array('required'=>true, 'maxlenght'=>14, 'style'=>'margin-bottom: 8px;'));
					echo "<br />";
					
					echo CHtml::label('Gênero*: ', 'label_genero');
					echo CHtml::activeRadioButtonList($pessoa, 'GeneroPessoa', array('F'=>'Feminino', 'M'=>'Masculino '), array('required'=>true, 'separator' => " "));
					echo "<br /><br />";
					
					echo CHtml::label('Email*: ', 'label_email');
					echo CHtml::activeTextField($pessoa, 'EmailPessoa', array('required'=>true, 'style'=>'margin-bottom: 8px;'));
					echo "<br />";
					
					echo CHtml::label('Data de nascimento*: ', '', array());
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name' => 'Pessoa[DataNascimentoPessoa]',
						'value'=>$pessoa->DataNascimentoPessoa,
						'options' => array(
							'showAnim' => 'slideDown',
							'dateFormat'=>'dd/mm/yy',
						),
						
						'language' => 'pt',
						'htmlOptions'=>array('required'=>true),
					));
					echo "<br />";
					
					if ($pessoa->isNewRecord)
					{
						echo CHtml::label('Saldo inicial da conta*: ', 'label_saldo');
						echo CHtml::activeTextField($pessoa, 'SaldoPessoa', array('required'=>true, 'maxlenght'=>15, 'style'=>'margin-bottom: 8px;'));
						echo "<br />";
						echo "<br />";
					}
					
					echo CHtml::label('Escolaridade*: ', 'label_escolaridade');
					echo CHtml::activeDropDownList($pessoa, 'CodEscolaridade', $arrEscolaridade, array('empty'=>'Selecione uma escolaridade...', 'required'=>true, 'style'=>'margin-bottom: 8px;width: 173px; margin-top: 10px; margin-right: -9px;'));
					echo "<br />";
					
					echo CHtml::label('Telefone*: ', 'label_telefone');
					echo CHtml::activeTextField($pessoa, 'TelefonePessoa', array('required'=>true, 'maxlenght'=>13, 'style'=>'margin-bottom: 8px;'));
					echo "<br />";
					
					
					echo CHtml::label($pessoa->isNewRecord ? 'Senha*: ' : 'Nova senha: ', 'label_senha');
					echo CHtml::passwordField('Pessoa[NovaSenha]', '', array('required'=>($pessoa->isNewRecord ? true : false), 'maxlenght'=>12, 'style'=>'margin-bottom: 8px;'));
					echo "<br />";
					
					echo CHtml::label('Confirmar senha*: ', 'label_senha2');
					echo CHtml::passwordField('Pessoa[SenhaRepetida]', '', array('required'=> ($pessoa->isNewRecord ? true : false), 'maxlenght'=>12, 'style'=>'margin-bottom: 8px;'));
				?>
			</div>
			<div class="column medium-4" style="text-align: right; margin-right: 10px;">
				<?php	
					$this->renderPartial('formEndereco', array('endereco'=>$endereco, 'arrEstado'=>$arrEstado));
					
					
				?>
			</div>
			<div class="column medium-3"></div>
		</div>
		<?php
			echo "<br />";
			echo CHtml::submitButton(!Yii::app()->user->isGuest ? 'Atualizar Cadastro' : 'Abrir uma conta', array('class' => 'btn',));
		?>
	</div>
</fieldset>
<script>
	// MÁSCARAS
	$('#Pessoa_DataNascimentoPessoa').mask('00/00/0000');
	$('#Pessoa_CPFPessoa').mask('000.000.000-00');
	$('#Pessoa_TelefonePessoa').mask('(00) 0000-0000');
	$('#Pessoa_SaldoPessoa').maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', hundreds:'.', decimal:',', affixesStay: false});
</script>