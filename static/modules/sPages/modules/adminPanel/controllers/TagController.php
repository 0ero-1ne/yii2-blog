<?php

namespace app\modules\sPages\modules\adminPanel\controllers;

use Yii;
use app\modules\sPages\modules\adminPanel\models\Tag;
use app\modules\sPages\modules\adminPanel\models\TagSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * TagController implements the CRUD actions for Tag model.
 */
class TagController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tag models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('warning','Stop! Who are you?');
            return $this->redirect('site/login');
        }

        if (Yii::$app->user->id != '100') {
            Yii::$app->getSession()->setFlash('error','Stop! You do not have access to the admin panel!');
            return $this->goHome();
        }

        $searchModel = new TagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = Tag::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays a single Tag model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('warning','Stop! Who are you?');
            return $this->redirect('site/login');
        }

        if (Yii::$app->user->id != '100') {
            Yii::$app->getSession()->setFlash('error','Stop! You do not have access to the admin panel!');
            return $this->goHome();
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('warning','Stop! Who are you?');
            return $this->redirect('site/login');
        }

        if (Yii::$app->user->id != '100') {
            Yii::$app->getSession()->setFlash('error','Stop! You do not have access to the admin panel!');
            return $this->goHome();
        }

        $model = new Tag();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('warning','Stop! Who are you?');
            return $this->redirect('site/login');
        }

        if (Yii::$app->user->id != '100') {
            Yii::$app->getSession()->setFlash('error','Stop! You do not have access to the admin panel!');
            return $this->goHome();
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('warning','Stop! Who are you?');
            return $this->redirect('site/login');
        }

        if (Yii::$app->user->id != '100') {
            Yii::$app->getSession()->setFlash('error','Stop! You do not have access to the admin panel!');
            return $this->goHome();
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('warning','Stop! Who are you?');
            return $this->redirect('site/login');
        }

        if (Yii::$app->user->id != '100') {
            Yii::$app->getSession()->setFlash('error','Stop! You do not have access to the admin panel!');
            return $this->goHome();
        }

        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
