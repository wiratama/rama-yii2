<?php

namespace backend\controllers;

use Yii;
use backend\models\Product;
use backend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete','getcity'],
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
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Product();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->file_image = UploadedFile::getInstance($model, 'file_image');
            // $image_name=$this->slugify($model->name);
            
            $base_image_directory="/uploads/products/";
            $full_image_directory=Yii::$app->getBasePath()."/..".$base_image_directory;
            $model->image=$base_image_directory.$model->file_image->baseName.".".$model->file_image->extension;

            if ($model->save()) {
                $model->upload($full_image_directory,$model->file_image->baseName);
                return $this->redirect(['view', 'id' => $model->id_product]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldimage=$model->image;

        if ($model->load(Yii::$app->request->post())) {
            $base_image_directory="/uploads/products/";
            $full_image_directory=Yii::$app->getBasePath()."/..".$base_image_directory;

            $model->file_image=UploadedFile::getInstance($model, 'file_image');
            if(strlen(trim($model->file_image)) > 0) {
                if (!empty($oldimage) and $oldimage!='.' and file_exists(Yii::$app->getBasePath()."/..".$oldimage)) {
                    unlink(Yii::$app->getBasePath()."/..".$oldimage);
                }
                $model->image=$base_image_directory.$model->file_image->baseName.".".$model->file_image->extension;
            } else {
                $model->image=$oldimage;
            }

            if ($model->save()) {
                if ($model->image!=$oldimage) {
                    $model->upload($full_image_directory,$model->file_image->baseName);
                }
                return $this->redirect(['view', 'id' => $model->id_product]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        if (!empty($model->image) and $model->image!='.' and file_exists(Yii::$app->getBasePath()."/..".$model->image)) {
            unlink(Yii::$app->getBasePath()."/..".$model->image);
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // newadded
    public function slugify($text)
    { 
        if (!empty($text)) {
            // replace non letter or digits by -
            $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
            // trim
            $text = trim($text, '-');
            // transliterate
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
            // lowercase
            $text = strtolower($text);
            // remove unwanted characters
            $text = preg_replace('~[^-\w]+~', '', $text);
            return $text;
        } else {
            return false;
        }
    }
    // newadded
}
