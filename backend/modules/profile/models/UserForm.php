<?php
namespace backend\modules\profile\models;

use yii\base\Model;
use Yii;
use common\models\User;

/**
 * Signup form
 */
class UserForm extends Model
{
	
    public $username;
    public $email;

	private $_user = false;
	  
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          			
			['username', 'required'],
			['username', 'filter', 'filter' => 'trim'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Username already exist.'],
            //['username', 'validateUniqueUsername'],

			['email','required'],
            ['email', 'filter', 'filter' => 'trim'],
			['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Email already exist.'],
        ];
    }
	
    /* public function validateUniqueUsername($attribute, $params)
    {
        if (!$this->hasErrors()) {          
            $user = $this->getUser();
            if ($this->username !== $user->username && ) {
                $this->addError($attribute, 'username ini sudah digunakan.');
            }
        }
    } */

	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
        ];
    }
	

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
	public function update()
    {
        if ($this->validate()) {
            $user = User::findOne(Yii::$app->user->identity->id);
            $user->username = trim(strip_tags($this->username));
            $user->email = trim(strip_tags($this->email));
            if ($user->save(false)) {
			     return true;
            }
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
