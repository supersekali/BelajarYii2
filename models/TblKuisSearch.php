<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblKuis;
use app\models\TblChapter;
use app\models\TblUser;
use Yii;


/**
 * TblKuisSearch represents the model behind the search form of `app\models\TblKuis`.
 */
class TblKuisSearch extends TblKuis
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_kuis', 'id_chapter'], 'integer'],
            [['soal', 'pilihan_benar', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $buku = TblBuku::find()
        ->where(['id_user' =>  Yii::$app->user->identity->id_user])
        ->all();

        $chapter = TblChapter::find()
        ->where(['id_buku' => $buku])
        ->All();

        $query = TblKuis::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_kuis' => $this->id_kuis,
            'id_chapter' => $this->id_chapter,
            'id_chapter' => $chapter,
        ]);

        $query->andFilterWhere(['like', 'soal', $this->soal])
            ->andFilterWhere(['like', 'pilihan_benar', $this->pilihan_benar])
            ->andFilterWhere(['like', 'pilihan_a', $this->pilihan_a])
            ->andFilterWhere(['like', 'pilihan_b', $this->pilihan_b])
            ->andFilterWhere(['like', 'pilihan_c', $this->pilihan_c])
            ->andFilterWhere(['like', 'pilihan_d', $this->pilihan_d])
            ->andFilterWhere(['like', 'pilihan_e', $this->pilihan_e]);

        return $dataProvider;
    }
}
