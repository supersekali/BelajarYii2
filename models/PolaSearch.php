<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pola;

/**
* PolaSearch represents the model behind the search form of `app\models\Pola`.
*/
class PolaSearch extends Pola
{
/**
* {@inheritdoc}
*/
public function rules()
{
return [
[['id_pola', 'Value'], 'integer'],
            [['konteks', 'tipe'], 'safe'],
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
$query = Pola::find();

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
            'id_pola' => $this->id_pola,
            'Value' => $this->Value,
        ]);

        $query->andFilterWhere(['like', 'konteks', $this->konteks])
            ->andFilterWhere(['like', 'tipe', $this->tipe]);

return $dataProvider;
}
}
