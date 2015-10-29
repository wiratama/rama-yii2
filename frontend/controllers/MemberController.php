<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Member;
use backend\models\City;
use backend\models\MemberPoint;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class MemberController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['signup','myaccount','update','point'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['myaccount','update','point'],
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

    public function actionMyaccount()
    {
        $member=Member::findIdentity(Yii::$app->user->identity->id);
        $member->password="Your choosen password!";
        return $this->render('view', [
            'model' => $member,
        ]);
    }

    public function actionSignup()
    {
        $model = new Member(['scenario' => 'signup']);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('success', 'Thank you for signup. Administrator will approve your account.');
            $model = new Member();
            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate()
    {
        $model=Member::findIdentity(Yii::$app->user->identity->id);
        $oldpassword=$model->password;
        $model->password='';
        
        if ($model->load(Yii::$app->request->post())) {
            $post_member=Yii::$app->request->post('Member');
            if(empty($post_member['password'])) {
                $model->password=$oldpassword;
            }
            if ($model->save()) {
                return $this->redirect(['myaccount']);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionPoint()
    {
        $points=MemberPoint::find()->where(['id_member' => Yii::$app->user->identity->id])->all();
        $points_active=MemberPoint::find()->where(['id_member' => Yii::$app->user->identity->id,'status'=>1])->all();
        $points_used=MemberPoint::find()->where(['id_member' => Yii::$app->user->identity->id,'status'=>2])->all();
        $active = Yii::$app->db->createCommand("SELECT sum(`point`) FROM member_point mp WHERE `status`=1");
        $active_point = $active->queryScalar();
        $used = Yii::$app->db->createCommand("SELECT sum(`point`) FROM member_point mp WHERE `status`=2");
        $used_point = $used->queryScalar();
        $total = Yii::$app->db->createCommand("SELECT sum(`point`) FROM member_point");
        $total_point = $total->queryScalar();
        return $this->render('point', [
            'points' => $points,
            'points_active' => $points_active,
            'points_used' => $points_used,
            'active_point' => $active_point,
            'used_point' => $used_point,
            'total_point' => $total_point,
        ]);
    }

    public function actionGetcity()
    {
        $country=(int)Yii::$app->request->post('country');
        $model = City::findOne($country);
        $model = City::findAll([
            'country_id' => $country,
        ]);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $model;
    }

    protected function findModel($id)
    {
        if (($model = Member::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
