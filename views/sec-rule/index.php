<?php

use yii\helpers\Html;
use macgyer\yii2materializecss\widgets\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SecRule\SecRuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['title'] = 'Correlation Rules';
?>

<div class="sec-rule-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="main-actions centered-horizontal">
        <?= Html::a("<i class='material-icons'>add</i>" . Yii::t('app', 'Create Correlation Rule'), ['create'], ['class' => 'btn-floating waves-effect waves-light btn-large red']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'type',
            [
                'attribute' => 'state',
                'label' => 'State',
                'format' => 'html',
                'value' => function($model){
                    if($model->state){
                        return '<span style="color: #11ff00;">ACTIVE</span>';
                    }
                    else{
                        return '<span style="color: red">INACTIVE</span>';
                    }
                },
            ],
            ['class' => 'macgyer\yii2materializecss\widgets\grid\ActionColumn'],
        ],
    ]); ?>

</div>
