<?php

namespace backend\controllers;

use Yii;
use backend\models\Member;
use backend\models\MemberSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\City;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;
use backend\models\MemberCategory;

class MemberController extends Controller
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
		$searchModel = new MemberSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionView($id)
	{
		if (\Yii::$app->user->can('create-member')) {
			return $this->render('view', [
				'model' => $this->findModel($id),
			]);
		} else {
			throw new ForbiddenHttpException('You are not allowed to access this page');
			
		}
	}

	public function actionCreate()
	{
		if (\Yii::$app->user->can('create-member')) {
			$model = new Member(['scenario' => 'register']);
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

					return $this->redirect(['view', 'id' => $model->id_member]);
				}
			} else {
				return $this->render('create', [
					'model' => $model,
					// 'model2' => $model2,
				]);
			}
		} else {
			throw new ForbiddenHttpException('You are not allowed to access this page');
			
		}
		
	}

	public function actionUpdate($id)
	{
		if (\Yii::$app->user->can('update-member')) {
			$model = $this->findModel($id);
			$oldpassword=$model->password;
			$oldimage=$model->avatar;
			$model->password='';
			// $model2 = new MemberCategory();

			// $categories = MemberCategory::find()->where(['id_member' => $id])->all();
			// $selected=[];
			// foreach($categories as $category) {
			// 	$selected[]=$category->id_category;
			// }
			// $model2->id_category=$selected;

			if ($model->load(Yii::$app->request->post())) {
				$base_image_directory="/uploads/products/";
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

				$post_member=Yii::$app->request->post('Member');
				if(empty($post_member['password'])) {
					$model->password=$oldpassword;
				}

				if ($model->save()) {
					if ($model->avatar!=$oldimage) {
						$model->upload($full_image_directory,$model->email);
					}

					// if ($model2->load(Yii::$app->request->post())) {
					// 	MemberCategory::deleteAll('id_member = :id', [':id' => $id]);
					// 	if (!empty(Yii::$app->request->post('MemberCategory')['id_category'])) {
					// 		foreach(Yii::$app->request->post('MemberCategory')['id_category'] as $category) {
					// 			$model2 = new MemberCategory();
					// 			$model2->id_member=$model->id_member;
					// 			$model2->id_category=$category;
					// 			$model2->save();
					// 		}
					// 	}
					// }
					return $this->redirect(['view', 'id' => $model->id_member]);
				}
			} else {
				return $this->render('update', [
					'model' => $model,
					// 'model2' => $model2,
				]);
			}
		} else {
			throw new ForbiddenHttpException('You are not allowed to access this page');
			
		}
	}

	public function actionDelete($id)
	{
		if (\Yii::$app->user->can('delete-member')) {
			$this->findModel($id)->delete();
			return $this->redirect(['index']);
		} else {
			throw new ForbiddenHttpException('You are not allowed to access this page');
			
		}
	}

	protected function findModel($id)
	{
		if (($model = Member::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
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
}
