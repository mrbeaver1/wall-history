<?php

namespace frontend\controllers;

use common\DTO\CreatePostData;
use common\models\Post;
use common\models\search\Post as PostSearch;
use common\Services\PostService;
use Exception;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @var PostService
     */
    private PostService $postService;

    /**
     * @param                  $id
     * @param                  $module
     * @param                  $config
     * @param PostService|null $postService
     */
    public function __construct($id, $module, $config, ?PostService $postService)
    {
        parent::__construct($id, $module, $config);

        $this->postService = $postService;
    }

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Post models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $createDto = new CreatePostData();
        $createDto->loadFromRequest($this->request);
        try {
            $this->postService->create($createDto);

            return $this->redirect(['index']);
        } catch (Exception $e) {
            Yii::$app->getSession()->addFlash('danger', $e->getMessage());
            return $this->redirect(['index']);
        }
    }

    public function actionReadme()
    {
        $readme = @file_get_contents('../../README.md') ?? Yii::t('post', 'File README.md not found');
        return $this->render('readme', [
            'readme' => $readme,
        ]);
    }
}
