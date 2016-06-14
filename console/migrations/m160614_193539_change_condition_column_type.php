<?php

use yii\db\Migration;

class m160614_193539_change_condition_column_type extends Migration
{
    public function up()
    {
        $this->alterColumn('tradeins', 'condition', 'TEXT');
    }

    public function down()
    {

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
