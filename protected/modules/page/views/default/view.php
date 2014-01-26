<?php
$this->pageTitle = $model->seoTitle;
$this->pageKeywords = $model->seoKeywords;
$this->pageDescription = $model->seoDescription;
        
        
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->menuTitle,
);

//$this->menu=array(
//	array('label'=>'List Page','url'=>array('index')),
//	array('label'=>'Create Page','url'=>array('create')),
//	array('label'=>'Update Page','url'=>array('update','id'=>$model->id)),
//	array('label'=>'Delete Page','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Page','url'=>array('admin')),
//);
?>

<h1><?php echo $model->menuTitle; ?></h1>
<?php echo $model->content; ?>

<?php 
//$this->widget('bootstrap.widgets.TbDetailView',array(
//	'data'=>$model,
//	'attributes'=>array(
//		'id',
//		'parentId',
//		'menuTitle',
//		'pageTitle',
//		'content',
//		'seoTitle',
//		'seoDescription',
//		'seoKeywords',
//		'isShow',
//		'isDelete',
//		'type',
//		'sorter',
//	),
//)); 
?>
