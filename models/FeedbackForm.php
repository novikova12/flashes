<?php

namespace app\models;

use Yii;
use yii\base\Model;

class FeedbackForm extends Model
{
    public $email;
    public $message;

    public function rules()
    {
        return [
            [['email', 'message'], 'required'],
            ['email', 'email'],
            ['message', 'string', 'max' => 1000],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'message' => 'Отзыв',
        ];
    }
}