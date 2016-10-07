<?php
namespace backend\modules\profile\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class PasswordForm extends Model
{
	
    public $password;
    public $new_password;
    public $password_repeat;

	private $_user = false;
	  
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
			['password', 'validatePassword'],
			
			['new_password', 'required'],
            ['new_password', 'string', 'min' => 6],
			
			['password_repeat','required'],
			['password_repeat', 'compare', 'compareAttribute' => 'new_password'],
        ];
    }
	
	/**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {			
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
				$this->addError($attribute, 'Password Yang Anda Masukkan Salah.');
            }
        }
    }
	
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password' => 'Password',
            'new_password' => 'Password Baru',
            'password_repeat' => 'Ulangi Password',
        ];
    }
	

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
	public function chagepassword()
    {
        if ($this->validate()) {
            $user = new User();
            //$user->username = trim(strip_tags($this->username));
            //$user->firstname = trim(strip_tags($this->firstname));
            //$user->lastname = trim(strip_tags($this->lastname));
            //$user->email = trim(strip_tags($this->email));
            $user->setPassword($this->password);
            //$user->generateAuthKey();
            if ($user->save()) {
			
            }
        }

        return null;
    }
	
	/**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
		if ($this->validate()) {
			$user = $this->_user;
			$user->setPassword($this->new_password);
			$user->removePasswordResetToken();

			return $user->save();
		}
		
		return null;
    }
	
	/**
     * Finds user by [[userid]]
     *
     * @return User|null
     */
    public function getUser()
    {
        $this->_user = User::findOne(Yii::$app->user->identity->id);
        return $this->_user;
    } 
}
