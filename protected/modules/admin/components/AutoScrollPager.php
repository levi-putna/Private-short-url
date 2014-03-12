<?php

class AutoScrollPager extends CLinkPager {

    public $listViewId;
    public $rowSelector = '.row';
    public $itemsSelector = ' > .items';
    public $nextSelector = '.next:not(.disabled):not(.hidden) a';
    public $pagerSelector = '.pager';
    public $options = array();
    public $linkOptions = array();
    public $loaderText = 'Loading...';
    private $baseUrl;

    public function init() {
        parent::init();
    }

    public function run() {

        $buttons = $this->createPageButtons();

        echo $this->header; // if any
        echo CHtml::tag('ul', $this->htmlOptions, implode("\n", $buttons));
        echo $this->footer; // if any
    }

    protected function createPageButton($label, $page, $class, $hidden, $selected) {
        if ($hidden || $selected) {
            $class .= ' ' . ($hidden ? 'disabled' : 'active');
        }

        return CHtml::tag('li', array('class' => $class), CHtml::link($label, $this->createPageUrl($page), $this->linkOptions));
    }

}