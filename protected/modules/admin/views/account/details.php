<aside class="details">
    <div class="padder">

        <section class="panel panel-page">
            <div class="user-heading alt gray-bg">
                <div class="icon">
                    <i class="fa fa-rocket"></i>
                </div>
                <h1><?= $model->given_name; ?>  <?= $model->family_name; ?></h1>

                <p><?= $model->role->label; ?></p>
            </div>
            <div class="meta">
                <ul>
                    <li class="active">
                        <h5><?= date("d/m/Y" . " h:i e", strtotime($model->date_created)) ?></h5>
                        Created
                    </li>
                    <li>
                        <h5><?= date("d/m/Y" . " h:i e", strtotime($model->last_login)) ?></h5>
                        Last Login
                    </li>
                </ul>
            </div>
            <ul class="nav nav-pills nav-stacked">
                <li><a href="#"> <i class="fa fa-pencil"></i> Details</a></li>
                <li><a href="#"> <i class="fa fa-lock"></i> Change Password</a></li>

            </ul>
        </section>
    </div>

</aside>

<?php $form = $this->beginWidget('CActiveForm',
    array(
         'id'                   => 'competitions-form',
         'enableAjaxValidation' => false,
         'htmlOptions'          => array('class' => 'vbox')
    )
); ?>
<div class="panel panel-default page page-footer page-details">

    <?php if (Yii::app()->user->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php endif; ?>

    <?php if ($form->errorSummary($model)): ?>
        <div class="lash-errors bs-callout bs-callout-danger">
            <h4>Form Errors</h4>
            <?= $form->errorSummary($model); ?>
        </div>
    <?php endif; ?>

    <section class="panel-body ">
        <div class="row">
            <div class="form-group col-md-6">
                <?php echo $form->labelEx($model, 'given_name'); ?>
                <?php echo $form->textField($model, 'given_name', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'given_name'); ?>
            </div>

            <div class="form-group col-md-6">
                <?php echo $form->labelEx($model, 'family_name'); ?>
                <?php echo $form->textField($model, 'family_name', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'family_name'); ?>

            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <?php echo $form->labelEx($model, 'email'); ?>
                <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'email'); ?>
            </div>

            <div class="form-group col-md-6">

                <?php echo $form->labelEx($model, 'role_id'); ?>
                <?php
                $this->widget(
                    'ext.select2.ESelect2',
                    array(
                         'model'       => $model,
                         'attribute'   => 'role_id',
                         'data'        => CHtml::listData(Role::model()->findAll(array('order' => 'label ASC')), 'id', 'label'),
                         'options'     => array(
                             'allowClear' => false,
                         ),
                         'htmlOptions' => array(
                             'empty' => '',
                         ),
                    )
                );
                ?>
                <?php echo $form->error($model, 'role_id'); ?>

            </div>
        </div>
    </section>

    <footer class="panel-footer footer footer-details clearfix">
        <?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary pull-right')); ?>
    </footer>

</div>
<?php $this->endWidget(); ?>



