<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%pola}}".
 *
 * @property int $id_pola
 * @property string $konteks
 * @property string $tipe
 * @property int $Value
 */
class Pola extends \yii\db\ActiveRecord
{
    
    public $rekomendasi;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pola}}';
    }

    /**
     * {@inheritdoc}
     */
    
    public function rules()
    {
        return [
            [['id_pola', 'konteks', 'tipe', 'Value'], 'required'],
            [['id_pola', 'Value'], 'integer'],
            [['konteks', 'tipe'], 'string', 'max' => 50],
            [['id_pola'], 'unique'],
            [['rekomendasi'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pola' => 'Id Pola',
            'konteks' => 'Konteks',
            'tipe' => 'Tipe',
            'Value' => 'Value', 
            'rekomendasi' => 'rekomendasi',
        ];
    }

    public function fields()
    {
        // $fields = parent::fields();
        // $fields[]= 'rekomendasi';
        // return $fields;
        return ['rekomendasi'];
    }


    public function afterFind()
	{
		parent::afterFind();

		$this->rekomendasi = '';
		 
    }
}
