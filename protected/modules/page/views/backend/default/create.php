<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Page','url'=>array('index')),
	array('label'=>'Manage Page','url'=>array('admin')),
);
?>

<h1>Создать новую страницу</h1>

<?php echo $this->renderPartial('_form', array(
    'model'=>$model,
    'availableParentPages'=>$availableParentPages)); ?>