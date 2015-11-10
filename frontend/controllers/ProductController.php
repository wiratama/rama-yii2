<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Product;
use frontend\models\Member;
use frontend\models\MemberOrder;
use frontend\models\MemberOrderProduct;
use frontend\models\ClaimPromo;
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
        $claimpromo=new ClaimPromo();
        // $query = Product::find()->where(['status' => 1]);
        $query = Product::find()->with('productCategories.idCategory')->where('status=1 and (start_date < NOW() - INTERVAL 1 DAY) and (end_date > NOW() - INTERVAL 1 DAY)');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>5]);
        
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
            $promos[$key]['category']=[];
            $i=0;
            foreach($model['productCategories'] as $dataCategory) {
                $promos[$key]['category'][$i]=$dataCategory['idCategory']->category;
                $i++;
            }

            $promos[$key]['id_product']=$model->id_product;
            $promos[$key]['name']=$model->name;
            $promos[$key]['description']=$model->description;
            Image::thumbnail(Yii::$app->basePath.'/..'.$model->image , 350, 350)->save(Yii::$app->basePath.'/../resize/'.$model->image, ['quality' => 100]);
            $promos[$key]['promo_image_url']=Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl().'/resize/'.$model->image;
            $promos[$key]['page']=$pagestand;
            $promos[$key]['point']=$model->point;
        }

        return $this->render('promo', [
            'promos' => $promos,
            'pages' => $pages,
            'claimpromo' => $claimpromo,
        ]);
    }

    // public function actionClaimpromo($id, $page)
    public function actionClaimpromo()
    {
        $model=new ClaimPromo();
        if ($model->load(Yii::$app->request->post())) {
            $post=Yii::$app->request->post('ClaimPromo');

            $claim = Product::find()->where(['status' => 1,'id_product'=>(int)$post['id']])->one();
            $all_active = Yii::$app->db->createCommand("SELECT sum(`point`) FROM member_point mp WHERE `status`=1 AND `id_member` = ".Yii::$app->user->identity->id)->queryScalar();
            $all_used = Yii::$app->db->createCommand("SELECT sum(`point`) FROM member_point mp WHERE `status`=2 AND `id_member` = ".Yii::$app->user->identity->id)->queryScalar();
            $active=$all_active-$all_used;
            $member=Member::findIdentity(Yii::$app->user->identity->id);
            
            if ($claim!== null and (int)$active > (int)$claim->point) {
                $randCode=implode("",$this->getNumbers(1,99,5,1));

                $order=new MemberOrder();
                $order->id_member=Yii::$app->user->identity->id;
                $order->coupon_code=$randCode;
                $order->doc=$post['doc'];
                $order->comment=$post['comment'];
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

                Yii::$app->mailer->compose(['html' => '@app/themes/rama/mail/couponCode-html', 'text' => '@app/themes/rama/mail/couponCode-text'], ['user' => $member,'coupon_code'=>$randCode,'doc'=>$post['doc']])
                ->setFrom([\Yii::$app->params['infoEmail'] => \Yii::$app->name])
                ->setTo($member->email)
                ->setSubject('Coupon code for ' . \Yii::$app->name)
                ->send();

                Yii::$app->mailer->compose(['html' => '@app/themes/rama/mail/claimedCode-html', 'text' => '@app/themes/rama/mail/claimedCode-text'], ['coupon_code'=>$randCode,'doc'=>$post['doc'],'customer_mail'=>$member->email])
                ->setFrom([\Yii::$app->params['infoEmail'] => \Yii::$app->name])
                ->setTo(\Yii::$app->params['itEmail'])
                ->setSubject('New order claimed ' . \Yii::$app->name)
                ->send();

                return $this->redirect(['member/point']);
            } else {
                Yii::$app->session->set('pagestand', (int)$post['page']);
                Yii::$app->session->setFlash('warning', 'Your point is not enough to claim this promo!');
                return $this->redirect(['promo']);
            }
        } else {
            Yii::$app->session->set('pagestand', (int)$post['page']);
            Yii::$app->session->setFlash('warning', 'Please fill the form carefully');
            return $this->redirect(['promo']);
        }
    }

    public function getNumbers($min=1,$max=10,$count=1,$margin=0) {
        $range = range(0,$max-$min);
        $return = array();
        for( $i=0; $i<$count; $i++) {
            if( !$range) {
                trigger_error("Not enough numbers to pick from!",E_USER_WARNING);
                return $return;
            }
            $next = rand(0,count($range)-1);
            $return[] = $range[$next]+$min;
            array_splice($range,max(0,$next-$margin),$margin*2+1);
        }
        return $return;
    }
}
