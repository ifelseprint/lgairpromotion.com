<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<div class="article-search">
    <?php $form = ActiveForm::begin([
        'action' => ['article/index'],
        'method' => 'get',
        'options' => ['data-pjax' => true, 'id' => 'formSearch', 'class' => 'form-horizontal','enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{input}",
            'inputOptions' => ['class' => 'form-control form-control-sm'],
        ],
    ]); ?>

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title"><i class="icofont icofont-search"></i> Search</h3>
            <div class=" float-right">

            <?= Html::button('<i class="icofont icofont-plus-circle"></i> Create Article', ['value' => Url::to('article/create') , 'class' => 'btn btn-success btn-sm' , 'id'=>'btn-modal-create']) ?>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-group-sm row">
                <div class="col-sm-3">
                    <label class="col-form-label-sm">Article Name (TH)</label>
                    <?= $form->field($model, 'article_name_th')->textInput(['value' => (!empty($search['Article']['article_name_th'])) ? $search['Article']['article_name_th'] : '' ])?>
                </div>
                <div class="col-sm-3">
                    <label class="col-form-label-sm">Article Name (EN)</label>
                    <?= $form->field($model, 'article_name_en')->textInput(['value' => (!empty($search['Article']['article_name_en'])) ? $search['Article']['article_name_en'] : '' ])?>
                </div>
                <div class="col-sm-3">
                    <label class="col-form-label-sm">Status</label>
                    <?php
                    $dataStatus=['1'=>'Active','0'=>'Inactive'];
                    ?>
                    <?= $form->field($model, 'is_active')->dropDownList($dataStatus,['prompt'=>': : : ทั้งหมด : : :','class'=>'form-control form-control-sm select2']); ?>
                </div>
                <div class="col-sm-3">
                    <label class="col-form-label-sm">Page size</label>
                    <?php
                    $dataPageSize=['15'=>'15 Record','25'=>'25 Record','50'=>'50 Record','75'=>'75 Record','100'=>'100 Record'];
                    ?>
                    <?= $form->field($model, 'pageSize')->dropDownList($dataPageSize,['class'=>'form-control form-control-sm select2']); ?>
                  </div>
                  
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class=" float-right">
                <?= Html::submitButton(Yii::t('app', '<i class="icofont icofont-search"></i> Search'), ['class' => 'btn btn-info btn-sm']) ?>
                <?= Html::resetButton(Yii::t('app', '<i class="icofont icofont-close"></i> Cancel'), ['class' => 'btn btn-secondary btn-sm']) ?>
            </div>
        </div>
        <!-- /.card-footer -->
    </div>
    <?php ActiveForm::end(); ?>
</div>
