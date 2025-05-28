<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class OrdderSearch extends Ordder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_order',], 'integer'],
            [['status', 'created_at', 'appointment_datetime'], 'safe'],
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
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Ordder::find();

        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 4, 
            ]
        ]);

       
        $this->load($params);

        
        if (!$this->validate()) {
            
           
            return $dataProvider;
        }

        
        $query->andFilterWhere([
            'id_order' => $this->id_order,
            'created_at' => $this->created_at,
            'appointment_datetime' => $this->appointment_datetime,
        ]);

        
        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}