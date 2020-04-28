<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;

class m200313_161211_matrix_fields extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $matrixGroup = null;
        $groups = Craft::$app->fields->getAllGroups();
        foreach ($groups as $group) {
            if ('Matrix' === $group->name) {
                $matrixGroup = $group;
            }
        }

        if (null === $matrixGroup) {
            $matrixGroup = new \craft\models\FieldGroup();
            $matrixGroup->name = 'Matrix';
            Craft::$app->fields->saveGroup($matrixGroup);
        }

        if (null === Craft::$app->fields->getFieldByHandle('socialPlatform')) {
            $socialPlatform = new \craft\fields\Matrix([
                'name' => 'Social Platform Block',
                'groupId' => $matrixGroup->id,
                'handle' => 'socialPlatform',
                'instructions' => '',
                'translationMethod' => 'none',
                'translationKeyFormat' => null,
                'minBlocks' => '',
                'maxBlocks' => '',
                'blockTypes' => [
                    new \craft\models\MatrixBlockType([
                        'name' => 'Title'
                    ])
                ]
            ]);
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m200313_102411_matrix_fields cannot be reverted.\n";
        return false;
    }
}
