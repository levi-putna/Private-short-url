<?php
/**
 * Class AdvancedLogFilter
 *
 * preprocessed the logged messages before they are handled by a log route and filter out any error exceptions types that are thrown are specified.
 *
 * CLogFilter is meant to be used by a log route to preprocessed the logged messages
 * before they are handled by the route.
 *
 * An example usage, this will filter out any 404 exceptions
 * 'filter' => array(
 *     'class'=>'AdvancedLogFilter',
 *     'ignoreCategories' => array(
 *         'exception.CHttpException.404',
 * ),
 *
 */
class AdvancedLogFilter extends CLogFilter {
    public $ignoreCategories; // =array('category','category.*','some.category.tree.*');

    public function filter(&$logs) {
        // unset categories marked as "ignored"
        if ($logs) {
            foreach ($logs as $logKey => $log) {
                $logCategory = $log[2]; //log category
                foreach ($this->ignoreCategories as $nocat) {
                    // Exact match
                    if ($logCategory === $nocat) {
                        unset($logs[$logKey]);
                        continue;
                    } // Wildcard match
                    else {
                        if (strpos($nocat, '.*') !== false) {
                            $nocat = str_replace('.*', '', $nocat) . '.'; //remove asterix item from array and add dot at the and
                            if (strpos($logCategory . '.', $nocat) !== false) {
                                unset($logs[$logKey]);
                            }
                        }
                    }
                }
            }
        }

        $this->format($logs);
        return $logs;
    }
}