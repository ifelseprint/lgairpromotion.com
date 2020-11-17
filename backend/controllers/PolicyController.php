<?php

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use backend\models\VListallpolicySearch;
use backend\models\PartnerAppliance;
use backend\models\ContractDetail;
use backend\models\ContractApplianceMappings;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
class PolicyController extends Controller
{
    public function actionIndex()
    {
        $this->redirect(['/policy/view']);
    }

    public function actionView()
    {
        $search = Yii::$app->request->queryParams;
    	$searchModel = new VListallpolicySearch();
        $dataProvider = $searchModel->search($search);
        if(Yii::$app->request->isPjax){

            if(!empty($search['VListallpolicySearch'])){
                $dataProvider->pagination->pageSize = $search['VListallpolicySearch']['pageSize'];
                $contract_partner_id = $search['VListallpolicySearch']['contract_partner_id'];
            }else{
                $contract_partner_id = 0;
            }
        	return $this->renderPartial('view', [
        		'model' => $searchModel,
            	'dataProvider' => $dataProvider,
                'dataPackage' => ArrayHelper::map(\common\models\Package::find()
                    ->where(['is_active' => 'Y'])
                    ->orderBy(['name' => SORT_ASC])
                    ->all(), 'id', 'name'),
            	'dataPartner' => ArrayHelper::map(\common\models\Partner::find()
                    ->where(['is_active' => 'Y'])
                    ->orderBy(['partner_name' => SORT_ASC])
                    ->all(), 'partner_id', 'partner_name'),
                'dataOutlet' => ArrayHelper::map(\common\models\Outlets::find()
                    ->where(['is_active' => 'Y','partner_id'=> $contract_partner_id])
                    ->orderBy(['outlets_name' => SORT_ASC])
                    ->all(), 'outlets_id', 'outlets_name'),
            	'dataBrand' => ArrayHelper::map(\common\models\Brand::find()
                    ->where(['is_active' => 'Y'])
                    ->orderBy(['brand_name' => SORT_ASC])
                    ->all(), 'brand_id', 'brand_name'),
            	'dataApplianceType' => ArrayHelper::map(\common\models\ApplianceType::find()
                    ->where(['is_active' => 'Y'])
                    ->orderBy(['appliance_type_name' => SORT_ASC])
                    ->all(), 'appliance_type_id', 'appliance_type_name'),
            	'search' => $search
        	]);
        }else{
        	return $this->render('view', [
        		'model' => $searchModel,
            	'dataProvider' => $dataProvider,
                'dataPackage' => ArrayHelper::map(\common\models\Package::find()
                    ->where(['is_active' => 'Y'])
                    ->orderBy(['name' => SORT_ASC])
                    ->all(), 'id', 'name'),
            	'dataPartner' => ArrayHelper::map(\common\models\Partner::find()
                    ->where(['is_active' => 'Y'])
                    ->orderBy(['partner_name' => SORT_ASC])
                    ->all(), 'partner_id', 'partner_name'),
                'dataOutlet' => ArrayHelper::map(\common\models\Outlets::find()
                    ->where(['is_active' => 'Y','partner_id'=>'0'])
                    ->orderBy(['outlets_name' => SORT_ASC])
                    ->all(), 'outlets_id', 'outlets_name'),
            	'dataBrand' => ArrayHelper::map(\common\models\Brand::find()
                    ->where(['is_active' => 'Y'])
                    ->orderBy(['brand_name' => SORT_ASC])
                    ->all(), 'brand_id', 'brand_name'),
            	'dataApplianceType' => ArrayHelper::map(\common\models\ApplianceType::find()
                    ->where(['is_active' => 'Y'])
                    ->orderBy(['appliance_type_name' => SORT_ASC])
                    ->all(), 'appliance_type_id', 'appliance_type_name'),
            	'search' => $search
        	]);

        }
    }

    public function actionCreate()
    {
        $searchModel = new VListallpolicySearch();
        return $this->render('create', [
            'model' => $searchModel,
            'dataPartner' => ArrayHelper::map(\common\models\Partner::find()
                ->where(['is_active' => 'Y'])
                ->orderBy(['partner_name' => SORT_ASC])
                ->all(), 'partner_id', 'partner_name')
        ]);
    }

    public function actionPartnerApplianceList($id)
    {
        $models = PartnerAppliance::find()
        ->joinWith('applianceType')
        ->where([PartnerAppliance::tableName().'.partner_id' => $id])
        ->orderBy(['appliance_type_name' => SORT_ASC])
        ->all();
        if($models){
            echo '<option value="">: : : กรุณาเลือก : : :</option>';
            foreach($models as $post){
                echo "<option value='".$post['applianceType']['appliance_type_id']."'>".$post['applianceType']['appliance_type_name']."</option>";
            }
        }else{
            echo '<option value="">: : : กรุณาเลือก : : :</option>';
        }
    }

    public function actionContractHeaderList($id)
    {
        $models = \common\models\ContractHeader::find()
        ->where(['is_active' => 'Y','partner_id'=> $id])
        ->orderBy(['contract_name' => SORT_ASC])
        ->all();
        if($models){
            echo '<option value="">: : : กรุณาเลือก : : :</option>';
            foreach($models as $post){
                echo "<option value='".$post['contract_id']."'>".$post['contract_name']."</option>";
            }
        }else{
            echo '<option value="">: : : กรุณาเลือก : : :</option>';
        }
    }

    public function actionContractOutletsList($id)
    {

        $models = ContractDetail::find()
        ->joinWith('outlets')
        ->where([ContractDetail::tableName().'.contract_id' => $id])
        ->orderBy(['outlets.outlets_name' => SORT_ASC])
        ->all();
        if($models){
            echo '<option value="">: : : กรุณาเลือก : : :</option>';
            foreach($models as $post){
                echo "<option value='".$post['outlets']['outlets_id']."'>".$post['outlets']['outlets_name']."</option>";
            }
        }else{
            echo '<option value="">: : : กรุณาเลือก : : :</option>';
        }
    }

    public function actionContractPackageList($id)
    {
        $models = ContractApplianceMappings::find()
        ->joinWith('package')
        ->where([ContractApplianceMappings::tableName().'.contract_id' => $id])
        ->andWhere(['!=','package.id', 0])
        ->groupBy(['package.id'])
        ->orderBy(['package.name' => SORT_ASC])
        ->all();
        if($models){
            echo '<option value="">: : : กรุณาเลือก : : :</option>';
            foreach($models as $post){
                echo "<option value='".$post['package']['id']."'>".$post['package']['name']."</option>";
            }
        }else{
            echo '<option value="">: : : กรุณาเลือก : : :</option>';
        }
    }

    public function actionOutletsList($id)
    {
        $models = \common\models\Outlets::find()
        ->where(['is_active' => 'Y','partner_id'=> $id])
        ->orderBy(['outlets_name' => SORT_ASC])
        ->all();
        if($models){
            echo '<option value="">: : : ทั้งหมด : : :</option>';
            foreach($models as $post){
                echo "<option value='".$post['outlets_id']."'>".$post['outlets_name']."</option>";
            }
        }else{
            echo '<option value="">: : : ทั้งหมด : : :</option>';
        }
    }

    public function actionClearList()
    {
        echo '<option value="">: : : กรุณาเลือก : : :</option>';
    }
    // public function actionTest()
    // {
    // 	$query = VListallpolicySearch::find()->where(['pol_id' => 1])->orderBy(['pol_id' => SORT_DESC]);
    //     $query->joinWith(['brand','applianceType'])->all();
    //     print_r($query);
    //     exit;
    // }

}
