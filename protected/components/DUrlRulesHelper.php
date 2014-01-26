<?php

class DUrlRulesHelper {

    protected static $data = array();

    public static function import($moduleName) {
        if ($moduleName && Yii::app()->hasModule($moduleName)) {
            if (!isset(self::$data[$moduleName])) {
                $class = ucfirst($moduleName) . 'Module';
                Yii::import($moduleName . '.' . $class);
                if (method_exists($class, 'getUrlRules')) {
                    $urlManager = Yii::app()->getUrlManager();
                    $urlManager->addRules(call_user_func($class . '::getUrlRules'));
                }
                self::$data[$moduleName] = true;
            }
        }
    }

}
