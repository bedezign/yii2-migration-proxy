<?php
/**
 * Overrides the default migration controller and opens up the relevant functions to call.
 * Note: Not using __call was done deliberately. This is already as far from kosjer as it should be.
 *
 * @author    Steve Guns <steve@bedezign.com>
 * @package   com.bedezign.yii2.migration-proxy
 * @copyright 2014 B&E DeZign
 */

namespace bedezign\yii2\migrationproxy;


class MigrateController extends \yii\console\controllers\MigrateController
{
    public function __construct($config = [])
    {
        parent::__construct('migration', 'console', $config);
    }

    public function init()
    {
        parent::init();
        // This is required to make sure the aliases in the migrationPath are resolved
        $this->beforeAction(\Yii::$app->requestedAction);
    }

    public function migrateUp($class)           { return parent::migrateUp($class); }
    public function migrateDown($class)         { return parent::migrateDown($class); }
    public function migrateToTime($time)        { return parent::migrateToTime($time); }
    public function migrateToVersion($version)  { return parent::migrateToVersion($version); }
    public function getNewMigrations()          { return parent::getNewMigrations(); }
}