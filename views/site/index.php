<?php
use yii\helpers\Html;
?>
<h1>Main page</h1>
<?php
if (Yii::$app->user->isGuest) {
    $result = 'You can see recipes - ' . Html::a('See', ['recipes/index'], ['class' => 'btn btn-info']) .
        '<br>If you want create recipes you must sign in or sign up if you have not account - ' .
        Html::a('Auth', ['user/signin'], ['class' => 'btn btn-success']);
} else {
    $result = 'You can see recipes - ' . Html::a('See', ['recipes/index'], ['class' => 'btn btn-info']) .
        '<br>If you want create recipes or update/delete your own recipes go to - ' .
        Html::a('See', ['recipes/my'], ['class' => 'btn btn-success']);
}
?>
<span class="main-text"> <?= $result ?> </span>