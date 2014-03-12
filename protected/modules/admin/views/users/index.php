<section class="hbox stretch">
    <aside class="bg-light lter">
        <section class="vbox">
            <header class="bg-light dker header clearfix">
                <a herf="/users/create/" class="btn btn-sm btn-white pull-right"><i class="icon-chevron-left"></i> Create Account</a>
                <p class="h4">Competitions</p>
            </header>
            <section class="scrollable hover w-f">


                <?php

                $this->widget('GridView',
                    array(
                         'dataProvider'     => $model->search(),
                         'selectionChanged' => "function(id){window.location='/users/details/' + $.fn.yiiGridView.getSelection(id);}",
                         'columns'          => array(
                             array(
                                 'name'        => 'id',
                                 'htmlOptions' => array('style' => 'width: 40px'),
                             ),
                             array(
                                 'name'  => 'name',
                                 'htmlOptions'=>array('width'=>'180px'),
                                 'value' => '$data->name',
                                 'type'  => 'raw',
                             ),
                             array(
                                 'name'  => 'email',
                                 'value' => '$data->email',
                                 'type'  => 'raw',
                             ),
                             array(
                                 'name'  => 'role',
                                 'htmlOptions'=>array('width'=>'100px'),
                                 'value' => '$data->role',
                             ),
                             array(
                                 'name'  => 'date_added',
                                 'value' => '$data->date_added',
                                 'htmlOptions'=>array('width'=>'150px'),
                                 'type'  => 'raw',
                                 'value' => 'date(Yii::app()->user->getDateFormat(), strtotime($data->date_added))'
                             ),
                             array(
                                 'name'   => 'status',
                                 'htmlOptions'=>array('width'=>'100px'),
                                 'value'  => '($data->status == 1)? "active":"suspended"',

                             ),
                         ),
                    )
                );

                ?>

            </section>
            <footer class="footer b-t bg-white-only">

            </footer>
        </section>
    </aside>
    <aside class="aside-lg bg-light">
        <?php $form = $this->beginWidget(
            'CActiveForm',
            array(
                 'action' => '/competitions/',
                 'method' => 'get',
            )
        ); ?>

        <header class="dk header">
            <?php echo CHtml::submitButton('Filter', array('class' => 'btn btn-primary pull-right')); ?>
        </header>

        <div class="wrapper">

            <div class="form-group">
                <?php echo $form->label($model, 'id'); ?>
                <?php echo $form->textField($model, 'id', array('class' => 'form-control', 'maxlength' => 20)); ?>
            </div>

            <div class="form-group">
                <?php echo $form->label($model, 'email'); ?>
                <?php $this->widget(
                    'ext.select2.ESelect2',
                    array(
                         'model'       => $model,
                         'attribute'   => 'status',
                         'data'        => array('open' => 'open', 'close' => 'close'),
                         'options'     => array(
                             'allowClear' => true,
                         ),
                         'htmlOptions' => array(
                             'empty' => '&nbsp;',
                             'class' => 'fit'
                         ),
                    )
                ); ?>
            </div>

            <div class="form-group">
                <?php echo $form->label($model, 'name'); ?>
                <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'maxlength' => 100)); ?>
            </div>
        </div>

        <?php $this->endWidget(); ?>
    </aside>
</section>