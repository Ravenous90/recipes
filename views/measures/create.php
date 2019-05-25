<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Measures */

$this->title = 'Create Measures';
$this->params['breadcrumbs'][] = ['label' => 'Measures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="measures-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
