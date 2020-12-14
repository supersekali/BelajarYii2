<?php

namespace app\models;

use Yii;
use app\models\Pola;

/**
 * This is the model class for table "chapter".
 *
 * @property int $id_chapter
 * @property int $id_buku
 * @property string $nama_chapter
 * @property string $chapter file
 *
 * @property TblBuku $buku
 * @property TblLevel $chapter0
 * @property Convertation[] $convertations
 * @property TblKuis[] $kuis
 */
class TblChapter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $oldpdf;
    /**
     * {@inheritdoc}
     */
    public $lokasi;
    public $waktu;
    public $konsen;
    public $batasan;
    public $rekomendasi;

    public static function tableName()
    {
        return 'chapter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_buku', 'nama_chapter', 'level_kesulitan'], 'required'],
            [['id_buku', 'level_kesulitan'], 'integer'],
            [['chapter'], 'safe'],
            [['nama_chapter', 'chapter'], 'string', 'max' => 64],
             [['id_buku'], 'exist', 'skipOnError' => true, 'targetClass' => TblBuku::className(), 'targetAttribute' => ['id_buku' => 'id_buku']],
            // [['id_chapter'], 'exist', 'skipOnError' => true, 'targetClass' => TblLevel::className(), 'targetAttribute' => ['id_chapter' => 'id_chapter']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_chapter' => 'Id Chapter',
            'id_buku' => 'Id TblBuku',
            'nama_chapter' => 'Nama Chapter',
            'chapter' => 'Chapter',
            'level_kesulitan' => 'Level Kesulitan',
        ];
    }

    /**
     * Gets query for [[TblBuku]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBuku()
    {
        return $this->hasOne(TblBuku::className(), ['id_buku' => 'id_buku']);
    }

    /**
     * Gets query for [[Chapter0]].
     *
     * @return \yii\db\ActiveQuery
     */
     

    /**
     * Gets query for [[Convertations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConvertations()
    {
        return $this->hasMany(Convertation::className(), ['id_chapter' => 'id_chapter']);
    }

    /**
     * Gets query for [[TblKuis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKuis()
    {
        return $this->hasMany(TblKuis::className(), ['id_chapter' => 'id_chapter']);
    }

    public function getUser()
    {
        return $this->hasMany(TblUser::className(), ['id_user' => Yii::$app->user->identity->id_user]);
    }

    //view fuction batasan dan kondisi pada model
    public function getBatasan()
    {
        $this->lokasi = Yii::$app->request->get('lokasi');
        $this->waktu = Yii::$app->request->get('waktu');
        $this->konsen = Yii::$app->request->get('konsen');

        $tempat = Pola::find()
            ->select('Value')
            ->where(['tipe'=>$this->lokasi])
            ->one();
        $sumtempat =$tempat->Value;

        $time =Pola::find()
            ->select('Value')
            ->where(['tipe'=>$this->waktu])
            ->one();
        $sumtime =$time->Value;
        
        $konsentrasi= Pola::find()
            ->select('Value')
            ->where(['tipe'=>$this->konsen])
            ->one();
        $sumkonsentrasi =$konsentrasi->Value;

        $sum = $sumtempat + $sumtime  + $sumkonsentrasi;
        $this->batasan = $sum;
    }
 
    public function afterFind()
	{
        parent::afterFind();
        
        $this->getBatasan();
        $this->rekomendasi = (
            ($this->batasan >= 10.17) || 
            ($this->batasan < 10.17 && ($this->level_kesulitan == 2 && $this->level_kesulitan == 1)) ||
            ($this->batasan < 5.8 && $this->level_kesulitan == 1)
            ) ? "Direkomendasikan" : "Tidak direkomendasikan";

        $this->oldpdf = $this->chapter; 
	}

    
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }  
       
        return true;
    }
    
}
