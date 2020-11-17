<?php
use yii\helpers\Html;
?>
<!-- Modal Popup View ##################### -->
<div class="modal fade" id="modal-view">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icofont icofont-plus-circle"></i> View Data Result</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding-bottom: 0px;">
                <div id='modal-content-view'></div>
            </div>
            <div class="modal-footer justify-content-between">
                <?= Html::button('Close', ['class' => 'btn btn-secondary btn-sm' , 'data-dismiss' => "modal" ]) ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal Popup View ##################### -->
