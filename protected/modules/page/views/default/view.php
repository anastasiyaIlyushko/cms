<?php
$this->pageTitle = $model->seoTitle;
$this->pageKeywords = $model->seoKeywords;
$this->pageDescription = $model->seoDescription;
        
        
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->menuTitle,
);

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
