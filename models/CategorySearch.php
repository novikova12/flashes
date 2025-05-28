<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Category;
class CategorySearch extends Category
{
    public function rules()
{
   
    return [
        [['id_category'], 'integer'],
        [['name_category', 'photo_category'], 'safe'], 
    ];
}

public function search($params)
{
    $query = Category::find();

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
   'pagination' => [
                'pageSize' => 4, 
            ],
        ]);


    $this->load($params);
    if (!$this->validate()) {
        return $dataProvider;
    }

   
    $query->andFilterWhere(['id_category' => $this->id_category])
          ->andFilterWhere(['like', 'name_category', $this->name_category])
          ->andFilterWhere(['like', 'photo_category', $this->photo_category]); 

    return $dataProvider;
}
}