<?php

use yii\db\Migration;

class m160531_134220_importing_creation_dates extends Migration
{
    public function up()
    {
        $this->addColumn('tradeins', 'importion_time', $this->dateTime() . ' DEFAULT NOW()');
        $this->alterColumn('tradeins', 'creation_time', $this->dateTime() .' DEFAULT NULL');
    }

    public function down()
    {
        $this->dropColumn('tradeins', 'importion_time');
        $this->alterColumn('tradeins', 'creation_time', 'DATE DEFAULT NULL');

        return true;
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
