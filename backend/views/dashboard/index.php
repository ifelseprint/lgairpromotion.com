<?php
use yii\helpers\Html;
use yii\base\Widget;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use backend\assets\AppAsset;
AppAsset::register($this);
?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark"><i class="icofont icofont-coins"></i> Register <small>View</small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#"><i class="ti-home"></i> Home</a></li>
          <li class="breadcrumb-item active">Register View</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<?php Pjax::begin(['id' => 'pjax-grid','timeout' => 0,'enablePushState' => false]); ?>
<div id="loadingOverlay" class="loader-overlay" style="display: none;">
    <div class="loader-content loader-center">
        <div id="loading" class="loader"></div>
    </div>
</div>
<!-- <div id="loading" class="loader"></div> -->
<div class="content">
  <div class="container">
    <!-- Search Box Start ################# -->

    <?= $this->render('_search', ['model'=> $model,'dataApplication'=>$dataApplication]); ?>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fa fa-list"></i> Result list</h3>
      </div>
      <div class="card-body table-responsive p-0">
      <?php
      echo GridView::widget([
        'tableOptions' => ['class' => 'table table-hover table-striped table-sm m-0'],
        'rowOptions' => function ($model, $key, $index, $grid) {
          return [
            'style'=>'cursor:pointer;', 
          ];
        },
        'dataProvider' => $dataProvider,
        'layout'=> '{items} <div class="card-footer clearfix"><div class="float-left">{summary}</div><div class="float-right">{pager}</div></div>',
        'pager' => [
          'options' => ['class' => 'pagination pagination-sm m-0'],
          'firstPageLabel' => 'First',
          'lastPageLabel'  => 'Last',
        ],
        'columns' => [
          [
            'attribute' => 'search_register_appId',
            'label' => $model->getAttributeLabel('search_register_appId'),
            'format' => 'raw',
            'contentOptions' => ['style' => 'width:200px'],
            'value' => function ($model) {
              return (empty($model->application->NAME) ? null : '<div class="btn-modal-view" value='.Url::to(['dashboard/view/'.base64_encode($model->ID)]).' style="height: 25px;overflow:hidden;">'.$model->application->NAME.'</div>');
            },
          ],
          [
            'attribute' => 'FULLNAME',
            'label' => $model->getAttributeLabel('search_register_name'),
            'format' => 'raw',
            'contentOptions' => ['style' => ''],
            'value' => function ($model) {
              return '<div class="btn-modal-view" value='.Url::to(['dashboard/view/'.base64_encode($model->ID)]).' style="height: 25px;overflow:hidden;">'.$model->FULLNAME.'</div>';
            },
          ],
          [
            'attribute' => 'TEL',
            'label' => $model->getAttributeLabel('search_register_tel'),
            'format' => 'raw',
            'contentOptions' => ['style' => 'width:110px'],
            'value' => function ($model) {
              return '<div class="btn-modal-view" value='.Url::to(['dashboard/view/'.base64_encode($model->ID)]).' style="height: 25px;overflow:hidden;">'.$model->TEL.'</div>';
            },
          ],
          [
            'attribute' => 'EMAIL',
            'label' => $model->getAttributeLabel('search_register_email'),
            'format' => 'raw',
            'contentOptions' => ['style' => 'width:200px'],
            'value' => function ($model) {
              return '<div class="btn-modal-view" value='.Url::to(['dashboard/view/'.base64_encode($model->ID)]).' style="height: 25px;overflow:hidden;">'.$model->EMAIL.'</div>';
            },
          ],
          [
            'attribute' => 'SELECT_1',
            'label' => 'รุ่นผลิตภัณฑ์',
            'format' => 'raw',
            'contentOptions' => ['style' => 'width:110px'],
            'value' => function ($model) {
              return '<div class="btn-modal-view" value='.Url::to(['dashboard/view/'.base64_encode($model->ID)]).' style="height: 25px;overflow:hidden;">'.$model->SELECT_1.'</div>';
            },
          ],
          [
            'attribute' => 'QUESTION_1',
            'label' => 'หมายเลขซีเรียล',
            'format' => 'raw',
            'contentOptions' => ['style' => 'width:210px'],
            'value' => function ($model) {
              return '<div class="btn-modal-view" value='.Url::to(['dashboard/view/'.base64_encode($model->ID)]).' style="height: 25px;overflow:hidden;">'.$model->QUESTION_1.'</div>';
            },
          ],
          [
            'attribute' => 'QUESTION_2',
            'label' => 'วันที่รับบริการ',
            'format' => 'raw',
            'contentOptions' => ['style' => 'width:110px'],
            'value' => function ($model) {
              return '<div class="btn-modal-view" value='.Url::to(['dashboard/view/'.base64_encode($model->ID)]).' style="height: 25px;overflow:hidden;">'.date("d/m/Y", strtotime($model->QUESTION_2)).'</div>';
            },
          ],
        ],
      ]);
      ?>
      </div> <!-- close card-body -->
    </div> <!-- close card -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<?php

$script = <<<JS
  $("document").ready(function(){

    $("#pjax-grid").on("pjax:start", function() {
      $('#loadingOverlay').show();
    });
    $("#pjax-grid").on("pjax:end", function() {
      $('#loadingOverlay').hide();
    });

    $('.select2').select2({
      width: '100%'
    });

    //Initialize initializeInPjax
    LG.App.initializeInPjax();
  });
JS;
$this->registerJs($script,\yii\web\View::POS_READY);
?>

<?php Pjax::end(); ?>

<?= $this->render('_modal', []); ?>