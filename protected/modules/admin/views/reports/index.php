<section class="hbox stretch">

    <section class="vbox stretch">
        <section class="hbox stretch">
            <aside class="bg-light lter">
                <section class="vbox">
                    <header class="bg-light dker header clearfix">
                        <p class="h4">Reporting</p>
                    </header>

                    <section class="wrapper">

                        <div class="col-md-6 col-lg-4">
                            <section class="panel">
                                <header class="panel-heading bg-primary lter no-borders">
                                    <p class="h4">End Of Draw</p>
                                    <small class="text-muted">Provide details of draw entries and Retailer
                                        performance.
                                    </small>
                                </header>
                                <div class="panel-body">


                                    <?php

                                    $end_of_draw_model = new EndOfDrawReport();

                                    $form = $this->beginWidget('CActiveForm',
                                        array(
                                             'id'                   => 'competitions-form',
                                             'enableAjaxValidation' => false,
                                             'method'               => 'get',
                                             'action'               => '/reports/endofdraw/',
                                        )
                                    ); ?>

                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <?php echo $form->labelEx($end_of_draw_model, 'competition_id'); ?>

                                                <?php
                                                $this->widget(
                                                    'ext.select2.ESelect2',
                                                    array(
                                                         'model'       => $end_of_draw_model,
                                                         'attribute'   => 'competition_id',
                                                         'data'        => CHtml::listData(Competitions::model()->findAll(array('order' => 'name ASC')), 'id', 'name', 'status'),
                                                         'options'     => array(
                                                             'allowClear' => true,
                                                         ),
                                                    )
                                                );
                                                ?>

                                                <?php echo $form->error($end_of_draw_model, 'competition_id'); ?>
                                            </div>
                                        </div>


                                    </div>

                                    <?= CHtml::submitButton('Run', array('class' => 'btn btn-s-md btn-primary pull-right')); ?>

                                    <?php $this->endWidget(); ?>
                                </div>
                            </section>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <section class="panel">
                                <header class="panel-heading bg-primary lter no-borders">
                                    <p class="h4">Players</p>
                                    <small class="text-muted">Provide details on the number of players
                                    </small>
                                </header>
                                <div class="panel-body">
                                    <a class="btn btn-s-md btn-primary pull-right" href="/reports/members/">Run</a>
                                </div>
                            </section>
                        </div>

                    </section>

                </section>
            </aside>

            <aside class="aside-lg bg-light">

                <header class="dk header">

                </header>

                <div class="wrapper">

                </div>
            </aside>
        </section>
    </section>

</section>