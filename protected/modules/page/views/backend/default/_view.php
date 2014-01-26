<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parentId')); ?>:</b>
	<?php echo CHtml::encode($data->parentId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('menuTitle')); ?>:</b>
	<?php echo CHtml::encode($data->menuTitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pageTitle')); ?>:</b>
	<?php echo CHtml::encode($data->pageTitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seoTitle')); ?>:</b>
	<?php echo CHtml::encode($data->seoTitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seoDescription')); ?>:</b>
	<?php echo CHtml::encode($data->seoDescription); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('seoKeywords')); ?>:</b>
	<?php echo CHtml::encode($data->seoKeywords); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isShow')); ?>:</b>
	<?php echo CHtml::encode($data->isShow); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isDelete')); ?>:</b>
	<?php echo CHtml::encode($data->isDelete); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sorter')); ?>:</b>
	<?php echo CHtml::encode($data->sorter); ?>
	<br />

	*/ ?>

</div>