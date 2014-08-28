<?php
/**
 * Provides a fake component that allows you to easily include migrations from another directory
 *
 * @author    Steve Guns <steve@bedezign.com>
 * @package   com.bedezign.yii2.migration-proxy
 * @category
 * @copyright 2014 B&E DeZign
 */

namespace bedezign\yii2\migrationproxy;

class MigrationProxy extends \yii\base\Object
{
    public $migrationPath = null;

    private $controller = null;

    public function __call($name, $params)
    {
        if (!$this->controller) {
            $this->controller = new \yii\console\controllers\MigrateController(['migrationPath' => $this->migrationPath]);
            $this->controller->beforeAction(\Yii::$app->requestedAction);
        }

        call_user_func_array([$this->controller, $name], $params);
    }

    public static function call($migrationPath, $function, $parameters = [])
    {
        $proxy = new static(['migrationPath' => $migrationPath]);
        $proxy->__call($function, $parameters);
    }
}