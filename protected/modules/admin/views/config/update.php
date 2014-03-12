<?php
$this->breadcrumbs=array(
	'Configs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Config', 'url'=>array('index')),
//	array('label'=>'View Config', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>