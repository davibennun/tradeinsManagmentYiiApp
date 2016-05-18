<?php

use yii\db\Migration;

class m160516_150054_update_tradein_table extends Migration
{
    public function up()
    {
        $this->addColumn('tradeins', 'internal_notes', $this->text());
        $this->addColumn('tradeins', 'first_contact', $this->date());
        $this->addColumn('tradeins', 'last_contact', $this->date());
        $this->addColumn('tradeins', 'shipping_label', $this->string());
        $this->addColumn('tradeins', 'email', $this->string());
        $this->addColumn('tradeins', 'phone', $this->string());
        $this->addColumn('tradeins', 'other_brand', $this->string());
        $this->addColumn('tradeins', 'model_number', $this->string());

        $this->dropColumn('tradeins', 'watch');
        $this->dropColumn('tradeins', 'value');

    }

    public function down()
    {

        $this->dropColumn('tradeins', 'internal_notes');
        $this->dropColumn('tradeins', 'first_contact');
        $this->dropColumn('tradeins', 'last_contact');
        $this->dropColumn('tradeins', 'shipping_label');
        $this->dropColumn('tradeins', 'email');
        $this->dropColumn('tradeins', 'phone');
        $this->dropColumn('tradeins', 'brand');
        $this->dropColumn('tradeins', 'other_brand');
        $this->dropColumn('tradeins', 'model');
        $this->dropColumn('tradeins', 'model_number');

        $this->addColumn('tradeins', 'watch', $this->string());
        $this->addColumn('tradeins', 'value', $this->string());
        return false;
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
