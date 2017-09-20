<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;

$this->title=$model->isNewRecord ? '新增用户' : '修改用户';
$this->params['breadcrumbs'][] = $this->title;

?>
<h1><?=Html::encode($this->title)?></h1>
<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'uage')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'usex')->radioList(['1'=>'男','2'=>'女']) ?>
    <?php
    if( Yii::$app->getSession()->hasFlash('error') ) {
        echo Alert::widget([
            'options' => [
                'class' => 'alert alert-danger',
            ],
            'body' => Yii::$app->getSession()->getFlash('error'),
        ]);
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>