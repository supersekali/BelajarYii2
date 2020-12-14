<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblBuku;
use Yii;
/**
 * TblBukuSearch represents the model behind the search form of `app\models\TblBuku`.
 */
class TblBukuSearch extends TblBuku
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_buku', 'id_user'], 'integer'],
            [['cover', 'judul_buku', 'penulis', 'kategori', 'tahun_terbit','kota_terbit','penerbit', 'jenjang', 'deskripsi'], 'safe'],
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
        $query = TblBuku::find();

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
            'id_buku' => $this->id_buku,
            'tahun_terbit' => $this->tahun_terbit,
            'id_user' => Yii::$app->user->identity->id_user,
        ]);
         
        $query->andFilterWhere(['like', 'cover', $this->cover])
            ->andFilterWhere(['like', 'judul_buku', $this->judul_buku])
            ->andFilterWhere(['like', 'penulis', $this->penulis])
            ->andFilterWhere(['like', 'kategori', $this->kategori])
            ->andFilterWhere(['like', 'jenjang', $this->jenjang])
            ->andFilterWhere(['like', 'deskripsi', $this->deskripsi]);

        return $dataProvider;
    }
}
