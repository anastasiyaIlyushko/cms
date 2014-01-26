<?php

class PageModule extends CWebModule {

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'page.models.*',
            'page.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else
            return false;
    }
    
    public static function getUrlRules()
    {
        return array(
            
            '/'=>'page/default/view',
            '/<pageTitle:\w+>'=>'page/default/view',
//            'blog/feed'=>'blog/feed/index',
//            'blog/search'=>'blog/default/search',
//            'blog/tag/<tag:[\w-]+>'=>'blog/default/tag',
//            'blog/date/<date:[\w-]+>'=>'blog/default/date',
//            'blog/<id:[\d]+>'=>'blog/post/view',
//            'blog/category/<category:.+>'=>'blog/default/category',
        );
    }

}
