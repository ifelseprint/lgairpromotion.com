<?php
use yii\helpers\Html;
?>
<!-- Modal Popup action ##################### -->
<div class="modal fade second-modal" id="modal-action" data-backdrop="static" style="padding: 0px; margin: 0px;">
    <div class="modal-dialog">
        <div class="modal-content" style="border: 0px;padding: 0px;">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
                <div id='modal-content-action' class="modal-content-display"></div>
            </div>
            <div class="modal-footer">
                <?= Html::a('<i class="icofont icofont-close"></i> ปิดหน้าต่างนี้ ', ['home/index'], ['class'=>'btn btn-default btn-sm','style'=> 'margin:5px;border: 0px;']) ?>
            </div>
        </div>
    </div>
</div>