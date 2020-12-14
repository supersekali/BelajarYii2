<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\rekomendasi;

/**
 * TblRekomendasiSearch represents the model behind the search form of `app\models\rekomendasi`.
 */
class TblRekomendasiSearch extends rekomendasi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_rekomendasi', 'id_user', 'id_buku', 'bobot'], 'integer'],
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
        $query = rekomendasi::find();

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
            'id_rekomendasi' => $this->id_rekomendasi,
            'id_user' => $this->id_user,
            'id_buku' => $this->id_buku,
            'bobot' => $this->bobot,
        ]);

        return $dataProvider;
    }
}
