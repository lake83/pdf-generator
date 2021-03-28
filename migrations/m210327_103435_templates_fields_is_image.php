<?php

use yii\db\Migration;

/**
 * Class m210327_103435_templates_fields_is_image
 */
class m210327_103435_templates_fields_is_image extends Migration
{
    public function up()
    {
        $this->addColumn('templates_fields', 'is_image', $this->boolean()->notNull()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('templates_fields', 'is_image');
    }
}