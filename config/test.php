<?php

/**
 * Application configuration shared by all test types
 */
return yii\helpers\ArrayHelper::merge(
    require 'web.php',
    [
        'id' => 'shorter-tests',
    ]
);
