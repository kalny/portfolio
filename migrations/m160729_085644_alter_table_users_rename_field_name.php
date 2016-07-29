<?php

use yii\db\Migration;

class m160729_085644_alter_table_users_rename_field_name extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->renameColumn('{{%user}}', 'name', 'username');
    }

    public function safeDown()
    {
        $this->renameColumn('{{%user}}', 'username', 'name');
    }

}
