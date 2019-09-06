<?php

use yii\db\Migration;

/**
 * Class m190904_150251_templates
 */
class m190904_150251_templates extends Migration
{
    public function up()
    {
        $this->createTable('templates', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'format' => $this->integer()->notNull(),
            'orientation' => $this->string(1)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ], $this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB' : null);
    }

    public function down()
    {
        $this->dropTable('templates');
    }
}