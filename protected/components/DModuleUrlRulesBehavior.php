<?php

class DModuleUrlRulesBehavior extends CBehavior {

    public $beforeCurrentModule = array();
    public $afterCurrentModule = array();

    public function events() {
        return array_merge(parent::events(), array(
            'onBeginRequest' => 'beginRequest',
        ));
    }

    public function beginRequest($event) {
        $module = self::getCurrentModuleName();

        $list = array_merge(
                $this->beforeCurrentModule, array($module), $this->afterCurrentModule
        );


        foreach ($list as $name)
            DUrlRulesHelper::import($name);
    }

    public static function getCurrentModuleName() {
        $route = Yii::app()->getRequest()->getPathInfo();
        $domains = explode('/', $route);
        $moduleName = array_shift($domains);
        return $moduleName;
    }

}
