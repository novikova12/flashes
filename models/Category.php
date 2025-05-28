<?php

namespace app\models;

use Yii;

class Category extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }

    public function rules()
    {
        return [
            [['name_category'], 'string', 'max' => 255],
            [['photo_category'], 'file', 'extensions' => 'jpg, png, gif', 'skipOnEmpty' => true],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_category' => 'ID Category',
            'name_category' => 'Название Категории',
            'photo_category' => 'Фото Категории',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $fileName = uniqid() . '.' . $this->photo_category->extension;
            $path = Yii::getAlias('@webroot/assets/images/') . $fileName;
            $this->photo_category->saveAs($path);
            return $fileName;
        }
        return false;
    }

    public function getProducts()
    {
        return $this->hasMany(Product::class, ['category_id' => 'id_category']);
    }
}