<?php $form = $this->beginWidget(
    'CActiveForm',
    array(
         'method' => 'post',
    )
); ?>

    <section class="section">

        <a class="back" href="/"><i class="fa fa-arrow-left"></i> All URL's</a>

        <div class="url">

            <div class="row">
                <div class="col-md-10 col-sm-9">
                    <?php echo $form->textField($model, 'url', array('class' => 'form-control', 'maxlength' => 255, 'placeholder' => 'http://example.com/?utm_source=facebook')); ?>
                </div>
                <div class="col-md-2 col-sm-3">
                    <?php echo CHtml::submitButton('Update', array('class' => 'btn btn-primary btn-block')); ?>
                </div>
            </div>


            <div class="text-light text-small text-center">
                <b>Note,</b> Short URL's are redirected with a <a target='_blank'
                                                                 href='http://en.wikipedia.org/wiki/HTTP_301'>301
                    Moved Permanently</a> status code, this will result in most browsers caching the long url. Changes
                to the above Long URL may not result in changes to browsers that have already cached the Short URL.
            </div>

        </div>

        <div class="wrapper">

            <?php if (Yii::app()->user->hasFlash('error')): ?>
                <div class="message message-error">
                    <div class="ribon ribon-red">
                        <i class="fa fa-exclamation-circle"></i>
                    </div>
                    <h4>Error Updating URL</h4>

                    <p><?= Yii::app()->user->getFlash('error'); ?></p>
                    <?= CHtml::errorSummary($model); ?>
                </div>
            <?php endif; ?>

            <?php if (Yii::app()->user->hasFlash('success')): ?>
                <div class="message message-success fadeout">
                    <div class="ribon ribon-green">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    <h4>Error Updating URL</h4>

                    <p><?= Yii::app()->user->getFlash('success'); ?></p>
                </div>
            <?php endif; ?>

            <?php
            {

            }
            ?>


            <h4>Short URL <i class="text-info fa fa-question-circle pull-right" data-toggle="popover" data-html="true"
                             data-placement="top" title=""
                             data-content="<p>This is the automatically generated <b>unique</b> short version of the URL. You can use this URL as a link in any other website and it will redirect to the long URL listed above. </p> <p><b>Note</b>, you cannot change this url.</p>"
                             data-original-title="Short URL"></i>
            </h4>

            <div class="row url-builder" url-copy>
                <div class="col-xs-4">
                    <?php
                    $this->widget(
                        'ext.select2.ESelect2',
                        array(
                             'name'        => 'short_url',
                             'data'        => CHtml::listData(Domain::model()->findAll(array('order' => 'priority, id ASC')), 'url', 'url'),
                             'htmlOptions' => array('url-domain' => true),
                        )
                    ); ?>
                    <span class="slash">/</span>
                </div>
                <div class="col-xs-8">
                    <div class="input-group">
                        <?php echo $form->textField($model, 'key', array('class' => 'form-control', 'maxlength' => 42, 'disabled' => true, 'url-path' => true)); ?>
                        <span class="input-group-btn">
                        <a href="#" class="btn btn-default" url-click>Copy</a>
                  </span>
                    </div>
                </div>
            </div>

            <h4>Alias URL <i class="text-info fa fa-question-circle pull-right" data-toggle="popover" data-html="true"
                             data-placement="top" title=""
                             data-content="<p>This is an additional <b>optional and unique</b> user defined URL. You can use this URL as a link in any other website and it will redirect to the long URL listed above. </p> <p><b>Note</b>, an alias can only contain alphanumeric characters and hyphens (where a hyphen is not repeated twice-in-a-row and does not begins/ends the string)</p> <p><b>Example:</b> power-1</p>"
                             data-original-title="Alias URL"></i>
            </h4>

            <div class="row url-builder" url-copy>
                <div class="col-xs-4">
                    <?php
                    $this->widget(
                        'ext.select2.ESelect2',
                        array(
                             'name'        => 'alias_url',
                             'data'        => CHtml::listData(Domain::model()->findAll(array('order' => 'priority, id ASC')), 'url', 'url'),
                             'htmlOptions' => array('url-domain' => true),
                        )
                    ); ?>
                    <span class="slash">/</span>
                </div>
                <div class="col-xs-8">
                    <div class="input-group">
                        <?php echo $form->textField($model, 'alias', array('class' => 'form-control', 'maxlength' => 42, 'url-path' => true)); ?>
                        <span class="input-group-btn">
                        <a href="#" class="btn btn-default" url-click>Copy</a>
                  </span>
                    </div>
                    <?php echo $form->error($model, 'alias'); ?>
                </div>

            </div>

        </div>

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
                <a data-toggle="tab" class="btn stat-btn" href="#referral" data-toggle="tab"
                   data-identifier="window.MorrisObjects[" yw2"]">
                <i class="fa fa-link"></i>
                </a>
            </div>


            <div class="tab-content " id="tabs">
                <div class="tab-pane fade in active" id="hits">
                    <h2>Recent Activity <i class="text-purple fa fa-question-circle " data-toggle="popover"
                                           data-html="true"
                                           data-placement="bottom" title=""
                                           data-content="<p>Short URLS are redirected with a <a target='_blank' href='http://en.wikipedia.org/wiki/HTTP_301'>301 Moved Permanently</a> status code, this will result in most browsers caching the long url. Only requests that have not been cached by the browser and are made via this site will be recorded as a hit within the system.</p> <p>If you require more accurate hit tracking please make use of <a target='_blank' href='https://support.google.com/analytics/answer/1033867?hl=en'>Google Analytics and UTM tags</a></p>"
                                           data-original-title="Hits"></i></h2>
                    <?php
                    $this->widget('Chart',
                        array(
                             'class'   => 'chart',
                             'style'   => 'height: 180px;',
                             'options' => array(
                                 'chartType'     => Chart::CHART_BAR,
                                 'data'          => $model->getHitsPerDay(20),
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
                    <h2>Referral Sites <i class="text-purple fa fa-question-circle " data-toggle="popover"
                                          data-html="true"
                                          data-placement="bottom" title=""
                                          data-content="<p>Direct links and requests that do not include a <a target='_blank' href='http://en.wikipedia.org/wiki/HTTP_referer'>HTTP referer</a> will be recorded as 'No Referral'</p> <p>If you require more accurate hit tracking please make use of <a target='_blank' href='https://support.google.com/analytics/answer/1033867?hl=en'>Google Analytics and UTM tags</a></p>"
                                          data-original-title="Hits"></i></h2>
                    <?php
                    $this->widget('Chart',
                        array(
                             'class'   => 'chart',
                             'style'   => 'height: 180px;',
                             'options' => array(
                                 'chartType'       => Chart::CHART_DONUT,
                                 'data'            => $model->getReferrer(10),
                                 'xkey'            => 'label',
                                 'ykeys'           => array('value'),
                                 'labels'          => array('Hits'),
                                 'hideHover'       => 'auto',
                                 'smooth'          => true,
                                 'backgroundColor' => '#9972b5',
                                 'colors'          => array('#ccbce0', '#746B7F', '#E8D6FF', '#3A3640', '#D1C1E5'),
                                 'labelColor'      => '#ffffff',
                             ),
                        )
                    );
                    ?>

                </div>
            </div>

        </div>

        <div class="wrapper">
            <h2>Description</h2>

            <?php echo $form->textArea($model, 'description', array('class' => 'form-control description', 'maxlength' => 1500, 'placeholder' => 'add description')); ?>
        </div>

    </aside>

<?php $this->endWidget(); ?>