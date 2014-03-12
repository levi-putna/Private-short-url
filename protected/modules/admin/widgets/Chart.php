<?php
/**
 * Class Chart
 *
 * Simple wrapper for Morris.js - http://www.oesmith.co.uk/morris.js/
 *
 * Usage:
 * $this->widget('Chart', array(
 * 'id'      => 'myChartElement',
 * 'options' => array(
 * 'chartType' => MorrisChartWidget::CHART_AREA,
 * 'data'      => array(
 * array('y' => 2006, 'a' => 100, 'b' => 90),
 * array('y' => 2007, 'a' => 40, 'b' => 60),
 * array('y' => 2008, 'a' => 50, 'b' => 10),
 * array('y' => 2009, 'a' => 60, 'b' => 50),
 * array('y' => 2010, 'a' => 60, 'b' => 40),
 * ),
 * 'xkey'      => 'y',
 * 'ykeys'     => array('a', 'b'),
 * 'labels'    => array('Series A', 'Series B'),
 * ),
 * ));

 */
class Chart extends CWidget {
    public $options = array();
    public $htmlOptions = array();
    public $class = '';
    public $style = '';

    public $jsArrayName = 'MorrisObjects';

    const CHART_AREA  = 'Area';
    const CHART_LINE  = 'Line';
    const CHART_BAR   = 'Bar';
    const CHART_DONUT = 'Donut';

    public function run() {

        if (empty($this->options['data'])) {
            echo '<div class="empty">more data needed</div>';
            return;
        }

        $id                         = $this->getId();
        $this->htmlOptions['id']    = $id;
        $this->htmlOptions['class'] = $this->class;
        $this->htmlOptions['style'] = $this->style;

        echo CHtml::openTag('div', $this->htmlOptions);
        echo CHtml::closeTag('div');

        $defaultOptions           = array();
        $this->options            = CMap::mergeArray($defaultOptions, $this->options);
        $this->options['element'] = $id;
        $jsOptions                = CJavaScript::encode($this->options);

        $chartType = $this->options['chartType'];

        $this->registerScripts(__CLASS__ . '#' . $id, $this->declareArray() . "Morris.{$chartType}($jsOptions);");
    }

    protected function declareArray() {
        if (empty($this->jsArrayName)) {
            return '';
        }
        $cs = Yii::app()->clientScript;
        $cs->registerScript($this->jsArrayName . 'MorrisArrayDeclaration', 'window.' . $this->jsArrayName . ' = {};', CClientScript::POS_HEAD); //the ID makes sure it can't be registered twice
        return 'window.' . $this->jsArrayName . '["' . $this->getId() . '"] = ';
    }

    /**
     * Publishes and registers the necessary script files.
     *
     * @param string the id of the script to be inserted into the page
     * @param string the embedded script to be inserted into the page
     */
    protected function registerScripts($id, $embeddedScript) {

        $cs = Yii::app()->clientScript;
        $cs->registerScript($id, $embeddedScript, CClientScript::POS_LOAD);
    }
}