<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
?>
<?php
$action = Yii::$app->controller->action->id;
$url = $action=='create'? $action : $action.'/'.$Service['service_id'];
?>
<?php $form = ActiveForm::begin([
  'method' => 'post',
  'id' => 'form-' . $action,
  'action' => ['service/'.$url],
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
              <label class="col-form-label-sm">Service Name:</label>
              <?= $form->field($Service, 'service_name_th')->textInput()?>
            </div>
          </div>

          <div class="form-group-sm row">
            <div class="col-sm-12">
              <label class="col-form-label-sm">Service Description (Quick):</label>
              <?= $form->field($Service, 'service_content_th')->textInput() ?>
            </div>
          </div>

          <div class="form-group-sm row">
            <div class="col-sm-12">
              <label class="col-form-label-sm">Service Description (Expanded):</label>
              <?= $form->field($ServiceDetail, 'service_detail_content_th')->textArea(['class' => 'form-control form-control-sm editor']) ?>
            </div>
          </div>
          <hr>
          <div class="form-group-sm row">
            <div class="col-sm-12">
              <label class="col-form-label-sm">Meta tag (Title):</label>
              <?= $form->field($Service, 'meta_tag_title_th')->textInput()?>
            </div>
          </div>
          <div class="form-group-sm row">
            <div class="col-sm-12">
              <label class="col-form-label-sm">Meta tag (Description):</label>
              <?= $form->field($Service, 'meta_tag_description_th')->textInput() ?>
            </div>
          </div>
          <div class="form-group-sm row">
            <div class="col-sm-12">
              <label class="col-form-label-sm">Meta tag (Keywords):</label>
              <?= $form->field($Service, 'meta_tag_keywords_th')->textInput() ?>
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
              <label class="col-form-label-sm">Service Name:</label>
              <?= $form->field($Service, 'service_name_en')->textInput()?>
            </div>
          </div>

          <div class="form-group-sm row">
            <div class="col-sm-12">
              <label class="col-form-label-sm">Service Description (Quick):</label>
              <?= $form->field($Service, 'service_content_en')->textInput() ?>
            </div>
          </div>

          <div class="form-group-sm row">
            <div class="col-sm-12">
              <label class="col-form-label-sm">Service Description (Expanded):</label>
              <?= $form->field($ServiceDetail, 'service_detail_content_en')->textArea(['class' => 'form-control form-control-sm editor']) ?>
            </div>
          </div>
          <hr>
          <div class="form-group-sm row">
            <div class="col-sm-12">
              <label class="col-form-label-sm">Meta tag (Title):</label>
              <?= $form->field($Service, 'meta_tag_title_en')->textInput()?>
            </div>
          </div>
          <div class="form-group-sm row">
            <div class="col-sm-12">
              <label class="col-form-label-sm">Meta tag (Description):</label>
              <?= $form->field($Service, 'meta_tag_description_en')->textInput() ?>
            </div>
          </div>
          <div class="form-group-sm row">
            <div class="col-sm-12">
              <label class="col-form-label-sm">Meta tag (Keywords):</label>
              <?= $form->field($Service, 'meta_tag_keywords_en')->textInput() ?>
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
            <div class="col-sm-9">
              <table border="1" width="100%" cellpadding="10" style="border: 1px solid #ccc;">
                <tr>
                  <td width="100">
                    <img src="../uploads/<?=$Service->service_image_path?>/<?=$Service->service_image?>" width="100" height="70">
                  </td>
                  <td>
                    <label class="col-form-label-sm">Service Image:</label>
                    <?= $form->field($Service, 'service_image')->fileInput(['class' => 'form-control form-control-sm','accept' => 'image/*']); ?>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-sm-3">
              <table border="1" width="100%" cellpadding="10" style="border: 1px solid #17a2b8;background: #17a2b8;color: #fff;">
                <tr>
                  <td colspan="2">
                    <label class="col-form-label-sm">Status ( visible/invisible )</label>
                    <?php
                    $dataStatus=['1'=>'Active','0'=>'Inactive'];
                    ?>
                    <?= $form->field($Service, 'is_active')->dropDownList($dataStatus,['class'=>'form-control form-control-sm']); ?>

                  </td>
                </tr>
              </table>
            </div>

          </div>
          <div class="form-group-sm row" style="padding-top: 15px;">
            <div class="col-sm-6">
              <table border="1" width="100%" cellpadding="10" style="border: 1px solid #ccc;">
                <tr>
                  <td width="100">
                    <img src="../uploads/<?=$Banner->banner_image_1_path?>/<?=$Banner->banner_image_1?>" width="100" height="60" class="banner_preview_1">
                  </td>
                  <td>
                    <label class="col-form-label-sm">Service Banner 1:</label>
                    <?= $form->field($Banner, 'banner_image_1')->fileInput(['class' => 'form-control form-control-sm','accept' => 'image/*']); ?>
                  </td>
                  <td width="85">
                    <a class="bannerDelete" href="javascript:void(0)" data-id="1" data-mapping="<?=$Service->service_id;?>" value="banner/delete/2"><span class="fas fa-trash-alt" style="padding:0px 2px;"></span> Clear</a>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-sm-6">
              <table border="1" width="100%" cellpadding="10" style="border: 1px solid #ccc;">
                <tr>
                  <td width="100">
                    <img src="../uploads/<?=$Banner->banner_image_2_path?>/<?=$Banner->banner_image_2?>" width="100" height="60" class="banner_preview_2">
                  </td>
                  <td>
                    <label class="col-form-label-sm">Service Banner 2:</label>
                    <?= $form->field($Banner, 'banner_image_2')->fileInput(['class' => 'form-control form-control-sm','accept' => 'image/*']); ?>
                  </td>
                  <td width="85">
                    <a class="bannerDelete" href="javascript:void(0)" data-id="2" data-mapping="<?=$Service->service_id;?>" value="banner/delete/2"><span class="fas fa-trash-alt" style="padding:0px 2px;"></span> Clear</a>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="form-group-sm row" style="padding-top: 15px;">
            <div class="col-sm-6">
              <table border="1" width="100%" cellpadding="10" style="border: 1px solid #ccc;">
                <tr>
                  <td width="100">
                    <img src="../uploads/<?=$Banner->banner_image_3_path?>/<?=$Banner->banner_image_3?>" width="100" height="60" class="banner_preview_3">
                  </td>
                  <td>
                    <label class="col-form-label-sm">Service Banner 3:</label>
                    <?= $form->field($Banner, 'banner_image_3')->fileInput(['class' => 'form-control form-control-sm','accept' => 'image/*']); ?>
                  </td>
                  <td width="85">
                    <a class="bannerDelete" href="javascript:void(0)" data-id="3" data-mapping="<?=$Service->service_id;?>" value="banner/delete/2"><span class="fas fa-trash-alt" style="padding:0px 2px;"></span> Clear</a>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-sm-6">
              <table border="1" width="100%" cellpadding="10" style="border: 1px solid #ccc;">
                <tr>
                  <td width="100">
                    <img src="../uploads/<?=$Banner->banner_image_4_path?>/<?=$Banner->banner_image_4?>" width="100" height="60" class="banner_preview_4">
                  </td>
                  <td>
                    <label class="col-form-label-sm">Service Banner 4:</label>
                    <?= $form->field($Banner, 'banner_image_4')->fileInput(['class' => 'form-control form-control-sm','accept' => 'image/*']); ?>
                  </td>
                  <td width="85">
                    <a class="bannerDelete" href="javascript:void(0)" data-id="4" data-mapping="<?=$Service->service_id;?>" value="banner/delete/2"><span class="fas fa-trash-alt" style="padding:0px 2px;"></span> Clear</a>
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
<?php
$script = <<<JS
$("document").ready(function(){
  $(".bannerDelete").click(function() {
    $('#loadingOverlay').show();
    var mapping_id = $(this).attr('data-mapping');
    var image_id = $(this).attr('data-id');
    $.ajax({
    url: $(this).attr('value'),
    method: "POST",
    data: {mapping_id: mapping_id,image_id:image_id},
    }).done(function(response) {
      $('.banner_preview_'+image_id).attr('src', '');
      $('#loadingOverlay').hide();
      $.pjax.reload({container:"#pjax-grid"});  //Reload GridView
      $('#modal-update').modal('hide');
    }).fail(function( jqXHR, textStatus ) {
      
    });
  });
});
JS;
$this->registerJs($script);
?>