<?php

namespace app\modules\api\models;

use Yii;
/**
* @OA\Schema(
*      schema="TblHasiltes",
*      required={"id_tes","id_kuis","jawaban"},
*     @OA\Property(
*        property="id_hasil",
*        description="",
*        type="integer",
*        format="int64",
*    ),
*     @OA\Property(
*        property="id_tes",
*        description="",
*        type="integer",
*        format="int64",
*    ),
*     @OA\Property(
*        property="id_kuis",
*        description="",
*        type="integer",
*        format="int64",
*    ),
*     @OA\Property(
*        property="jawaban",
*        description="",
*        type="string",
*        maxLength=1,
*    ),
* )
*/

/**
 * This is the model class for table "hasil_tes".
 *
 * @property string $id_hasil
 * @property string $id_tes
 * @property string $id_kuis
 * @property string $jawaban
 *
 * @property Tes $tes
 * @property Kuis $kuis
 */
class TblHasiltes extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => \yii2tech\ar\softdelete\SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'deleted_at' =>  time(),
                ],
                'restoreAttributeValues' => [
                    'deleted_at' => 0
                ]
//                'replaceRegularDelete' => true
            ],
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' =>  time(),
            ],
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hasil_tes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tes', 'id_kuis', 'jawaban'], 'required'],
            [['id_tes', 'id_kuis'], 'integer'],
            [['jawaban'], 'string', 'max' => 1],
            [['id_tes'], 'exist', 'skipOnError' => true, 'targetClass' => Tes::className(), 'targetAttribute' => ['id_tes' => 'id_tes']],
            [['id_kuis'], 'exist', 'skipOnError' => true, 'targetClass' => Kuis::className(), 'targetAttribute' => ['id_kuis' => 'id_kuis']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_hasil' => 'Id Hasil',
            'id_tes' => 'Id Tes',
            'id_kuis' => 'Id Kuis',
            'jawaban' => 'Jawaban',
        ];
    }


    public static function find()
    {
    $query = parent::find();

    $query->attachBehavior('softDelete', \yii2tech\ar\softdelete\SoftDeleteQueryBehavior::className());

    return $query->notDeleted();
    }

    public function fields()
    {
        $fields = parent::fields();
        $customFields = [
            'created_at' => function ($model) {
                return \Yii::$app->formatter->asDatetime($model->created_at,'php:c');
            },
            'updated_at' => function ($model) {
                return \Yii::$app->formatter->asDatetime($model->updated_at,'php:c');
            },
        ];
        unset($fields['deleted_at']);

        return \yii\helpers\ArrayHelper::merge($fields, $customFields);
    }

    public function extraFields()
    {
        return [
            'creator',
            'updater'
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTes()
    {
    return $this->hasOne(Tes::className(), ['id_tes' => 'id_tes']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getKuis()
    {
    return $this->hasOne(Kuis::className(), ['id_kuis' => 'id_kuis']);
    }

    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

}
