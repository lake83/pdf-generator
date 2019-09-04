<?php

use yii\db\Migration;

/**
 * Class m190904_184009_templates_fields
 */
class m190904_184009_templates_fields extends Migration
{
    public function up()
    {
        $this->createTable('templates_fields', [
            'id' => $this->primaryKey(),
            'template_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'symbol' => $this->string()->notNull()
        ], $this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB' : null);
        
        $this->createIndex('idx-templates_fields-template', 'templates_fields', 'template_id');
        $this->addForeignKey('templates_fields_template_ibfk_1', 'templates_fields', 'template_id', 'templates', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('templates_fields_catalog_ibfk_1', 'templates_fields');
        $this->dropIndex('idx-templates_fields-catalog', 'templates_fields');
        
        $this->dropTable('templates_fields');
    }
}