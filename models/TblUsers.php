<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id_user
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property string $role
 * @property string $foto
 * @property string $pendidikan
 * @property string $minat
 * @property string $pekerjaan
 * @property string $alamat
 * @property int $usia
 * @property string $tipe_user
 *
 * @property Bookmark[] $bookmarks
 * @property Buku[] $bukus
 * @property ConvertationReplay[] $convertationReplays
 * @property Rekomendasi[] $rekomendasis
 * @property Tes[] $tes
 */
class TblUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $oldfoto;
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'authKey', 'accessToken', 'role', 'nama','pendidikan', 'minat', 'pekerjaan', 'alamat', 'usia' ], 'required'],
            [['alamat'   ], 'string'],
            [['usia'], 'integer'],
            [['username'], 'string', 'max' => 32],
            [['password', 'foto', 'pendidikan', 'minat', 'pekerjaan'], 'string', 'max' => 64],
            [['authKey', 'accessToken', 'nama'], 'string', 'max' => 50],
            [['role'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'role' => 'Role',
            'foto' => 'Foto',
            'nama' => 'Nama',
            'pendidikan' => 'Pendidikan',
            'minat' => 'Minat',
            'pekerjaan' => 'Pekerjaan',
            'alamat' => 'Alamat',
            'usia' => 'Usia', 
        ];
    }

    /**
     * Gets query for [[Bookmarks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookmarks()
    {
        return $this->hasMany(Bookmark::className(), ['id_user' => 'id_user']);
    }

    /**
     * Gets query for [[Bukus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBukus()
    {
        return $this->hasMany(Buku::className(), ['id_user' => 'id_user']);
    }

    /**
     * Gets query for [[ConvertationReplays]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConvertationReplays()
    {
        return $this->hasMany(ConvertationReplay::className(), ['id_user' => 'id_user']);
    }

    /**
     * Gets query for [[Rekomendasis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRekomendasis()
    {
        return $this->hasMany(Rekomendasi::className(), ['id_user' => 'id_user']);
    }

    /**
     * Gets query for [[Tes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTes()
    {
        return $this->hasMany(Tes::className(), ['id_user' => 'id_user']);
    }


    public function afterFind()
	{
		parent::afterFind();

		$this->oldfoto = $this->foto;
		 
    }
    
    public function beforeSave($insert)
    {

        
        if (!parent::beforeSave($insert)) {
            
            return false;
        }
        //$this->id_user=Yii::$app->user->identity->id_user;
        // ...custom code here...
        return true;
    }

    
}
