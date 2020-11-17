<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

?>
<?php
$action = Yii::$app->controller->action->id;
$url = $action=='create'? $action : $action.'/'.$data['id'];
?>
<?php $form = ActiveForm::begin([
  'method' => 'post',
  'id' => 'form-' . $action,
  'action' => ['product/'.$url],
  'options' => ['enctype' => 'multipart/form-data','data-pjax' => true ],
  'enableClientValidation' => false,
  'enableAjaxValidation' => false
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
              <label class="col-form-label-sm">Product Name:</label>
              <?= Html::input('text', 'product_name_th', (!empty($data['product_name_th']) ? $data['product_name_th'] : ''), ['class' => 'form-control form-control-sm',]) ?>
            </div>
          </div>

          <div class="form-group-sm row">
            <div class="col-sm-12">
              <label class="col-form-label-sm">Product Description:</label>
              <?= Html::textArea('product_detail_content_th', (!empty($data['product_detail_content_th']) ? $data['product_detail_content_th'] : ''),['class' => 'form-control form-control-sm editor']); ?>
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
              <label class="col-form-label-sm">Product Name:</label>
              <?= Html::input('text', 'product_name_en', (!empty($data['product_name_en']) ? $data['product_name_en'] : ''), ['class' => 'form-control form-control-sm',]) ?>
            </div>
          </div>

          <div class="form-group-sm row">
            <div class="col-sm-12">
              <label class="col-form-label-sm">Product Description:</label>
              <?= Html::textArea('product_detail_content_en', (!empty($data['product_detail_content_en']) ? $data['product_detail_content_en'] : ''),['class' => 'form-control form-control-sm editor']); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group-sm row">
    <div class="col-sm-12">
      <div class="card card-outline card-info">
        <div class="card-header">
          <h3 class="card-title"><i class="far fa-address-card"></i> Support Language (TH/EN)</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="display: block;">
          <div class="form-group-sm row">
            <div class="col-sm-4">
              <table border="1" width="100%" cellpadding="10" style="border: 1px solid #ccc;">
                <tr>
                  <td width="100">
                    <img src="/wehomemart.com/uploads/2020/06/product_28.png" width="100" height="70">
                  </td>
                  <td>
                    <label class="col-form-label-sm">Product icon:</label>
                    <?= Html::fileInput('product_icon', null,['class' => 'form-control form-control-sm']); ?>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-sm-4">
              <table border="1" width="100%" cellpadding="10" style="border: 1px solid #ccc;">
                <tr>
                  <td width="100">
                    <img src="/wehomemart.com/uploads/2020/06/sc-bathroom5.jpg" width="100" height="70">
                  </td>
                  <td>
                    <!-- <label class="col-form-label-sm">Product image:</label>
                    <?= Html::fileInput('product_image', null,['class' => 'form-control form-control-sm']); ?> -->
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-sm-4">
              <table border="1" width="100%" cellpadding="12" style="border: 1px solid #ccc;">
                <tr>
                  <td colspan="2">
                    <label class="col-form-label-sm">Status</label>
                    <?php
                    $dataStatus=['1'=>'Active','0'=>'Inactive'];
                    ?>
                    <?= Html::dropDownList( 'is_active',
                        (!empty($data['is_active']) ? $data['is_active'] : ''),
                        $dataStatus,
                        ['class' => 'form-control form-control-sm select2']
                      );
                    ?>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>