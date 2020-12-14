<?php

namespace app\models;
use app\models\TblUsers; 
use app\models\TblChapter; 


use Yii;

/**
 * This is the model class for table "{{%bookmark}}".
 *
 * @property int $id_bookmark
 * @property int $id_user
 * @property int $id_chapter
 *
 * @property Users $user
 * @property Chapter $chapter
 */
class TblBookmark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bookmark}}';
    }


    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_chapter'], 'required'],
            [['id_user', 'id_chapter'], 'integer'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => TblUsers::className(), 'targetAttribute' => ['id_user' => 'id_user']],
            [['id_chapter'], 'exist', 'skipOnError' => true, 'targetClass' => TblChapter::className(), 'targetAttribute' => ['id_chapter' => 'id_chapter']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'status' => 'sukses',
            'id_bookmarkxxxxx' => 'Id Bookmark',
            'id_user' => 'Id User',
            'id_chapter' => 'Id Chapter',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(TblUsers::className(), ['id_user' => 'id_user']);
    }

    /**
     * Gets query for [[Chapter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChapter()
    {
        return $this->hasOne(TblChapter::className(), ['id_chapter' => 'id_chapter']);
    }
}
