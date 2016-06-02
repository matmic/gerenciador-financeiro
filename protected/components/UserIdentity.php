<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$pessoa = Pessoa::model()->findByAttributes(array('CPFPessoa'=>$this->username));
		if($pessoa === null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else 
			if($pessoa->SenhaPessoa!==md5($this->password))
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->setState('CodPessoa', $pessoa->CodPessoa);
			$this->setState('NomePessoa', $pessoa->NomePessoa);
			
			if ($pessoa->IndicadorProfessor == 'S')
				$this->setState('IndicadorProfessor', $pessoa->IndicadorProfessor);
			else
				if ($pessoa->IndicadorFuncionario == 'S')
					$this->setState('IndicadorFuncionario', $pessoa->IndicadorFuncionario);
				else
					$this->setState('IndicadorAluno', 'S');
			
			$this->setState('SaldoPessoa', $pessoa->SaldoPessoa);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
}