<?php
/**
 * The migration proxy class
 *
 * @author    Steve Guns <steve@bedezign.com>
 * @package   com.bedezign.yii2.migration-proxy
 * @category
 * @copyright 2014 B&E DeZign
 */

namespace bedezign\yii2\migrationproxy;

class MigrationProxy extends \yii\base\Object
{
    /** @var string         The base path for the migrations. Aliases will be resolved */
    public $migrationPath   = null;

    private $controller     = null;

    public function __call($name, $params)
    {
        if (!$this->controller)
            $this->controller = new MigrateController(['migrationPath' => $this->migrationPath]);

        call_user_func_array([$this->controller, $name], $params);
    }

    /**
     * Shortcut function that works without an instance
     * @param string    $migrationPath  Path to use for the migrations, aliases will be resolved
     * @param string    $function       Migration function to call
     * @param mixed[]   $parameters     Array of parameters to specify
     */
    public static function call($migrationPath, $function, $parameters = [])
    {
        $proxy = new static(['migrationPath' => $migrationPath]);
        $proxy->__call($function, $parameters);
    }
}