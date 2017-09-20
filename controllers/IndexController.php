<?php
/**
 * Created by PhpStorm.
 * User: H
 * Date: 2017/9/15
 * Time: 13:21
 */
namespace app\controllers;

use yii\web\Controller;
use app\models\User;
use yii\data\Pagination;
use Yii;

class IndexController extends Controller{

    /**
     * 用户列表
     * @return string
     */
    public function actionIndex(){

        $list = User::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' =>     $list->count(),
        ]);

        $countries = $list
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index',['countries' => $countries, 'pagination' => $pagination]);
    }

    /**
     * 用户添加
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post())){
            $post = Yii::$app->request->post();
            $model->uname   =   $post['User']['uname'];
            $model->uage    =   $post['User']['uage'];
            $model->usex    =   $post['User']['usex'];

            $model->save();
            return $this->redirect(['index']);
        }else{
            return $this->render('_from', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 用户修改
     * @return string|\yii\web\Response
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->get('id');
        $model = User::find()->where(['id' => $id])->one();
        $model1 = User::findOne($id);
        if ($model1->load(Yii::$app->request->post())){
            $post = Yii::$app->request->post();
            $model1->uname  =   $post['User']['uname'];
            $model1->uage  =   $post['User']['uage'];
            $model1->usex  =   $post['User']['usex'];
            $model1->save();
            return $this->redirect(['index']);
        }else{
            return $this->render('_from', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 根据用户id删除用户
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDel($id)
    {
        $connection=Yii::$app->db;
        $transaction=$connection->beginTransaction();
        try
        {
            $connection->createCommand()->delete("user", "id = '$id'")->execute();
            $transaction->commit();
        }
        catch(Exception $ex)
        {
            $transaction->rollBack();
        }
        return $this->redirect(['index']);
    }

    public function actionTest()
    {

    }
}