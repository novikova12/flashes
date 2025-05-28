<?php

namespace app\models;
use app\models\Product;
use Yii;
use yii\web\ForbiddenHttpException;

/**
 * This is the model class for table "ordder".
 *
 * @property int $id_order
 * @property string $status
 * @property string|null $created_at
 * @property string|null $appointment_datetime
 * @property int $user_id
 * @property int $product_id
 * @property Ordder[] $order
 */
class Ordder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ordder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appointment_datetime', 'product_id' ], 'required'],
            [['created_at', 'appointment_datetime'], 'safe'],
            [['status'], 'in', 'range' => ['Новый', 'Подтвержден', 'Отменен', 'Выполнен']],
            [['appointment_datetime'], 'validateAppointmentTime'],
            
        ];
    }
    public function getProduct()
    {
    
        return $this->hasOne(Product::class, ['id_product' => 'product_id']);
    }

    public function validateAppointmentTime($attribute, $params)
{
    $appointmentTime = new \DateTime($this->appointment_datetime);
    $weekDay = $appointmentTime->format('N'); 
    $time = $appointmentTime->format('H:i'); 

    if ($weekDay < 1 || $weekDay > 5) {
        $this->addError($attribute, 'Запись возможна только с понедельника по пятницу.');
        return;
    }
    if ($time < '09:00' || $time > '18:00') {
        $this->addError($attribute, 'Запись возможна только с 9:00 до 18:00.');
        return;
    }

    $existingAppointment = Ordder::find()->where(['appointment_datetime' => $this->appointment_datetime])->exists();
    if ($existingAppointment) {
        $this->addError($attribute, 'Этот временной промежуток уже занят.');
    }
}


public function getAvailableTimeSlots()
{
    $slots = [];
    
    
    $today = new \DateTime('now');

   
    $today->setTime(0, 0); 
    $startDate = (clone $today)->modify('+1 day'); 

    for ($i = 0; $i < 7; $i++) {
        $currentDay = clone $startDate;
        $currentDay->modify("+$i days");

      
        if ($currentDay->format('N') < 6) { 
            for ($hour = 9; $hour < 18; $hour++) {
                $slotTime = sprintf('%02d:00', $hour);
                $dateTime = $currentDay->format('Y-m-d') . ' ' . $slotTime;

          
                $currentDateTime = new \DateTime();
                if ($dateTime >= $currentDateTime->format('Y-m-d H:i:s') && 
                    !Ordder::find()->where(['appointment_datetime' => $dateTime])->exists()) {
                    $slots[] = $dateTime; 
                }
            }
        }
    }

    return $slots;
}


public function canEdit()
{

    return $this->user_id == Yii::$app->user->id || Admin::isAdmin(Yii::$app->user->id);
}
public function cancelOrder()
{
    if ($this->status !== 'Отменен') {
        $this->status = 'Отменен';

       
        if ($this->canEdit()) {
            if (!$this->save(false)) {
                Yii::error($this->getErrors());
                return false;
            }
            return true; 
        }

        return false; 
    }

    return false; 
}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_order' => 'ID Записи',
            'status' => 'Статус',
            'created_at' => 'Время записи',
            'appointment_datetime' => 'Время посещения',
            'user_id' => 'User ID',
        ];
    }
 

public function checkAndUpdateStatus()
{
   
    if ($this->status === 'Отменен') {
        return false;
    }

    
    if (strtotime($this->appointment_datetime) < time() && $this->status !== 'Выполнен') {
        $this->status = 'Выполнен';
        return $this->save(false); 
    }

    return false;
}

}