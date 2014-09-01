Migration Proxy
====================

Ever had the issue that you have to run some database migrations from a component you use but you find that you have to manually specify the path to do so. If you have multiple environments you also have to remember to run that migration command on all your environments. Working as a part of a bigger team this becomes even more annoying.

I would love to just include those migrations as part of the main migration flow in the application, so I wrote this proxy.

Using it is really simple: 

	<?php

	class mDDMMYY_HHMMSS_table extends \yii\db\Migration
    {
       public function up()
       {
           $this->proxy->migrateUp('mDDMMYY_HHMMSS_vendor_migration');
       }

       public function down()
       {
           $this->proxy->migrateUp('mDDMMYY_HHMMSS_vendor_migration');
       }

       protected function getProxy()
       {
          return new \bedezign\yii2\migrationproxy\MigrationProxy(['migrationPath' => '@vendor/vendor-migration=folder/migrations']);
       }
    }

Note that the vendor migrations _will_ be created as separate migration rules in your migration table (so on top of the one your migration file creates), but other than than you don't have to do anything special.

