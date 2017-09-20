<?php
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\LinkPager;
use yii\helpers\Url;

AppAsset::register($this);

$this->title = "用户列表";
$this->params['breadcrumbs'][] = $this->title;

?>
<h1><?=Html::encode($this->title)?></h1>

    <?= Html::a('用户添加', ['add'], ['class' => 'btn btn-default']) ?>
    <table class="table table-hover">
        <tr>
            <td>用户姓名</td>
            <td>用户年龄</td>
            <td>用户性别</td>
            <td>操作</td>
        </tr>

        <?php $this->beginBlock('block'); ?>
        <?php foreach ($countries as $user): ?>
            <tr>
                <td><?= Html::encode("{$user->uname}")?></td>

                <td><?= Html::encode("{$user->uage}")?></td>
                <td>
                    <?php if (($user['usex']) == 1){ echo "男";} else{ echo "女";} ?>
                </td>
                <td>
                    <a class="btn btn-default" href="<?=Url::toRoute(['update','id' => $user['id']])?>" role="button">修改</a>
                    <a class="btn btn-default" href="<?=Url::toRoute(['del','id' => $user['id']])?>" role="button">删除</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('block1'); ?>
            <tr>
                <td colspan="4">没有用户</td>
            </tr>
        <?php $this->endBlock(); ?>

        <?php if (empty($countries)): ?>
            <?= $this->blocks['block1'] ?>
        <?php else: ?>
            <?= $this->blocks['block'] ?>
        <?php endif; ?>

    </table>
<?= LinkPager::widget([
    'pagination'=>$pagination,
    'firstPageLabel' => '首页',
    'nextPageLabel' => '下一页',
    'prevPageLabel' => '上一页',
    'lastPageLabel' => '末页',
]) ?>
