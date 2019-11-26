<?php

use yii\db\Migration;

/**
 * Class m190905_083915_files
 */
class m190905_083915_files extends Migration
{
    public function up()
    {
        $this->createTable('files', [
            'id' => $this->primaryKey(),
            'template_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'filds_value' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull()
        ], $this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB' : null);
    }

    public function down()
    {
        $this->dropTable('files');
    }
}