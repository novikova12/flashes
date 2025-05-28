<?php
namespace app\models;

use Yii;
use yii\base\Model;

class RegForm extends Model
{
    public $name;
    public $surname;
    public $patronymic;
    public $login;
    public $email;
    public $password;
    public $confirm_password;
    public $agree;

    public function rules()
    {
        return [
            [['name', 'surname', 'patronymic', 'email', 'login', 'password', 'confirm_password', 'agree'], 'required'],
            [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[А-Яёа-яё]{3,}$/u', 'message' => 'Используйте минимум 3 русских буквы'], 
            [['password'], 'match', 'pattern' => '/^[A-Za-z0-9]{5,}$/', 'message' => 'Используйте минимум 5 латинских букв и цифр'],
            [['email'], 'email'],
            [['confirm_password'], 'compare', 'compareAttribute' => 'password'],
            [['email'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'email'],
            [['agree'], 'compare', 'compareValue' => true, 'message' => 'Вы должны согласиться с обработкой данных.'],
            [['name', 'surname', 'patronymic', 'email', 'password'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
            'confirm_password' => 'Подтверждение пароля',
            'agree' => 'Согласие на обработку данных',
        ];
    }
}