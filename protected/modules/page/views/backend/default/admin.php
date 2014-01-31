<?php
$this->breadcrumbs = array(
    'Pages' => array('index'),
    'Manage',
);

$this->menu = array(
    //array('label' => 'List Page', 'url' => array('index')),
    array('label' => 'Create Page', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('page-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Pages</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button btn')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
//$this->widget('bootstrap.widgets.TbGridView', array(
//    'id' => 'page-grid',
//    'dataProvider' => $model->search(),
//    'filter' => $model,
//    'columns' => array(
//        //'id',
//        //'parentId',
//        'menuTitle',
//        //'pageTitle',
//        //'content',
//        'seoTitle',
//        'seoDescription',
//        'seoKeywords',
//        'isShow',
//        'isDelete',
//        //'type',
//        //'sorter',
//        array(
//            'class' => 'bootstrap.widgets.TbButtonColumn',
//        ),
//    ),
//));

$this->widget('CustomGridView', array(
    'id' => 'menumanager-grid',
    'dataProvider' => $model->search(),
    'afterAjaxUpdate' => 'function(){$("a[rel=\'tooltip\']").tooltip(); $("div.tooltip-arrow").remove(); $("div.tooltip-inner").remove();}',
    //'filter' => $model,
    'columns' => array(
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{show} {hide}',
            'htmlOptions' => array('class' => 'buttons_column'),
            'buttons' => array(
                'show' => array(
                    'icon' => 'icon-eye-open',
                    'options' => array('class' => 'icon-eye-open'),
                    'label' => 'Скрыть пункт',
                    'visible' => '$data->isShow',
                    'url' => 'Yii::app()->createUrl("/admin/page/default/visible", array("id"=>$data->id))',
                    'click' => "js: function() { ajaxMoveRequest($(this).attr('href'), 'menumanager-grid'); return false;}",
                ),
                 'hide' => array(
                    'icon' => 'icon-eye-open',
                    'options' => array('class' => 'icon-eye-close'),
                    'label' => 'Показать пункт',
                    'visible' => '!$data->isShow',
                    'url' => 'Yii::app()->createUrl("/admin/page/default/visible", array("id"=>$data->id))',
                    'click' => "js: function() { ajaxMoveRequest($(this).attr('href'), 'menumanager-grid'); return false;}",
                ),
                
            ),
        ),
        array(
            'name' => 'menuTitle',
            'type' => 'raw',
            'sortable' => false,
        ),
        array(
            'name' => 'pageTitle',
            'sortable' => false,
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{up}{down}{update}{delete}',
            'deleteConfirmation' => 'Вы действительно хотите удалить выбранный пункт?',
            'htmlOptions' => array('class' => 'buttons_column'),
            'buttons' => array(
                'up' => array(
                    'label' => 'Переместить выше',
                    'imageUrl' => $url = Yii::app()->assetManager->publish(
                    Yii::getPathOfAlias('zii.widgets.assets.gridview') . '/up.gif'
                    ),
                    'url' => 'Yii::app()->createUrl("/admin/page/default/move", array("id"=>$data->id, "direction" => "up"))',
                    'options' => array('class' => 'arrow_image_up'),
                    'visible' => '$data->sorter > $data->getSorterLimit("up")',
                    'click' => "js: function() { ajaxMoveRequest($(this).attr('href'), 'menumanager-grid'); return false;}",
                ),
                'down' => array(
                    'label' => 'Переместить ниже',
                    'imageUrl' => $url = Yii::app()->assetManager->publish(
                    Yii::getPathOfAlias('zii.widgets.assets.gridview') . '/down.gif'
                    ),
                    'url' => 'Yii::app()->createUrl("/admin/page/default/move", array("id"=>$data->id, "direction" => "down"))',
                    'options' => array('class' => 'arrow_image_down'),
                    'visible' => '$data->sorter < $data->getSorterLimit("down")',
                    'click' => "js: function() { ajaxMoveRequest($(this).attr('href'), 'menumanager-grid'); return false;}",
                ),
                'delete' => array(
                    'visible' => '!$data->isDelete',
                ),
            ),
        ),
    ),
));
?>
