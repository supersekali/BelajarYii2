<?php

namespace app\modules\api\models;

use Yii;
/**
* @OA\Schema(
*      schema="TblTes",
*      required={"id_buku","id_user","nilai"},
*     @OA\Property(
*        property="id_tes",
*        description="",
*        type="integer",
*        format="int64",
*    ),
*     @OA\Property(
*        property="id_buku",
*        description="",
*        type="integer",
*        format="int64",
*    ),
*     @OA\Property(
*        property="id_user",
*        description="",
*        type="integer",
*        format="int64",
*    ),
*     @OA\Property(
*        property="nilai",
*        description="",
*        type="integer",
*        format="int64",
*    ),
* )
*/

/**
 * This is the model class for table "tes".
 *
 * @property string $id_tes
 * @property string $id_buku
 * @property string $id_user
 * @property int $nilai
 *
 * @property HasilTes[] $hasilTes
 * @property Buku $buku
 * @property Users $user
 */
class TblTes extends \yii\db\ActiveRecord
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
        return 'tes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_buku', 'id_user', 'nilai'], 'required'],
            [['id_buku', 'id_user', 'nilai'], 'integer'],
            [['id_buku'], 'exist', 'skipOnError' => true, 'targetClass' => Buku::className(), 'targetAttribute' => ['id_buku' => 'id_buku']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id_user']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tes' => 'Id Tes',
            'id_buku' => 'Id Buku',
            'id_user' => 'Id User',
            'nilai' => 'Nilai',
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
    public function getHasilTes()
    {
    return $this->hasMany(HasilTes::className(), ['id_tes' => 'id_tes']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getBuku()
    {
    return $this->hasOne(Buku::className(), ['id_buku' => 'id_buku']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUser()
    {
    return $this->hasOne(Users::className(), ['id_user' => 'id_user']);
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
