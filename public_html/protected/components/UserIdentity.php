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
            $usuario = Usuarios::model()->find('usuario = ? ', array($this->username));
            
            if($usuario === null){
               $this->errorCode=self::ERROR_USERNAME_INVALID;
            }
            else if(md5($this->password) != $usuario->clave) //La contraseña se codifica mediante el protocolo md5
            {
               $this->errorCode=self::ERROR_PASSWORD_INVALID; 
            }
            else{
               $this->errorCode=self::ERROR_NONE;
               $session = new CHttpSession;
               $session->open(); //session_start
               $session['usuario'] = $usuario;
               
               $usuario->fechaUltimoIngreso = Yii::app()->dateFormatter->format('yyyy-MM-dd hh:mm:ss',time());
               $usuario->save();
            }
            
	  return !$this->errorCode;
	}
}