<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//sarray('label'=>'List Page','url'=>array('index')),
	array('label'=>'Create Page','url'=>array('create')),
	//array('label'=>'View Page','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Page','url'=>array('admin')),
);
?>

<h1>Обновить страницу <?php echo $model->menuTitle; ?></h1>

<?php echo $this->renderPartial('_form',array(
    'model'=>$model,
    'availableParentPages'=>$availableParentPages)); ?>