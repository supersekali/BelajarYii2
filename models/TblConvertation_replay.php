<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%convertation_replay}}".
 *
 * @property int $id
 * @property int $id_convertation
 * @property string $replay
 * @property int $id_user
 * @property string $ip
 * @property string $time
 *
 * @property Convertation $conversation
 * @property Users $user
 */
class TblConvertation_replay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%convertation_replay}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_convertation', 'replay', 'id_user'], 'required'],
            [['id_convertation', 'id_user'], 'integer'],
            [['replay'], 'string'],
            [['time'], 'safe'],
            [['ip'], 'string', 'max' => 20],
            [['id_convertation'], 'exist', 'skipOnError' => true, 'targetClass' => TblConvertation::className(), 'targetAttribute' => ['id_convertation' => 'id_convertation']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => TblUsers::className(), 'targetAttribute' => ['id_user' => 'id_user']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_convertation' => 'Id Convertation',
            'replay' => 'Replay',
            'id_user' => 'Id User',
            'ip' => 'Ip',
            'time' => 'Time',
        ];
    }

    /**
     * Gets query for [[Conversation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConversation()
    {
        return $this->hasOne(TblConvertation::className(), ['id_convertation' => 'id_convertation']);
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
}
