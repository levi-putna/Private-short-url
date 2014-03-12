<section class="hbox stretch">

    <aside class="bg-light lter">

        <?php $form = $this->beginWidget('CActiveForm',
            array(
                 'id'                   => 'user-form',
                 'enableAjaxValidation' => false
            )
        ); ?>

        <header class="header bg-white b-b">
            <p class="h4">Change Account Password</p>
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
                        <?php echo $form->labelEx($model, 'new_password', array('class' => 'control-label')); ?>
                        <?php echo $form->passwordField($model,'new_password',array('maxlength'=>32, 'class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'new_password'); ?>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class=" form-group">
                        <?php echo $form->labelEx($model, 'repeat_password', array('class' => 'control-label')); ?>
                        <?php echo $form->passwordField($model,'repeat_password',array('maxlength' => 40, 'class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'repeat_password'); ?>
                    </div>
                </div>
            </div>

        </section>

        <?php $this->endWidget(); ?>
    </aside>

</section>











