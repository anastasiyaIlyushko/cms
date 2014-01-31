<?php

class MenuItemsHelper {

    public static function getMenuItems() {
        $currentModuleName = DModuleUrlRulesBehavior::getCurrentModuleName();
        $pages = Page::model()->findAll('isDelete = 0 AND isShow = 1');
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
