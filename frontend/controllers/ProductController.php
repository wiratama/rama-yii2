<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Product;
use frontend\models\MemberOrder;
use frontend\models\MemberOrderProduct;
use backend\models\MemberPoint;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use yii\imagine\Image;
use yii\helpers\Url;

class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['promo','claimpromo'],
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionPromo()
    {
        $query = Product::find()->where(['status' => 1]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>1]);
        
        if(Yii::$app->session->get('pagestand')==null) {
            $pagestand=$pages->offset;
        } else {
            $pagestand=Yii::$app->session->get('pagestand');
            Yii::$app->session->remove('pagestand');
        }
        
        $models = $query->offset($pagestand)
            ->limit($pages->limit)
            ->all();
        
        $promos=[];
        foreach ($models as $key => $model) {
            $promos[$key]['id_product']=$model->id_product;
            $promos[$key]['name']=$model->name;
            $promos[$key]['description']=$model->description;
            Image::thumbnail(Yii::$app->basePath.'/..'.$model->image , 350, 350)->save(Yii::$app->basePath.'/../resize/'.$model->image, ['quality' => 100]);
            $promos[$key]['promo_image_url']=Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl().'/resize/'.$model->image;
            $promos[$key]['page']=$pagestand;
        }

        return $this->render('promo', [
            'promos' => $promos,
            'pages' => $pages,
        ]);
    }

    public function actionClaimpromo($id, $page)
    {
        $claim = Product::find()->where(['status' => 1,'id_product'=>(int)$id])->one();
        $all_active = Yii::$app->db->createCommand("SELECT sum(`point`) FROM member_point mp WHERE `status`=1 AND `id_member` = ".Yii::$app->user->identity->id)->queryScalar();
        $all_used = Yii::$app->db->createCommand("SELECT sum(`point`) FROM member_point mp WHERE `status`=2 AND `id_member` = ".Yii::$app->user->identity->id)->queryScalar();
        $active=$all_active-$all_used;
        
        if ($claim!== null and (int)$active > (int)$claim->point) {
            $order=new MemberOrder();
            $order->id_member=Yii::$app->user->identity->id;
            $order->save();
            
            $orderProduct=new MemberOrderProduct();
            $orderProduct->id_order=$order->id_order;
            $orderProduct->id_product=$claim->id_product;
            $orderProduct->quantity=1;
            $orderProduct->save();

            $point = new MemberPoint();
            $point->id_member=Yii::$app->user->identity->id;
            $point->point=$claim->point;
            $point->status=2;
            $point->save();
            return $this->redirect(['member/point']);
        } else {
            Yii::$app->session->set('pagestand', (int)$page);
            return $this->redirect(['promo']);
        }
        die();
    }
}
