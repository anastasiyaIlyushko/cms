<?php

class DefaultController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView() {
        if (!isset($pageTitle)) {
            $pageTitle = 'home'; //Главная
        }

        $this->render('view', array(
            'model' => $this->loadModel($pageTitle),
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($pageTitle) {
        $model = Page::model()->find('pageTitle=:pageTitle', array(':pageTitle' => $pageTitle));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public static function getMenuItems() {
        $currentModuleName = DModuleUrlRulesBehavior::getCurrentModuleName();
        $pages = Page::model()->findAll();
        $menuItems = array();
        foreach ($pages as $onePage) {
            $onePageParam = array();
            $onePageParam['label'] = $onePage->label;
            $onePageParam['url'] = $onePage->pageTitle;
            if ($currentModuleName == $onePage->pageTitle) {
                $onePageParam['active'] = TRUE;
            }


            $menuItems[] = $onePageParam;
        }
        return $menuItems;
    }

}
