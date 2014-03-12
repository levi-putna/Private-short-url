<?php

/**
 * Description
 *
 * @since   1.0.0
 * @package StructureWiki
 * @author  Levi Putna <levi.putna@gmail.com>
 */
class LinkPager extends CLinkPager {
    /**
     * @see CLinkPager::init()
     */
    public function init() {
        $this->firstPageLabel       = 'First';
        $this->prevPageLabel        = '&laquo;';
        $this->nextPageLabel        = '&raquo;';
        $this->lastPageLabel        = 'Last';
        $this->htmlOptions['id']    = $this->getId();
        $this->htmlOptions['class'] = 'pagination';
    }

    /**
     * @see CLinkPager::run()
     */
    public function run() {
        $buttons = $this->createPageButtons();
        if (empty($buttons)) {
            return;
        }
        echo CHtml::tag('ul', $this->htmlOptions, implode("\n", $buttons));
    }
}
