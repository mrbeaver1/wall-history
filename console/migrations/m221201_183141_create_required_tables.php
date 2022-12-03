<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m221201_183141_create_required_tables
 */
class m221201_183141_create_required_tables extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('post', [
            'id' => Schema::TYPE_PK,
            'author_name' => Schema::TYPE_STRING,
            'text' => Schema::TYPE_TEXT,
            'author_ip' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('post');
    }
}
