<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id_product
 * @property string $photo_product
 * @property string $name_product
 * @property int $price
 * @property int $category_id
 * @property Category $category
 */
/** @var yii\web\View $this */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'name_product', 'price', 'category_id', ], 'required'],
            [['price'], 'number'],
            [['photo_product'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'], 
            [['category_id'], 'integer'],
            [['created'], 'safe'],
            [['name_product', ], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id_category']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_product' => 'ID Услуги',
            'photo_product' => 'Фото Услуги',
            'name_product' => 'Название Услуги',
            'price' => 'Цена',
            'category_id' => 'ID Категории',
        ];
    }


    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id_category' => 'category_id']);
    }

    public function upload()
    {
        if ($this->validate()) { 
            $path = 'assets/images/' . Yii::$app->getSecurity()->generateRandomString() . '.' . $this->photo_product->extension;
            $this->photo_product->saveAs($path); 
            return $path; 
        } else {
            return false; 
        }
    }
}
