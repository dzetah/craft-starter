<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;

class m200313_081047_plugins_install extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        Craft::$app->plugins->init();
        Craft::$app->plugins->installPlugin('redactor');
        Craft::$app->plugins->installPlugin('typedlinkfield');

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        Craft::$app->plugins->uninstallPlugin('redactor');
        Craft::$app->plugins->uninstallPlugin('typedlinkfield');

        return true;
    }
}
