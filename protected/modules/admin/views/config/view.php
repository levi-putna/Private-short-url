<?php
$this->breadcrumbs=array(
	'Configs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Config', 'url'=>array('index')),
	array('label'=>'Update Config', 'url'=>array('update', 'id'=>$model->id)),
);
?>

<h1>View Config #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'value',
	),
)); ?>
