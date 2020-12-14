<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%convertation}}".
 *
 * @property int $id_convertation
 * @property int $id_chapter
 * @property int $user_one
 * @property int $user_two
 * @property string $ip
 * @property string $time
 *
 * @property Chapter $chapter
 * @property ConvertationReplay[] $convertationReplays
 */
class TblConvertation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%convertation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_chapter', 'user_one', 'user_two'], 'required'],
            [['id_chapter', 'user_one', 'user_two'], 'integer'],
            [['time'], 'safe'],
            [['ip'], 'string', 'max' => 20],
            [['id_chapter'], 'exist', 'skipOnError' => true, 'targetClass' => TblChapter::className(), 'targetAttribute' => ['id_chapter' => 'id_chapter']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_convertation' => 'Id Convertation',
            'id_chapter' => 'Id Chapter',
            'user_one' => 'User One',
            'user_two' => 'User Two',
            'ip' => 'Ip',
            'time' => 'Time',
        ];
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

    /**
     * Gets query for [[ConvertationReplays]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConvertationReplays()
    {
        return $this->hasMany(TblConvertationReplay::className(), ['id_conversation' => 'id_convertation']);
    }
}
