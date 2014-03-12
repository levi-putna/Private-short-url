<?php

/**
 * Description
 *
 * @since   1.0.0
 * @package StructureWiki
 * @author  Levi Putna <levi.putna@gmail.com>
 */

Yii::import('zii.widgets.grid.CGridView');


class GridView extends CGridView {

    /**
     * @var string the template to be used to control the layout of various sections in the view.
     * These tokens are recognized: {summary}, {items} and {pager}. They will be replaced with the
     * summary text, the items, and the pager.
     */
    public $template = "{items}\n<div class='ajax-loader'><img src='/admin/img/loading-small.gif' /> Loading...</div>";
    public $rowCssClassExpression = '$data->id == Yii::app()->request->getQuery("ping") ? "animated bounceInLeft":""';
    public $dblClick = null;
    private $nextPage = null;

    /**
     * Initializes the grid view.
     * This method will initialize required property values and instantiate {@link columns} objects.
     */
    public function init() {
        $this->htmlOptions['class'] = 'grid'; //remove default style
        $pager                      = $this->dataProvider->getPagination();
        $pager->pageSize            = 50;

        $script = "$('#$this->id').infiniteScroll(); $('#$this->id table').stickyTableHeaders();";
        Yii::app()->clientScript->registerScript('someId', $script);

        $this->nextPage = $pager->createPageUrl($this->controller, $pager->pageCount);

        parent::init();
    }

    public function renderContainerHeader() {

    }

    public function renderContainerFooter() {

    }

    /**
     * Renders a table body row.
     *
     * @param integer $row the row number (zero-based).
     */
    public function renderTableRow($row) {
        if ($this->rowCssClassExpression !== null) {
            $data  = $this->dataProvider->data[$row];
            $class = $this->evaluateExpression($this->rowCssClassExpression, array('row' => $row, 'data' => $data));
        } else {
            if (is_array($this->rowCssClass) && ($n = count($this->rowCssClass)) > 0) {
                $class = $this->rowCssClass[$row % $n];
            } else {
                $class = '';
            }
        }

        if ($this->dblClick != null) {
            $id = $data->id;

            $dbl_href = $this->dblClick . '/' . $id;
            echo empty($class) ? '<tr data-toggle="context" data-target="#context-menu" style="cursor: pointer;" dbl-href="' . $dbl_href . '">' : '<tr style="cursor: pointer;" class=" ' . $class . '" dbl-href="' . $dbl_href . '">';
        } else {
            echo empty($class) ? '<tr>' : '<tr class="' . $class . '">';
        }


        foreach ($this->columns as $column) {
            $column->renderDataCell($row);
        }
        echo "</tr>\n";
    }

    /**
     * Renders the data items for the grid view.
     */
    public function renderItems() {

        $this->renderContainerHeader();

        $pager = $this->dataProvider->getPagination();

        if ($pager->currentPage + 1 >= $pager->pageCount) {
            $this->nextPage = false;
        } else {
            $this->nextPage = $pager->createPageUrl($this->controller, $pager->currentPage + 1);
        }

        if ($this->dataProvider->getItemCount() > 0 || $this->showTableOnEmpty) {
            echo "<table class=\"table table-striped table-hover table-scrollable {$this->itemsCssClass}\" page-url=\"" . $this->nextPage . "\">\n";
            $this->renderTableHeader();
            ob_start();
            $this->renderTableBody();
            $body = ob_get_clean();
            $this->renderTableFooter();
            echo $body; // TFOOT must appear before TBODY according to the standard.
            echo "</table>";
        } else {
            $this->renderEmptyText();
        }
        $this->renderContainerFooter();
    }

    /**
     * Renders the pager.
     */
    public function renderPager() {
        if (!$this->enablePagination) {
            return;
        }
    }

}
