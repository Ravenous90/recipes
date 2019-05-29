<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\models\Ingredients;
use app\models\Measures;
use app\models\RecipesSearch;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Recipes */
/* @var $ingModel app\models\Ingredients */
/* @var $searchModelIng app\models\RecipesSearch */
/* @var $dataProviderIng yii\data\ActiveDataProvider */

$ingModel = new Ingredients();

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Recipes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipes-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (RecipesSearch::isMyRecipe($model->id)) : ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php endif; ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'description:ntext',
        ],
    ]) ?>
    <div class="ingredients-view">
        <h3><?= $ingModel::getRusianName(); ?></h3>
        <?php if (RecipesSearch::isMyRecipe($model->id)) : ?>
        <p>
            <?= Html::a('Add ingredient', ['ingredients/create?recipe_id=' . $model->id], ['class' => 'btn btn-success']) ?>
        </p>
        <?php endif; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProviderIng,
//        'filterModel' => $searchModelIng,
        'columns' => [
            'title',
            'amount',
//            [
//                'attribute' => 'measure_id',
//                'value' => 'measures.title',
//            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => false,
                ],
                'buttons' => [
                    'update' => function ($index) use ($model) {
                        if (RecipesSearch::isMyRecipe($model->id)) {
                            return Html::a('', ['ingredients/update?id=' . intval(substr(parse_url($index)['query'], 3))],
                                ['class' => 'glyphicon glyphicon-pencil']);
                        } else {
                            return false;
                        }
                    },
                    'delete' => function ($index) use ($model) {
                        if (RecipesSearch::isMyRecipe($model->id)) {
                            return Html::a('', ['/ingredients/delete?id=' . intval(substr(parse_url($index)['query'], 3)) . '&recipe_id=' . $model->id],
                                [
                                    'class' => 'glyphicon glyphicon-trash',
                                    'data' => [
                                        'confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.',
                                        'method' => 'post',
                                    ],
                                ]);
                        } else {
                            return false;
                        }
                    },
                ],
            ],
        ],

    ]); ?>
    </div>
</div>
