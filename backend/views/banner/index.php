<?php
use yii\helpers\Html;
use yii\base\Widget;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;


?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark"><i class="icofont icofont-coins"></i> Banner <small>List</small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#"><i class="ti-home"></i> Home</a></li>
          <li class="breadcrumb-item active">Banner List</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<?php Pjax::begin(['id' => 'pjax-grid','timeout' => 0,'enablePushState' => false,]); ?>
<div id="loadingOverlay" class="loader-overlay" style="display: none;">
    <div class="loader-content loader-center">
        <div id="loading" class="loader"></div>
    </div>
</div>

<div class="content">
  <div class="container">

    <?= $this->render('_search', ['model'=> $model, 'pages'=>$pages,'search' => $search]); ?>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fa fa-list"></i> Result list</h3>
      </div>
      <div class="card-body table-responsive p-0">
      <?php
      echo GridView::widget([
          'tableOptions' => ['class' => 'table table-hover table-striped table-sm m-0'],
          'layout'=> '{items} <div class="card-footer clearfix"><div class="float-left">{summary}</div><div class="float-right">{pager}</div></div>',
          'pager' => [
              'options' => ['class' => 'pagination pagination-sm m-0'],
              'firstPageLabel' => 'First',
              'lastPageLabel'  => 'Last',
          ],
          'dataProvider' => $dataProvider,
          'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'width:50px'],
            ],
            [
                'attribute' => 'banner_page_id',
                'label' => 'Page',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width:70px'],
                'value' => function ($model) {
                    return $model->pages['page_name_th']." / ".$model->pages['page_name_en'];
                },
            ],
            [
                'attribute' => 'banner_image_1',
                'label' => 'Banner 1',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width:70px'],
                'value' => function ($model) {
                    return '<img src="'.str_replace('/admin', '', Yii::getAlias('@web')).'/uploads/'.$model->banner_image_1_path.'/'.$model->banner_image_1.'" width="50">';
                },
            ],
            [
                'attribute' => 'banner_image_2',
                'label' => 'Banner 2',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width:70px'],
                'value' => function ($model) {
                    return '<img src="'.str_replace('/admin', '', Yii::getAlias('@web')).'/uploads/'.$model->banner_image_2_path.'/'.$model->banner_image_2.'" width="50">';
                },
            ],
            [
                'attribute' => 'banner_image_3',
                'label' => 'Banner 3',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width:70px'],
                'value' => function ($model) {
                    return '<img src="'.str_replace('/admin', '', Yii::getAlias('@web')).'/uploads/'.$model->banner_image_3_path.'/'.$model->banner_image_3.'" width="50">';
                },
            ],
            [
                'attribute' => 'banner_image_4',
                'label' => 'Banner 4',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width:70px'],
                'value' => function ($model) {
                    return '<img src="'.str_replace('/admin', '', Yii::getAlias('@web')).'/uploads/'.$model->banner_image_4_path.'/'.$model->banner_image_4.'" width="50">';
                },
            ],
            [
                'attribute' => 'modified_date',
                'label' => 'Modified Date',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width:130px'],
                'value' => function ($model) {
                    return '<div style="height: 25px;overflow:hidden;">'.date('d/m/Y H:i:s', strtotime($model->modified_date));'</div>';
                },
            ],
            [
                'attribute' => 'is_active',
                'label' => 'Status',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width:70px'],
                'value' => function ($model) {
                    switch ($model->is_active) {
                        case '1':
                        $status_icon = 'badge-success';
                        $status_text = 'Active';
                        break;
                        case '0':
                        $status_icon = 'badge-danger';
                        $status_text = 'Inactive';
                        break;
                    }
                    return Html::tag('span', $status_text, ['class'=>'badge badge-lg '.$status_icon]);
                },
            ],
            [
              'class' => 'yii\grid\ActionColumn',
              'header' => 'Action',
              'headerOptions' => ['style' => 'color:#009482; width:70px;'],
              'template' => '{Update}',
              'buttons'  => [
                'Update' => function ($url,$model) {
                  return Html::a('<span class="fa fa-edit" style="padding:0px 2px;"></span>','', [
                    'class' => 'btn-modal-update',
                    'title' => 'edit',
                    'data-toggle' => 'modal',
                    'value' => Url::to('banner/update/'.$model->banner_id),
                  ]);
                }
              ]
            ],
          ],
      ]);
      ?>
      </div>
    </div>
  </div>
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

    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize initializeInPjax
    appWebsite.App.initializeInPjax();
  });

  
JS;
$this->registerJs($script);
?>
<?php Pjax::end(); ?>


<?= $this->render('_modal', ['model'=> $model,'search' => $search]); ?>