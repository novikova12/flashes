<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_product', 'price','category_id'], 'integer'],
            [['photo_product', 'name_product',], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
      
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
        $query = Product::find();
        $this->load($params);
      
        if (isset($params['ProductSearch']['category_id']) && !empty($params['ProductSearch']['category_id'])) {
            $query->andFilterWhere(['category_id' => $params['ProductSearch']['category_id']]);
        }

       
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5, 
            ]
        ]);

        $this->load($params);

        return $dataProvider;
    }
}
