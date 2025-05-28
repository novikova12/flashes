<?php

namespace app\models;

use Yii;

class Admin extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'admin';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_admin' => 'Id Admin',
            'name' => 'Name',
        ];
    }

    public static function isAdmin($userId)
    {
        $admin = self::findOne($userId);
        return $admin !== null && $admin->id_admin == 1;
    }
}