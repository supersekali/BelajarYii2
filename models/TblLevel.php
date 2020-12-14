<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%level}}".
 *
 * @property int $id_level
 * @property int $id_chapter
 * @property int $level
 * @property string $nilai level
 *
 * @property Chapter $chapter
 * @property Rule[] $rules
 */
class TblLevel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%level}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_chapter', 'level', 'nilai level'], 'required'],
            [['id_chapter', 'level'], 'integer'],
            [['nilai level'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_level' => 'Id Level',
            'id_chapter' => 'Id Chapter',
            'level' => 'Level',
            'nilai level' => 'Nilai Level',
        ];
    }

    /**
     * Gets query for [[Chapter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChapter()
    {
        return $this->hasOne(Chapter::className(), ['id_chapter' => 'id_chapter']);
    }

    /**
     * Gets query for [[Rules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRules()
    {
        return $this->hasMany(Rule::className(), ['id_level' => 'id_level']);
    }
}
