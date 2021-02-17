<?php

namespace components;

/**
* Loader class
**/
class Loader {

    public function __construct() {
        spl_autoload_register(function ($class_name) {
            include_once __DIR__ . '/../' . str_replace('\\', '/', $class_name) . '.php';
        });

        $error = false;
        $request = new \components\Request();
        $statisticsController = new \controllers\StatisticsController();

        if (!$request->isValid()) {
            $method = ucfirst(strtolower($request->getRequestMethod()));
            $uriArray = explode('/', $request->getRequestUri());
            $methodSuffix = ucfirst(strtolower($uriArray[0] ?? ''));

            array_walk($uriArray, function (&$value) {
                $value = ucfirst(strtolower($value));
            });

            $methodName = 'action' . $method . implode('', $uriArray);
            if (method_exists($statisticsController, $methodName)) {
                $statisticsController->$methodName($uriArray[1] ?? null);
            } else {
                $error = true;
            }
        } else {
            $error = true;
        }

        if ($error) {
            echo json_encode([
                'error' => true,
                'message' => 'Invalid request',
                'data' => [],
            ]);
        }
    }
}
