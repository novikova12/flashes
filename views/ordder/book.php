<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $availableSlots array */

$this->title = 'Записаться на услугу';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>
<link href="<?= Url::to('@web/css/ordder.css') ?>" rel="stylesheet">
<div class="ordder-form">
    <h3>Доступное время для записи</h3>

    <?php
    $currentDate = '';
    foreach ($availableSlots as $slot) {
        $date = substr($slot, 0, 10);
        $time = substr($slot, 11); 

        
        if ($currentDate !== $date) {
            if ($currentDate !== '') {
                echo '</div>'; 
            }
            $currentDate = $date;
            echo '<h4 style="font-size: 2em; text-align: center;">' . Html::encode(date('l, d F Y', strtotime($date))) . '</h4>'; 
            echo '<div style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 10px;">'; 
        }

        
        echo Html::button($time, [
            'class' => 'btn btn-danger', 
            'onclick' => "openConfirmationModal('$slot');",
            'style' => 'margin: 5px;' 
        ]);
    }
    echo '</div>'; 
    ?>

    <?= Html::input('hidden', 'Ordder[appointment_datetime]', null, ['id' => 'appointment-datetime']) ?>

   
    <div id="confirmation-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="document.getElementById('confirmation-modal').style.display='none'">&times;</span>
                <h4>Подтверждение записи</h4>
            </div>
            <div class="modal-body">
                <p>Вы уверены, что хотите записаться на выбранное время?</p>
            </div>
            <div class="modal-footer">
                <?= Html::button('Отменить', [
                    'class' => 'btn btn-secondary',
                    'onclick' => 'document.getElementById("confirmation-modal").style.display="none"'
                ]) ?>
                <?= Html::button('Записаться', [
                    'class' => 'btn btn-danger', 
                    'onclick' => 'submitAppointment()'
                ]) ?>
            </div>
        </div> 
    </div>

</div>


<script>
    function openConfirmationModal(slot) {
        document.getElementById('appointment-datetime').value = slot; 
        document.getElementById('confirmation-modal').style.display = 'block'; 
    }

    function submitAppointment() {
        var appointmentDatetime = document.getElementById('appointment-datetime').value;

        $.post({
            url: '<?= \yii\helpers\Url::to(['ordder/book', 'id_product' => $id_product]) ?>',
            data: {
                'Ordder[appointment_datetime]': appointmentDatetime,
                '_csrf': '<?= Yii::$app->request->csrfToken ?>' 
            },
            success: function (data) {
                if (data.success) {
                    alert(data.message); 
                    window.location.href = '<?= \yii\helpers\Url::to(['ordder/myorder']) ?>'; 
                } else {
                    alert('Ошибка: ' + data.message); 
                }
            }
        });
        
        document.getElementById('confirmation-modal').style.display = 'none'; 
    }
</script>

