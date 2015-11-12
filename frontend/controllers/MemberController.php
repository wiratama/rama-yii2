<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Member;
use frontend\models\Product;
use backend\models\City;
use backend\models\MemberPoint;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\imagine\Image;
use yii\helpers\Url;
use frontend\models\MemberCategory;

class MemberController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['signup','myaccount','update','point','promo'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['myaccount','update','point','promo'],
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
        Image::thumbnail(Yii::$app->basePath.'/..'.$member->avatar, 350, 350)->save(Yii::$app->basePath.'/../resize/'.$member->avatar, ['quality' => 100]);
        $avatar=Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl().'/resize/'.$member->avatar;
        return $this->render('view', [
            'model' => $member,
            'avatar'=>$avatar,
        ]);
    }

    public function actionSignup()
    {
        $model = new Member(['scenario' => 'signup']);
        // $model2 = new MemberCategory();
        if ($model->load(Yii::$app->request->post())) {
            $model->file_image = UploadedFile::getInstance($model, 'file_image');

            $base_image_directory="/uploads/avatars/";
            $full_image_directory=Yii::$app->getBasePath()."/..".$base_image_directory;
            $model->avatar=$base_image_directory.$model->email.".".$model->file_image->extension;

            if ($model->save()) {
                $model->upload($full_image_directory,$model->email);

                // if ($model2->load(Yii::$app->request->post())) {
                //     if (!empty(Yii::$app->request->post('MemberCategory')['id_category'])) {
                //         foreach(Yii::$app->request->post('MemberCategory')['id_category'] as $category) {
                //             $model2 = new MemberCategory();
                //             $model2->id_member=$model->id_member;
                //             $model2->id_category=$category;
                //             $model2->save();
                //         }
                //     }
                // }

                \Yii::$app->getSession()->setFlash('success', 'Thank you for signup.');

                $model = new Member();
                $model2 = new MemberCategory();
                return $this->render('create', [
                    'model' => $model,
                    'model2' => $model2,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                // 'model2' => $model2,
            ]);
        }
    }

    public function actionUpdate()
    {
        $model=Member::findIdentity(Yii::$app->user->identity->id);
        $oldpassword=$model->password;
        $oldimage=$model->avatar;
        $model->password='';
        // $model2 = new MemberCategory();

        // $categories = MemberCategory::find()->where(['id_member' => Yii::$app->user->identity->id])->all();
        // $selected=[];
        // foreach($categories as $category) {
        //     $selected[]=$category->id_category;
        // }
        // $model2->id_category=$selected;
        
        if ($model->load(Yii::$app->request->post())) {
            $post_member=Yii::$app->request->post('Member');
            $base_image_directory="/uploads/avatars/";
            $full_image_directory=Yii::$app->getBasePath()."/..".$base_image_directory;
            
            $model->file_image=UploadedFile::getInstance($model, 'file_image');
            if(strlen(trim($model->file_image)) > 0) {
                if (!empty($oldimage) and $oldimage!='.' and file_exists(Yii::$app->getBasePath()."/..".$oldimage)) {
                    unlink(Yii::$app->getBasePath()."/..".$oldimage);
                }
                $model->avatar=$base_image_directory.$model->email.".".$model->file_image->extension;
            } else {
                $model->avatar=$oldimage;
            }

            if(empty($post_member['password'])) {
                $model->password=$oldpassword;
            }

            if ($model->save()) {
                if ($model->avatar!=$oldimage) {
                    $model->upload($full_image_directory,$model->email);
                }

                // if ($model2->load(Yii::$app->request->post())) {
                //     MemberCategory::deleteAll('id_member = :id', [':id' => Yii::$app->user->identity->id]);
                //     if (!empty(Yii::$app->request->post('MemberCategory')['id_category'])) {
                //         foreach(Yii::$app->request->post('MemberCategory')['id_category'] as $category) {
                //             $model2 = new MemberCategory();
                //             $model2->id_member=$model->id_member;
                //             $model2->id_category=$category;
                //             $model2->save();
                //         }
                //     }
                // }

                return $this->redirect(['myaccount']);
            }
        }
        return $this->render('update', [
            'model' => $model,
            // 'model2' => $model2,
        ]);
    }

    public function actionPoint()
    {
        $all_points=MemberPoint::find()->where(['id_member' => Yii::$app->user->identity->id])->all();
        $points_active=MemberPoint::find()->where(['id_member' => Yii::$app->user->identity->id,'status'=>1])->all();
        $points_used=MemberPoint::find()->where(['id_member' => Yii::$app->user->identity->id,'status'=>2])->all();
        
        $all_active = Yii::$app->db->createCommand("SELECT sum(`point`) FROM member_point mp WHERE `status`=1 AND `id_member` = ".Yii::$app->user->identity->id)->queryScalar();
        $all_used = Yii::$app->db->createCommand("SELECT sum(`point`) FROM member_point mp WHERE `status`=2 AND `id_member` = ".Yii::$app->user->identity->id)->queryScalar();
        $active=$all_active-$all_used;
        
        return $this->render('point', [
            'points' => $all_points,
            'points_active' => $points_active,
            'points_used' => $points_used,
            'active_point' => $active,
            'used_point' => $all_used,
            'total_point' => $all_active,
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
