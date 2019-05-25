<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;
use Yii;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            [['username', 'email', 'password', 'role'], 'string', 'max' => 255],
        ];
    }

    public function setPassword($password)
    {
        $this->password = sha1($password);
    }

    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }
}
