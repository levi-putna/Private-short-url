<?php

class ReportsController extends Controller {
    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'endofdraw', 'members'),
                'roles'   => array('admin'),
            ),
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index', array());
    }

    public function actionEndofdraw() {
        $competition_id = $_GET['EndOfDrawReport']['competition_id'];
        $competition    = Competitions::model()->findByPk($competition_id);
//        if (isset($_GET['retailers'])) {
//            $competition->retailers = $_GET['retailers'];
//        }
//
        //date_default_timezone_set($competition->timezone);
        date_default_timezone_set('EST');

        $this->render('end-of-draw', array('competition' => $competition));
        //$this->render('end_of_draw', array('competition' => $competition));
    }

    public function actionMembers() {

        //date_default_timezone_set($competition->timezone);
        date_default_timezone_set('EST');

        $this->render('members',
            array(
                 'members_by_date' => PlayersHelper::getPlayersByMonth(12),
                 'members_by_state' => PlayersHelper::getPlayersByState(),
                 'member_count' => PlayersHelper::getActivePlayersCount()
            )
        );
    }

    public function actionSignup($id) {
        if ($id) {
            $retailer = Retailers::model()->findByPk($id);
        } else {
            $retailer = null;
        }
        // set the default timezone to use. Available since PHP 5.1
        //date_default_timezone_set($competition->timezone);
        date_default_timezone_set('EST');
        $this->render('singup', array('retailer' => $retailer));
    }

}