<section class="section">

    <div class="url">
        <?php $form = $this->beginWidget(
            'CActiveForm',
            array(
                 'action' => '/url/create',
                 'method' => 'post',
            )
        ); ?>

        <div class="row">
            <div class="col-md-10 col-sm-9">
                <?php echo $form->textField($model, 'url', array('class' => 'form-control', 'maxlength' => 255, 'placeholder' => 'http://example.com/?utm_source=facebook')); ?>
            </div>
            <div class="col-md-2 col-sm-3">
                <?php echo CHtml::submitButton('Create', array('class' => 'btn btn-primary btn-block')); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>

        <div class="text-light text-small text-center">Enter a url above to shorten it. Note, if you enter a URL that is
            already in use by the system, no new URL will be created.
        </div>

    </div>

    <?php

    $this->widget('GridView',
        array(
             'dataProvider' => $model->search(),

             'dblClick'     => '/url/details',
             'columns'      => array(
                 array(
                     'name'        => 'id',
                     'htmlOptions' => array('style' => 'width: 30px'),
                 ),

                 array(
                     'name' => 'url',
                     'htmlOptions' => array('class' => 'word-break'),
                 ),

                 array(
                     'name' => 'key',
                 ),

                 array(
                     'name' => 'alias',
                 ),

                 array(
                     'name'        => 'date_created',
                     'htmlOptions' => array('style' => 'width: 200px'),
                     'value'       => 'date("d/m/Y" . " h:i e", strtotime($data->date_created))'
                 ),
//
//                     array(
//                         'name'        => 'last_login',
//                         'htmlOptions' => array('style' => 'width: 200px'),
//                         'value'       => 'date("d/m/Y" . " h:i e", strtotime($data->last_login))'
//                     ),
             ),
        )
    );

    ?>
</section>

<aside class="aside">

    <div class="wrapper focus">

        <div class="btn-group pull-right stat-tab">
            <a data-toggle="tab" class="btn stat-btn active" href="#hits" data-toggle="tab">
                <i class="fa fa-bar-chart-o"></i>
            </a>
            <a data-toggle="tab" class="btn stat-btn" href="#total" data-toggle="tab">
                <i class="fa fa-list"></i>
            </a>
            <a data-toggle="tab" class="btn stat-btn" href="#referral" data-toggle="tab">
                <i class="fa fa-link"></i>
            </a>
        </div>


        <div class="tab-content">
            <div class="tab-pane fade in active" id="hits">
                <h2>Recent Activity</h2>
                <?php
                $this->widget('Chart',
                    array(
                         'class'   => 'chart',
                         'style'   => 'height: 180px;',
                         'options' => array(
                             'chartType'     => Chart::CHART_BAR,
                             'data'          => URL::getAllHitsPerDay(20),
                             'xkey'          => 'label',
                             'ykeys'         => array('value'),
                             'labels'        => array('Hits'),
                             'hideHover'     => 'auto',
                             'smooth'        => true,
                             'barColors'     => array('#ccbce0'),
                             'gridTextColor' => '#ffffff',
                         ),
                    )
                );
                ?>
            </div>
            <div class="tab-pane fade" id="total">
                <h2>Hits</h2>
            </div>
            <div class="tab-pane fade" id="referral">
                <h2>Referral Sites</h2>

            </div>
        </div>

    </div>
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