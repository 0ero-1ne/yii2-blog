<?php
namespace app\modules\sPages\modules\admin\controllers;

use Yii;
use app\modules\sPages\models\Article;
use app\modules\sPages\models\ArticleSearch;
use app\modules\sPages\models\ArticleTag;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
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
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->id != '100') {
            Yii::$app->getSession()->setFlash('error','Where are you trying to get?');
            return $this->goHome();
        }

        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->id != '100') {
            Yii::$app->getSession()->setFlash('error','Where are you trying to get?');
            return $this->goHome();
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->id != '100') {
            Yii::$app->getSession()->setFlash('error','Where are you trying to get?');
            return $this->goHome();
        }

        $model = new Article();

        if ($model->load(Yii::$app->request->post())) {
            $tags = $model->number_of_tags;
            $title = $model->title;
            $rating = $model->rating;

            $model->number_of_tags = count($tags);
            $date = date("Y-m-d H:i:s");
            $model->date_create = $date;
            $model->date_update = $date;
            $status = $model->status;

            if (empty($tags)) {
                Yii::$app->getSession()->setFlash('error','
You have not selected tags!');
            } else{
                if($model->save()){
                    $article = $model->id;
                    
                    foreach ($tags as $tag) {
                        $art_tag = new ArticleTag();
                        $art_tag->article_id = $article;
                        $art_tag->tag_id = $tag;
                        $art_tag->article_status = $status;
                        $art_tag->article_title = $title;
                        $art_tag->article_datecr = $date;
                        $art_tag->article_dateup = $date;
                        $art_tag->article_rating = $rating;
                        $art_tag->save();
                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->id != '100') {
            Yii::$app->getSession()->setFlash('error','Where are you trying to get?');
            return $this->goHome();
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $tags = $model->number_of_tags;
            $datecr = $model->date_create;
            $title = $model->title;
            $rating = $model->rating;

            $model->number_of_tags = count($tags);
            $date = date("Y-m-d H:i:s");
            $model->date_update = $date;
            $status = $model->status;

            if (empty($tags)) {
                Yii::$app->getSession()->setFlash('error','
You have not selected tags!');
            } else{
                if ($model->save()) {
                    ArticleTag::deleteAll(['article_id' => $model->id]);

                    foreach ($tags as $tag) {
                        $art_tag = new ArticleTag();
                        $art_tag->article_id = $model->id;
                        $art_tag->tag_id = $tag;
                        $art_tag->article_status = $status;
                        $art_tag->article_title = $title;
                        $art_tag->article_datecr = $datecr;
                        $art_tag->article_dateup = $date;
                        $art_tag->article_rating = $rating;
                        $art_tag->save();
                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                }    
            }

            
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->id != '100') {
            Yii::$app->getSession()->setFlash('error','Where are you trying to get?');
            return $this->goHome();
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->id != '100') {
            Yii::$app->getSession()->setFlash('error','Where are you trying to get?');
            return $this->goHome();
        }

        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
