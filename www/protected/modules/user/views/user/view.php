<?php
$this->breadcrumbs=array(
	/*UserModule::t('Players')=>array('index'),*/
	$model->username,
);
?>
<h1><?php echo UserModule::t('View User').' "'.$model->username.'"'; ?></h1>

<ul class="actions">
	<li><?php echo CHtml::link(UserModule::t('List User'),array('index')); ?></li>
</ul><!-- actions -->

<?php 

// For all users
	$attributes = array(
			'username',
	);
	
	array_push($attributes,
		array(
			'name' => 'created',
			'value' => $model->created,
		),
		array(
			'name' => 'lastvisit',
			'value' => (($model->lastvisit)?$model->lastvisit:UserModule::t('Not visited')),
		)
	);
			
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
	));

?>
