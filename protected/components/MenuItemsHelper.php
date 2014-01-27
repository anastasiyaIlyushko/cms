<?php

class MenuItemsHelper {

    public static function getMenuItems() {
        $currentModuleName = DModuleUrlRulesBehavior::getCurrentModuleName();
        $pages = Page::model()->findAll();
        $menuItems = array();
        foreach ($pages as $onePage) {
            $onePageParam = array();
            $onePageParam['label'] = $onePage->menuTitle;
            $onePageParam['url'] = $onePage->pageTitle;
            if ($currentModuleName == $onePage->pageTitle) {
                $onePageParam['active'] = TRUE;
            }
            $menuItems[] = $onePageParam;
        }


        return $menuItems;
    }

}
