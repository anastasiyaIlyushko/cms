<?php

class DefaultController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/admin/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
                //'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'move', 'visible'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Page;
        $availableParentPages = Page::model()->findAll("parentId=:parentId AND isDelete=0", array("parentId" => 0));
        $parentPages = array(0 => '');
        foreach ($availableParentPages as $oneParentPage) {
            $parentPages[$oneParentPage->id] = $oneParentPage->menuTitle;
        }

        $deletedPages = Page::model()->findAll(array('select' => 'pageTitle', 'condition' => 'isDelete=1'));
        foreach ($deletedPages as $oneDeletePage) {
            $delPages[] = $oneDeletePage->pageTitle;
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);


        if (isset($_POST['Page'])) {
            $model->attributes = $_POST['Page'];

            if (in_array($model->pageTitle, $delPages)) {
                $almostExistPage = Page::model()->find('pageTitle=:pageTitle', array(':pageTitle' => $model->pageTitle));
                $almostExistPage->isDelete = 0;
                $almostExistPage->isShow = 0;
                if ($almostExistPage->save()) {
                    $this->redirect(array('admin'));
                }
            } else {
                $model->isShow = 0;
                $model->isDelete = 0;
                $model->type = 1;
                $model->sorter = Page::getSorterLimit('down') + 1;
                if ($model->save())
                    $this->redirect(array('admin'));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'availableParentPages' => $parentPages
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $availableParentPages = Page::model()->findAll("parentId=:parentId", array("parentId" => 0));
        $parentPages = array(0 => '');
        foreach ($availableParentPages as $oneParentPage) {
            $parentPages[$oneParentPage->id] = $oneParentPage->menuTitle;
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Page'])) {
            $model->attributes = $_POST['Page'];
            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('update', array(
            'model' => $model,
            'availableParentPages' => $parentPages
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);
            $model->isDelete = 1;
            $model->save();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionMove($id, $direction) {
        $model = $this->loadModel($id);
        $sorter = $model->sorter;
        switch ($direction) {
            case 'up':
                if ($sorter > Page::getSorterLimit($direction)) {
                    $criteria = new CDbCriteria;
                    $criteria->condition = 'sorter<:sorter';
                    $criteria->params = array(':sorter' => $sorter);
                    $criteria->order = 'sorter DESC';
                    $prevModel = Page::model()->find($criteria);

                    //$prevModel = Page::model()->find('sorter>:sorter', array(':sorter' => $sorter))->;
                    $model->sorter = $prevModel->sorter;
                    $model->save();
                    $prevModel->sorter = $sorter;
                    $prevModel->save();
                } else {
                    throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
                }
                break;
            case 'down':
                if ($sorter < Page::getSorterLimit($direction)) {
                    $criteria = new CDbCriteria;
                    $criteria->condition = 'sorter>:sorter';
                    $criteria->params = array(':sorter' => $sorter);
                    $criteria->order = 'sorter';
                    $nextModel = Page::model()->find($criteria);
                    $model->sorter = $nextModel->sorter;
                    $model->save();
                    $nextModel->sorter = $sorter;
                    $nextModel->save();
                } else {
                    throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
                }
                break;
            default :
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
        $this->redirect(array('admin'));
    }

    public function actionVisible($id) {
        $model = $this->loadModel($id);
        $model->isShow = ($model->isShow == 1) ? 0 : 1;
        $model->save();
        $this->redirect(array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Page');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Page('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Page']))
            $model->attributes = $_GET['Page'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Page::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'page-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
