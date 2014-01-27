<?php
$this->breadcrumbs = array(
    'Pages' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Page', 'url' => array('index')),
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
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'page-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //'id',
        //'parentId',
        'menuTitle',
        //'pageTitle',
        //'content',
        'seoTitle',
        'seoDescription',
        'seoKeywords',
        'isShow',
        'isDelete',
        //'type',
        //'sorter',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));

$this->widget('CustomGridView', array(
    'id' => 'menumanager-grid',
    'dataProvider' => $model->search(),
    'afterAjaxUpdate' => 'function(){$("a[rel=\'tooltip\']").tooltip(); $("div.tooltip-arrow").remove(); $("div.tooltip-inner").remove();}',
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'isShow',
            'type' => 'raw',
            'value' => '$data->isShow',
            'htmlOptions' => array('class' => 'span1'),
            'filter' => false,
        ),
        array(
            'name' => 'menuTitle',
            'type' => 'raw',
            //'value' => '$data->getTitle()',
            //'value' => '$data->menuTitle',
            //'htmlOptions' => array('class' => 'span2'),
            'sortable' => false,
        ),
        array(
            'name' => 'pageTitle',
            //'value' => '$data->pageTitle',
            //'htmlOptions' => array('class' => 'span2'),
            'sortable' => false,
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{up}{down}{update}{delete}',
            'deleteConfirmation' => 'Вы действительно хотите удалить выбранный пункт?',
            //'viewButtonUrl' => "Yii::app()->createUrl('/menumanager/backend/main/view', array('id' => \$data->id))",
            'htmlOptions' => array('class' => 'buttons_column'),
            'buttons' => array(
                'up' => array(
                    'label' => 'Переместить выше',
                    'imageUrl' => $url = Yii::app()->assetManager->publish(
                    Yii::getPathOfAlias('zii.widgets.assets.gridview') . '/up.gif'
                    ),
                    'url' => 'Yii::app()->createUrl("/admin/page/default/move", array("id"=>$data->id, "direction" => "up"))',
                    'options' => array('class' => 'arrow_image_up'),
                    //'visible' => '$data->sorter > "'.$minSorter.'"',
                    'visible' => '$data->sorter > "' . '1' . '"',
                    'click' => "js: function() { ajaxMoveRequest($(this).attr('href'), 'menumanager-grid'); return false;}",
                ),
                'down' => array(
                    'label' => 'Переместить ниже',
                    'imageUrl' => $url = Yii::app()->assetManager->publish(
                    Yii::getPathOfAlias('zii.widgets.assets.gridview') . '/down.gif'
                    ),
                    'url' => 'Yii::app()->createUrl("/menumanager/backend/main/move", array("id"=>$data->id, "direction" => "down"))',
                    'options' => array('class' => 'arrow_image_down'),
                    //'visible' => '$data->sorter < "'.$maxSorter.'"',
                    'visible' => '$data->sorter < "' . '3' . '"',
                    'click' => "js: function() { ajaxMoveRequest($(this).attr('href'), 'menumanager-grid'); return false;}",
                ),
                'delete' => array(
                    'visible' => '$data->isShow',
                ),
            ),
        ),
    ),
));
?>
