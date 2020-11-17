<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<div class="jobs-search">
    <?php $form = ActiveForm::begin([
        'action' => ['contact-form/index'],
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


            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-group-sm row">
                <div class="col-sm-3">
                    <label class="col-form-label-sm">First Name</label>
                    <?= $form->field($model, 'searchFirstName')->textInput()?>
                </div>
                <div class="col-sm-3">
                    <label class="col-form-label-sm">Last name</label>
                    <?= $form->field($model, 'searchLastName')->textInput()?>
                </div>
                <div class="col-sm-3">
                    <label class="col-form-label-sm">Telephone</label>
                    <?= $form->field($model, 'searchTel')->textInput()?>
                </div>
                <div class="col-sm-3">
                    <label class="col-form-label-sm">Email</label>
                    <?= $form->field($model, 'searchEmail')->textInput()?>
                </div>
            </div>
            <div class="form-group-sm row">
                <div class="col-sm-3">
                    <label class="col-form-label-sm">Date From</label>
                    <?= $form->field($model, 'searchFromDate')->textInput(['class' => 'form-control form-control-sm datepicker','autocomplete' => 'off'])?>
                </div>
                <div class="col-sm-3">
                    <label class="col-form-label-sm">Date To:</label>
                    <?= $form->field($model, 'searchToDate')->textInput(['class' => 'form-control form-control-sm datepicker','autocomplete' => 'off'])?>
                </div>
                <div class="col-sm-3">
                    <label class="col-form-label-sm">Page size</label>
                    <?php
                    $dataPageSize=['15'=>'15 Record','25'=>'25 Record','50'=>'50 Record','75'=>'75 Record','100'=>'100 Record'];
                    ?>
                    <?= $form->field($model, 'pageSize')->dropDownList($dataPageSize,['class'=>'form-control form-control-sm select2']); ?>
                </div>
                <div class="col-sm-3"></div>
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
