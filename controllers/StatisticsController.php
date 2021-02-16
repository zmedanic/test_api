<?php

namespace controllers;

class StatisticsController {

    /**
     * Query listo of models or single one
     * @return mixed
    */
    public function actionGet($id = null) {
        var_dump("ACTION GET");
        /* Add logoc for put */
    }


    /**
     * Saves new model or update existing one
     * @return mixed
    */
    public function actionPost($id = null) {
        var_dump("ACTION POST");
        /* Add logoc for post */
    }


    /**
     * Delete model
     * @return mixed
    */
    public function actionDelete($id) {
        var_dump("ACTION DELETE");
        /* Add logoc for put */
    }
}
