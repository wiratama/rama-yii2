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
			throw new \Exception('You are not allowed to access this page');
			
		}
	}

	public function actionCreate()
	{
		if (\Yii::$app->user->can('create-member')) {
			$model = new Member(['scenario' => 'register']);

			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->id_member]);
			} else {
				return $this->render('create', [
					'model' => $model,
				]);
			}
		} else {
			throw new \Exception('You are not allowed to access this page');
			
		}
		
	}

	public function actionUpdate($id)
	{
		if (\Yii::$app->user->can('update-member')) {
			$model = $this->findModel($id);
			$oldpassword=$model->password;
			$model->password='';

			if ($model->load(Yii::$app->request->post())) {
				$post_member=Yii::$app->request->post('Member');
				if(empty($post_member['password'])) {
					$model->password=$oldpassword;
				}

				if ($model->save()) {
					return $this->redirect(['view', 'id' => $model->id_member]);
				} else {
					return $this->render('update', [
						'model' => $model,
					]);
				}
			} else {
				return $this->render('update', [
					'model' => $model,
				]);
			}
		} else {
			throw new \Exception('You are not allowed to access this page');
			
		}
	}

	public function actionDelete($id)
	{
		if (\Yii::$app->user->can('delete-member')) {
			$this->findModel($id)->delete();
			return $this->redirect(['index']);
		} else {
			throw new \Exception('You are not allowed to access this page');
			
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
