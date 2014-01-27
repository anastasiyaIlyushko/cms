<?php
/**********************************************************************************************
*                            CMS Open Business Card
*                              -----------------
*	version				:	1.2.0
*	copyright			:	(c) 2013 Monoray
*	website				:	http://www.monoray.ru/
*	contact us			:	http://www.monoray.ru/contact
*
* This file is part of CMS Open Business Card
*
* Open Business Card is free software. This work is licensed under a GNU GPL.
* http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*
* Open Business Card is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
* Without even the implied warranty of  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
***********************************************************************************************/

Yii::import('bootstrap.widgets.TbGridView');
Yii::import('page.models.*');
DUrlRulesHelper::import('page');

class CustomGridView extends TbGridView {
	//public $pager = array('class'=>'itemPaginator');
	public $template = "{summary}\n{pager}\n{items}\n{pager}";

    public $type = 'striped bordered condensed';

}