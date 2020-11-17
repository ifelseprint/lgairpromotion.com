<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
?>
<?php
$action = Yii::$app->controller->action->id;
$url = $action=='create'? $action : $action.'/'.$Translate['translate_id'];
?>
<?php $form = ActiveForm::begin([
  'method' => 'post',
  'id' => 'form-' . $action,
  'action' => ['translate/'.$url],
  'options' => ['enctype' => 'multipart/form-data','data-pjax' => true ],
  'fieldConfig' => [
    'template' => "{input}",
    'inputOptions' => ['class' => 'form-control form-control-sm'],
  ],
]);
?>
<div style="margin-bottom: 25px;">

  <div class="form-group-sm row">
    <div class="col-sm-6">
      <div class="card card-outline card-info">
        <div class="card-header">
          <h3 class="card-title"><i class="far fa-address-card"></i> Support Language (TH)</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="display: block;">
          <div class="form-group-sm row">
            <div class="col-sm-12">
              <label class="col-form-label-sm">Text :</label>
              <?= $form->field($Translate, 'translate_th')->textArea(['class' => 'form-control form-control-sm']) ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card card-outline card-info">
        <div class="card-header">
          <h3 class="card-title"><i class="far fa-address-card"></i> Support Language (EN)</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="display: block;">
          <div class="form-group-sm row">
            <div class="col-sm-12">
              <label class="col-form-label-sm">Text :</label>
              <?= $form->field($Translate, 'translate_en')->textArea(['class' => 'form-control form-control-sm']) ?>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>