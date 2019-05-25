<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\RecipesSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RecipesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recipes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'description:ntext',
            [
                'attribute' => 'user_id',
                'value' => 'user.username',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'update' => false,
                    'delete' => false,
                ],
            ]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
