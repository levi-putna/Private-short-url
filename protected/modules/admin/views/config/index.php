<?php
$this->breadcrumbs=array(
	'Configs',
);
?>

<h1>Configs</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'competition-grid',
	'dataProvider'=>$model->search(),
    'htmlOptions'=>array('class'=>'table table-striped'),
    'cssFile'=>false,
    'pagerCssClass'=>'pagination',
    'pager'=>array(
        'cssFile'=>false,
        'hiddenPageCssClass'=>'disabled',
        'selectedPageCssClass'=>'active',
        'header'=>'',
    ),
	'filter'=>$model,
	'columns'=>array(
        array(
            'name'=>'id',
            'htmlOptions'=>array('style'=>'width: 40px'),
        ),
        array(
            'name'=>'name',
            'value'=>'$data->name',
        ),
        array(
            'name'=>'value',
            'value'=>'$data->value',
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}',
            'htmlOptions'=>array('style'=>'text-align: center'),
            'buttons'=>array(
                'update'=>array(
                    'label'=>'<span class="label">edit</span>',
                    'imageUrl'=>false,
                    
                ),
            ),
		),
	),
)); ?>

<script type="text/javascript">
    function checkEntry(){
        if(!confirm('Are you sure you want to delete this item?')) return false;
        var th=this;
        var afterDelete=function(){};
        $.fn.yiiGridView.update('config-grid', {
            type:'POST',
            url:$(this).attr('href'),
            success:function(data) {
                $.fn.yiiGridView.update('config-grid');
                afterDelete(th,true,data);
            },
            error:function(XHR) {
                return afterDelete(th,false,XHR);
            }
        });
        return false;
    }
</script>


<?php /* $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */ ?>
