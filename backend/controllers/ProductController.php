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
use yii\web\ForbiddenHttpException;
use backend\models\ProductCategory;

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
        if (\Yii::$app->user->can('view-product')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            throw new ForbiddenHttpException('You are not allowed to access this page');
            
        }
    }

    public function actionCreate()
    {
        if (\Yii::$app->user->can('create-product')) {
            $model = new Product();
            $model2 = new ProductCategory();
            
            if ($model->load(Yii::$app->request->post())) {
                $model->file_image = UploadedFile::getInstance($model, 'file_image');
                // $image_name=$this->slugify($model->name);
                
                $base_image_directory="/uploads/products/";
                $full_image_directory=Yii::$app->getBasePath()."/..".$base_image_directory;
                $model->image=$base_image_directory.$model->file_image->baseName.".".$model->file_image->extension;

                if ($model->save()) {
                    $model->upload($full_image_directory,$model->file_image->baseName);

                    if ($model2->load(Yii::$app->request->post())) {
                        if (!empty(Yii::$app->request->post('ProductCategory')['id_category'])) {
                            foreach(Yii::$app->request->post('ProductCategory')['id_category'] as $category) {
                                $model2 = new ProductCategory();
                                $model2->id_product=$model->id_product;
                                $model2->id_category=$category;
                                $model2->save();
                            }
                        }
                    }
                    
                    return $this->redirect(['view', 'id' => $model->id_product]);
                }
            }

            return $this->render('create', [
                'model' => $model,
                'model2' => $model2,
            ]);
        } else {
            throw new ForbiddenHttpException('You are not allowed to access this page');
            
        }
    }

    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('update-product')) {
            $model = $this->findModel($id);
            $oldimage=$model->image;
            $model2 = new ProductCategory();

            $categories = ProductCategory::find()->where(['id_product' => $id])->all();
            $selected=[];
            foreach($categories as $category) {
                $selected[]=$category->id_category;
            }
            $model2->id_category=$selected;

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

                    if ($model2->load(Yii::$app->request->post())) {
                        ProductCategory::deleteAll('id_product = :id', [':id' => $id]);
                        if (!empty(Yii::$app->request->post('ProductCategory')['id_category'])) {
                            foreach(Yii::$app->request->post('ProductCategory')['id_category'] as $category) {
                                $model2 = new ProductCategory();
                                $model2->id_product=$model->id_product;
                                $model2->id_category=$category;
                                $model2->save();
                            }
                        }
                    }
                    return $this->redirect(['view', 'id' => $model->id_product]);
                }
            }

            return $this->render('update', [
                'model' => $model,
                'model2' => $model2,
            ]);
        } else {
            throw new ForbiddenHttpException('You are not allowed to access this page');
            
        }
    }

    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('delete-product')) {
            $model=$this->findModel($id);
            if (!empty($model->image) and $model->image!='.' and file_exists(Yii::$app->getBasePath()."/..".$model->image)) {
                unlink(Yii::$app->getBasePath()."/..".$model->image);
            }
            $model->delete();
        } else {
            throw new ForbiddenHttpException('You are not allowed to access this page');
            
        }

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
