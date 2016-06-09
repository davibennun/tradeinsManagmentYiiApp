<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160609_200005_add_vendor_quotes_table extends Migration
{
    public function up()
    {
        $this->createTable('vendor_quotes', [
            'id' => $this->primaryKey(),
            'brand' => $this->string()->notNull(),
            'model' => $this->string()->notNull(),
            'price' => 'decimal(19,4)',
        ]);
    }

    public function down()
    {
        $this->dropTable('vendo_quotes');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
