<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;

class m200313_083518_text_fields extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $textGroup = null;
        $groups = Craft::$app->getFields()->getAllGroups();
        foreach ($groups as $group) {
            if ('Text' === $group->name) {
                $textGroup = $group;
            }
        }

        if (null === $textGroup) {
            $textGroup = new \craft\models\FieldGroup();
            $textGroup->name = 'Text';
            Craft::$app->fields->saveGroup($textGroup);
        }

        // Heading field
        if (null === Craft::$app->fields->getFieldByHandle('heading')) {
            $headingField = Craft::$app->fields->createField([
                'type' => 'craft\\fields\\PlainText',
                'groupId' => $textGroup->id,
                'name' => 'Heading',
                'handle' => 'heading',
                'instructions' => 'This can be used as an override fot the title, please leave blank if you wish to use the title field instead',
                'translationMethod' => 'none',
                'translationKeyFormat' => null,
                'settings' => [
                    'placeholder' => 'Type here...',
                    'charLimit' => '',
                    'multiline' => '',
                    'initialRows' => 4,
                    'columnType' => 'string'
                ]
            ]);

            Craft::$app->fields->saveField($headingField);
        }

        // Body field
        if (null === Craft::$app->fields->getFieldByHandle('body')) {
            $bodyField = Craft::$app->fields->createField([
                'type' => 'craft\\redactor\\Field',
                'groupId' => $textGroup->id,
                'name' => 'Body',
                'handle' => 'body',
                'instructions' => 'The body text represents the content of this entry, text formatting is available.',
                'translationMethod' => 'none',
                'translationKeyFormat' => null,
                'settings' => [
                    'redactorConfig' => '',
                    'availableVolumes' => '*',
                    'cleanupHtml' => true,
                    'purifyHtml' => true,
                    'purifierConfig' => '',
                    'columnType' => 'text'
                ]
            ]);

            Craft::$app->fields->saveField($bodyField);
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $headingField = Craft::$app->fields->getFieldByHandle('heading');
        if (null !== $headingField) {
            Craft::$app->fields->deleteFieldById($headingField->id);
        }

        $bodyField = Craft::$app->fields->getFieldByHandle('body');
        if (null !== $bodyField) {
            Craft::$app->fields->deleteFieldById($bodyField->id);
        }

        return true;
    }
}
