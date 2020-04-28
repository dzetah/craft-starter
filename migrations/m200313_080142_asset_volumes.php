<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;

class m200313_080142_asset_volumes extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        if (null === Craft::$app->volumes->getVolumeByHandle('gallery')) {
            $volume = new \craft\volumes\Local([
                'name' => 'Gallery',
                'handle' => 'gallery',
                'hasUrls' => true,
                'url' => '@web/media/gallery',
                'path' => '@webroot/media/gallery'
            ]);

            Craft::$app->volumes->saveVolume($volume);
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $gallery = Craft::$app->volumes->getVolumeByHandle('gallery');
        if (null !== $gallery) {
            Craft::$app->volumes->deleteVolumeById($gallery->id);
        }

        return true;
    }
}
