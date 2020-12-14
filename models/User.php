<?php

namespace app\models;

//class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
class User extends \yii\db\activeRecord implements \yii\web\IdentityInterface
{
    public $id_user;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $role;
    public $foto; 
    public $pendidikan; 
    public $minat ;
    public $pekerjaan ;
    public $alamat ;
    public $usia ;
    public $tipe_user ;
    public $nama ;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id_user)
    {
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        $user = TblUsers::findOne($id_user);
        if($user){
            return new static($user);
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user = TblUsers::find()->where(['username'=>$username])->one();
        if($user!=null){
            return new static($user);
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id_user;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
