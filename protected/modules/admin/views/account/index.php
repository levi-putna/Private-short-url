<section class="page page-filter">
    <?php

    $this->widget('GridView',
        array(
             'dataProvider' => $model->search(),

             'dblClick'     => '/account/details',
             'columns'      => array(
                 array(
                     'name'        => 'id',
                     'htmlOptions' => array('style' => 'width: 40px'),
                 ),

                 array(
                     'name' => 'given_name',
                 ),

                 array(
                     'name' => 'family_name',
                 ),

                 array(
                     'name' => 'email',
                 ),

                 array(
                     'name'        => 'role_id',
                     'htmlOptions' => array('style' => 'width: 150px'),
                     'value'       => '$data->role->label'
                 ),

                 array(
                     'name'        => 'date_created',
                     'htmlOptions' => array('style' => 'width: 200px'),
                     'value'       => 'date("d/m/Y" . " h:i e", strtotime($data->date_created))'
                 ),

                 array(
                     'name'        => 'last_login',
                     'htmlOptions' => array('style' => 'width: 200px'),
                     'value'       => 'date("d/m/Y" . " h:i e", strtotime($data->last_login))'
                 ),
             ),
        )
    );

    ?>
    <!-- Your custom menu with dropdown-menu as default styling -->
    <div id="context-menu">
        <ul class="dropdown-menu" role="menu">
            <li><a tabindex="-1"><i class="fa fa-fw"></i> Edit</a></li>
            <li class="divider"></li>
            <li><a tabindex="-1"><i class="fa fa-fw"></i> Delete</a></li>
        </ul>
    </div>
</section>

<aside class="aside-lg filter">

    <div class="subtitle">Search Filter</div>

    <div class="pad-lg">
        <?php $form = $this->beginWidget(
            'CActiveForm',
            array(
                 'action' => '/account/',
                 'method' => 'get',
            )
        ); ?>

        <div class="form-group">
            <?php echo $form->label($model, 'id'); ?>
            <?php echo $form->textField($model, 'id', array('class' => 'form-control', 'maxlength' => 10)); ?>
        </div>

        <div class="form-group">
            <?php echo $form->label($model, 'email'); ?>
            <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'maxlength' => 50)); ?>
        </div>

        <div class="form-group">
            <?php echo $form->label($model, 'given_name'); ?>
            <?php echo $form->textField($model, 'given_name', array('class' => 'form-control', 'maxlength' => 500)); ?>
        </div>

        <div class="form-group">
            <?php echo $form->label($model, 'family_name'); ?>
            <?php echo $form->textField($model, 'family_name', array('class' => 'form-control', 'maxlength' => 50)); ?>
        </div>


        <div class="form-group">
            <?php echo $form->label($model, 'role_id'); ?>
            <?php
            $this->widget(
                'ext.select2.ESelect2',
                array(
                     'model'       => $model,
                     'attribute'   => 'role_id',
                     'data'        => CHtml::listData(Role::model()->findAll(array('order' => 'label ASC')), 'id', 'label'),
                     'htmlOptions' => array(
                         'empty' => 'All',
                         'class' => 'fit',
                     ),
                )
            ); ?>
        </div>

        <?php echo CHtml::submitButton('Filter', array('class' => 'btn btn-primary btn-block')); ?>

        <?php $this->endWidget(); ?>
    </div>
</aside>