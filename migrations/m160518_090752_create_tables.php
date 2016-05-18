<?php

use yii\db\Migration;

/**
 * Handles the creation for table `tables`.
 */
class m160518_090752_create_tables extends Migration
{
    public function safeUp()
    {
        /*MySQL table options*/
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        /*Create table user*/
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'service_id' => $this->string(32)->notNull(),
            'auth_key' => $this->string(32),
        ], $tableOptions);

        /*Create table portfolio*/
        $this->createTable('{{%portfolio}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->string(),
            'avatar' => $this->string(128),
            'rating' => $this->integer()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('idx-portfolio-user_id', '{{%portfolio}}', 'user_id');
        $this->addForeignKey('fk-portfolio-user_id', '{{%portfolio}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');

        /*Create table voting*/
        $this->createTable('{{%voting}}', [
            'portfolio_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'rate' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-voting', '{{%voting}}', ['portfolio_id', 'user_id']);
        $this->addForeignKey('fk-voting-user_id', '{{%voting}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-voting-portfolio_id', '{{%voting}}', 'portfolio_id', '{{%portfolio}}', 'id', 'CASCADE', 'RESTRICT');

        /*Create table link*/
        $this->createTable('{{%link}}', [
            'id' => $this->primaryKey(),
            'portfolio_id' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
            'url' => $this->string(255)->notNull(),
            'anchor' => $this->string(255),
            'title' => $this->string(255),
            'description' => $this->string(255),
        ], $tableOptions);

        $this->createIndex('idx-link-portfolio_id', '{{%link}}', 'portfolio_id');
        $this->createIndex('idx-link-user_id', '{{%link}}', 'user_id');
        $this->addForeignKey('fk-link-portfolio_id', '{{%link}}', 'portfolio_id', '{{%portfolio}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-link-user_id', '{{%link}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');

        /*Create table email*/
        $this->createTable('{{%email}}', [
            'id' => $this->primaryKey(),
            'portfolio_id' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
            'email' => $this->string(128)->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-email-portfolio_id', '{{%email}}', 'portfolio_id');
        $this->createIndex('idx-email-user_id', '{{%email}}', 'user_id');
        $this->addForeignKey('fk-email-portfolio_id', '{{%email}}', 'portfolio_id', '{{%portfolio}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-email-user_id', '{{%email}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');

        /*Create table phone*/
        $this->createTable('{{%phone}}', [
            'id' => $this->primaryKey(),
            'portfolio_id' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
            'number' => $this->string(32)->notNull(),
            'note' => $this->string(255),
        ], $tableOptions);

        $this->createIndex('idx-phone-portfolio_id', '{{%phone}}', 'portfolio_id');
        $this->createIndex('idx-phone-user_id', '{{%phone}}', 'user_id');
        $this->addForeignKey('fk-phone-portfolio_id', '{{%phone}}', 'portfolio_id', '{{%portfolio}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-phone-user_id', '{{%phone}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');

        /*Create table work*/
        $this->createTable('{{%work}}', [
            'id' => $this->primaryKey(),
            'portfolio_id' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->string()->notNull(),
            'link' => $this->string(255),
            'image' => $this->string(128),
        ], $tableOptions);

        $this->createIndex('idx-work-portfolio_id', '{{%work}}', 'portfolio_id');
        $this->createIndex('idx-work-user_id', '{{%work}}', 'user_id');
        $this->addForeignKey('fk-work-portfolio_id', '{{%work}}', 'portfolio_id', '{{%portfolio}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-work-user_id', '{{%work}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');

        /*Create table paragraph*/
        $this->createTable('{{%paragraph}}', [
            'id' => $this->primaryKey(),
            'portfolio_id' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
            'content' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-paragraph-portfolio_id', '{{%paragraph}}', 'portfolio_id');
        $this->createIndex('idx-paragraph-user_id', '{{%paragraph}}', 'user_id');
        $this->addForeignKey('fk-paragraph-portfolio_id', '{{%paragraph}}', 'portfolio_id', '{{%portfolio}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-paragraph-user_id', '{{%paragraph}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        /*Remove tables*/
        $this->dropTable('{{%paragraph}}');
        $this->dropTable('{{%work}}');
        $this->dropTable('{{%phone}}');
        $this->dropTable('{{%email}}');
        $this->dropTable('{{%link}}');

        $this->dropTable('{{%voting}}');
        $this->dropTable('{{%portfolio}}');
        $this->dropTable('{{%user}}');
    }
}
