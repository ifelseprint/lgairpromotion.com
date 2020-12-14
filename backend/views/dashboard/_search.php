<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$form = ActiveForm::begin([
  'method' => 'get',
  'id' => 'search-policy',
  'layout' => 'horizontal',
  'enableClientValidation' => false,
  'options' => [ 'data-pjax' => 0 ],
  'validationStateOn' => ActiveForm::VALIDATION_STATE_ON_INPUT,
  'fieldConfig' => [
    'template' => "{input}",
    'inputOptions' => ['class' => 'form-control form-control-sm'],
    'options' => [
      'data-pjax' => true,
      'tag' => false,
    ],
  ],
]);
?>
<div class="card card-outline card-info">
  <div class="card-header">
    <h3 class="card-title"><i class="icofont icofont-folder-search"></i> Search Register</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">

    <div class="form-group-sm row">
      <label class="col-sm-1">แคมเปญ :</label>
      <div class="col-sm-3">
        <?= $form->field($model, 'search_register_appId')->dropDownList($dataApplication,['prompt'=>': : : ทั้งหมด : : :','class'=>'form-control form-control-sm select2','id' => 'search_register_appId'])?>
      </div>

      <label class="col-sm-1">วันที่ลงทะเบียน :</label>
      <div class="col-sm-3">
        <?= $form->field($model, 'search_date_range')->textInput(['class' => 'form-control form-control-sm datepicker_range', 'autocomplete' => 'off']);?>
      </div>
      <label class="col-sm-1">แสดงต่อหน้า :</label>
      <div class="col-sm-3">
        <?php
        $dataPageSize=['25'=>'25 Record','50'=>'50 Record','75'=>'75 Record','100'=>'100 Record'];
        ?>
        <?= $form->field($model, 'search_pageSize')->dropDownList($dataPageSize,['class'=>'form-control form-control-sm select2']); ?>
      </div>
    </div>
    <hr>
    <div class="form-group-sm row">
      <label class="col-sm-1">ชื่อ-นามสกุล :</label>
      <div class="col-sm-3">
        <?= $form->field($model, 'search_register_name')->textInput(['class' => 'form-control form-control-sm','id'=>'search_register_name'])?>
      </div>
      <label class="col-sm-1">เบอร์โทรศัพท์ :</label>
      <div class="col-sm-3">
        <?= $form->field($model, 'search_register_tel')->textInput(['class' => 'form-control form-control-sm','id'=>'search_register_tel'])?>
      </div>
      <label class="col-sm-1">อีเมล :</label>
      <div class="col-sm-3">
        <?= $form->field($model, 'search_register_email')->textInput(['class' => 'form-control form-control-sm','id'=>'search_register_email'])?>
      </div>
    </div>
    <div class="form-group-sm row">
      <label class="col-sm-1">วันที่รับบริการ :</label>
      <div class="col-sm-3">
        <?= $form->field($model, 'search_date_service')->textInput(['class' => 'form-control form-control-sm datepicker_range', 'autocomplete' => 'off']);?>
      </div>
      <label class="col-sm-1">รุ่นผลิตภัณฑ์ :</label>
      <div class="col-sm-3">
        <?= $form->field($model, 'search_register_model')->textInput(['class' => 'form-control form-control-sm','id'=>'search_register_model'])?>
      </div>
      <label class="col-sm-1">หมายเลขซีเรียล :</label>
      <div class="col-sm-3">
        <?= $form->field($model, 'search_register_serial')->textInput(['class' => 'form-control form-control-sm','id'=>'search_register_serial'])?>
      </div>
    </div>
     
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    <button type="button" class="btn btn-success btn-sm"><i class="fa fa-file-excel"></i> Export</button>
    <div class=" float-right">
      <?= Html::submitButton('<i class="icofont icofont-search"></i> Search', ['class' => 'btn btn-info btn-sm', 'name' => 'search-button']); ?>     
      <?= Html::resetButton('<i class="icofont icofont-close"></i> Reset', ['class' => 'btn btn-secondary btn-sm reset-button', 'name' => 'reset-button']); ?>           
    </div>
  </div>         
</div>

<?php ActiveForm::end(); ?>