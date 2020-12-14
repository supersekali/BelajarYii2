<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblChapter; 
use app\models\TblUser; 

/**
 * TblChapterSearch represents the model behind the search form of `app\models\TblChapter`.
 */
class TblChapterSearch extends TblChapter
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_chapter', 'id_buku', 'level_kesulitan'], 'integer'],
            [['nama_chapter', 'chapter', 'lokasi', 'waktu', 'konsen'], 'safe'],
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

        $query = TblChapter::find();
        
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
            'id_chapter' => $this->id_chapter,
            'id_buku' => $this->id_buku, 
            // 'id_buku' => $buku,   
        ]);

        $query->andFilterWhere(['like', 'nama_chapter', $this->nama_chapter])
            ->andFilterWhere(['like', 'chapter', $this->chapter])
            ->andFilterWhere(['like', 'level_kesulitan', $this->chapter]);

        return $dataProvider;
    }
}
