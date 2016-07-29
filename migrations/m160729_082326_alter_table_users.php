<?php

use yii\db\Migration;

class m160729_082326_alter_table_users extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'service_name', $this->string(32)->notNull());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'service_name');
    }

}
