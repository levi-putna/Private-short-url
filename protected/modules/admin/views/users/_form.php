<section class="hbox stretch">

    <aside class="bg-light lter">

        <?php $form = $this->beginWidget('CActiveForm',
            array(
                 'id'                   => 'user-form',
                 'enableAjaxValidation' => false
            )
        ); ?>

        <header class="header bg-white b-b">
            <p class="h4">Admin Account Details</p>
            <?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary pull-right')); ?>
        </header>

        <section class="scrollable wrapper">

            <?php if (Yii::app()->user->hasFlash('success')): ?>
                <div class="flash-success alert alert-success">
                    <?= Yii::app()->user->getFlash('success'); ?>
                </div>
            <?php endif; ?>

            <?php if ($form->errorSummary($model)): ?>
                <div class="alert alert-danger">
                    <h4>Form Errors</h4>
                    <?= $form->errorSummary($model); ?>
                </div>
            <?php endif; ?>


            <div class="row">
                <div class="col-lg-6">
                    <div class=" form-group">
                        <?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'name', array('maxlength' => 40, 'class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'name'); ?>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class=" form-group">
                        <?php echo $form->labelEx($model, 'email', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'email', array('maxlength' => 40, 'class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'email'); ?>
                    </div>
                </div>
            </div>


            <div class="row">

                <div class="col-lg-6">
                    <div class=" form-group">
                        <?php echo $form->labelEx($model, 'role'); ?>
                        <?php
                        $this->widget(
                            'ext.select2.ESelect2',
                            array(
                                 'model'       => $model,
                                 'attribute'   => 'role',
                                 'data'        => array('admin' => 'Admin', 'superadmin' => 'System Admin'),
                                 'htmlOptions' => array(
                                     'class' => 'fit'
                                 ),
                            )
                        ); ?>
                        <?php echo $form->error($model, 'roll'); ?>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class=" form-group">
                        <?php echo $form->labelEx($model, 'date_format_id'); ?>
                        <?php
                        $this->widget(
                            'ext.select2.ESelect2',
                            array(
                                 'model'       => $model,
                                 'attribute'   => 'date_format_id',
                                 'data'        => CHtml::listData(DateFormat::model()->findAll(), 'id', 'name'),
                                 'htmlOptions' => array(
                                     'class' => 'fit'
                                 ),
                            )
                        ); ?>
                        <?php echo $form->error($model, 'date_format_id'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'password', array('class' => 'control-label')); ?>
                        <?php echo $form->passwordField($model, 'password', array('maxlength' => 35, 'class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'password'); ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'repeat_password', array('class' => 'control-label')); ?>
                        <?php echo $form->passwordField($model, 'repeat_password', array('maxlength' => 35, 'class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'repeat_password'); ?>
                    </div>
                </div>
            </div>


        </section>

        <?php $this->endWidget(); ?>
    </aside>

</section>