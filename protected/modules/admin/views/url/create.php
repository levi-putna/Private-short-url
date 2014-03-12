<section class="section">
    <div class="url">
        <?php $form = $this->beginWidget(
            'CActiveForm',
            array(
                 'action' => '/url/create',
                 'method' => 'post',
            )
        ); ?>
        <div class="input-group input-group-lg">

            <?php echo $form->textField($model, 'url', array('class' => 'form-control', 'maxlength' => 255, 'placeholder' => 'http://example.com/?utm_source=facebook')); ?>

            <span class="input-group-btn">
                <?php echo CHtml::submitButton('Create', array('class' => 'btn btn-primary')); ?>
            </span>

        </div>
        <?php $this->endWidget(); ?>
        <div class="text-light text-small text-center">Enter a url above to shorten it. Note, if you enter a URL that is
            already in use by the system, no new URL will be created.
        </div>
    </div>

    <?php if (Yii::app()->user->hasFlash('error')): ?>
        <div class="error-message">
            <div class="ribon ribon-red">
                <i class="fa fa-exclamation-circle"></i>
            </div>
            <?php echo Yii::app()->user->getFlash('error'); ?>
        </div>
    <?php endif; ?>

</section>

<aside class="aside">
    <div class="wrapper dark">

        <h2>Filter</h2>
        <?php $form = $this->beginWidget(
            'CActiveForm',
            array(
                 'action' => '/',
                 'method' => 'get',
            )
        ); ?>

        <div class="form-group">
            <?php echo $form->label($model, 'id'); ?>
            <?php echo $form->textField($model, 'id', array('class' => 'form-control', 'maxlength' => 10)); ?>
        </div>

        <div class="form-group">
            <?php echo $form->label($model, 'url'); ?>
            <?php echo $form->textField($model, 'url', array('class' => 'form-control', 'maxlength' => 255)); ?>
        </div>

        <div class="form-group">
            <?php echo $form->label($model, 'key'); ?>
            <?php echo $form->textField($model, 'key', array('class' => 'form-control', 'maxlength' => 45)); ?>
        </div>

        <div class="form-group">
            <?php echo $form->label($model, 'alias'); ?>
            <?php echo $form->textField($model, 'alias', array('class' => 'form-control', 'maxlength' => 45)); ?>
        </div>

        <?php echo CHtml::submitButton('Filter', array('class' => 'btn btn-primary btn-block')); ?>

        <?php $this->endWidget(); ?>
    </div>
</aside>