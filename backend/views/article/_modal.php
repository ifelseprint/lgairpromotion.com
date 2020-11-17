<?php
use yii\helpers\Html;
?>
<!-- Modal Popup Create ##################### -->
<div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icofont icofont-plus-circle"></i> Create Article</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding-bottom: 0px;">
                <div id='modal-content-create'></div>
            </div>
            <div class="modal-footer justify-content-between">
                <?= Html::button('Close', ['class' => 'btn btn-secondary btn-sm' , 'data-dismiss' => "modal" ]) ?>
                <?= Html::button('<i class="icofont icofont-diskette"></i> Submit', ['class' => 'btn btn-info btn-sm float-right' , 'id' => 'create']) ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal Popup Create ##################### -->

<!-- Modal Popup Update ##################### -->
<div class="modal fade" id="modal-update">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Article</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding-bottom: 0px;">
                <div id='modal-content-update'></div>
            </div>
            <div class="modal-footer justify-content-between">
                <?= Html::button('Close', ['class' => 'btn btn-secondary btn-sm' , 'data-dismiss' => "modal" ]) ?>
                <?= Html::button('<i class="icofont icofont-diskette"></i> Submit', ['class' => 'btn btn-info btn-sm float-right' , 'id' => 'update']) ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal Popup Update ##################### -->