<?php

namespace backend\controllers;

use Yii;
use backend\models\MemberOrder;
use backend\models\MemberOrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class MemberOrderController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new MemberOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model=$this->findModel($id);
        $models_related=MemberOrder::find($id)->with(['memberOrderProducts', 'memberOrderProducts.idProduct'])->all();
        
        $orders=[];
        foreach ($models_related as $model_related) {
            foreach ($model_related['memberOrderProducts'] as $order_product) {
                $order_data=[];
                $order_data['quantity']=$order_product['quantity'];
                $order_data['name']=$order_product['idProduct']['name'];
                $order_data['point']=$order_product['idProduct']['point'];
                
                $orders[]=$order_data;
            }
        }
        
        return $this->render('view', [
            'model' => $model,
            'models_related' => $models_related,
            'orders' => $orders,
        ]);
    }

    public function actionCreate()
    {
        $model = new MemberOrder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_order]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_order]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = MemberOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
