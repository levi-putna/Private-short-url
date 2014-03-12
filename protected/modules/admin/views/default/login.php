<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Admin Login';
?>

<div class="login">
    <h1 class="title">sign in</h1>

    <?php $form = $this->beginWidget('CActiveForm',
        array(
             'id'                     => 'form-signin',
             'enableClientValidation' => true,
             'clientOptions'          => array(
                 'validateOnSubmit' => true,
             ),
             'htmlOptions'            => array(
                 'class' => 'form-signin'
             ),
        )
    ); ?>



    <?php if (Yii::app()->user->hasFlash('error')): ?>
        <div class="message message-error">
            <div class="ribon ribon-red">
                <i class="fa fa-exclamation-circle"></i>
            </div>
            <?php echo Yii::app()->user->getFlash('error'); ?>
        </div>
    <?php endif; ?>

    <div class="login-wrap">
        <div class="user-login-info">
            <?php echo $form->textField($model, 'username', array('type' => 'email', 'class' => 'form-control', 'placeholder' => 'Email')); ?>
            <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Password')); ?>
        </div>
        <label class="checkbox">
            <?php echo $form->checkBox($model, 'rememberMe'); ?> Remember me
                <span class="pull-right">
                    <a href="#myModal" data-toggle="modal"> Forgot Password?</a>
                </span>
        </label>
        <?php echo CHtml::submitButton('Sign in', array('class' => 'btn btn-lg btn-login btn-block')); ?>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Forgot Password ?</h4>
                </div>
                <div class="modal-body">
                    <p>Enter your e-mail address below to reset your password.</p>
                    <input type="text" class="form-control placeholder-no-fix" autocomplete="off" placeholder="Email"
                           name="email">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->

    <?php $this->endWidget(); ?>

</div>






