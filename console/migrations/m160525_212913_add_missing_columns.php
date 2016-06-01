<?php

use yii\db\Migration;

class m160525_212913_add_missing_columns extends Migration
{
    public function up()
    {
        $this->addColumn('tradeins', 'customeritem_if_new', $this->string());
        $this->addColumn('tradeins', 'customeritem_retail_value', $this->string());
        $this->addColumn('tradeins', 'customeritem_vendor_offer', $this->string());
        $this->addColumn('tradeins', 'customeritem_jomashop_offer', $this->string());
        $this->addColumn('tradeins', 'purchase_date', $this->string());
        $this->addColumn('tradeins', 'purchased_from', $this->string());
        $this->addColumn('tradeins', 'box_papers', $this->string());
        $this->addColumn('tradeins', 'condition', $this->string());
        $this->addColumn('tradeins', 'image1', $this->string());
        $this->addColumn('tradeins', 'image2', $this->string());
        $this->addColumn('tradeins', 'image3', $this->string());
        $this->addColumn('tradeins', 'image4', $this->string());
        $this->addColumn('tradeins', 'image5', $this->string());
        $this->addColumn('tradeins', 'info_newitem_customer_wants', $this->string());
        $this->addColumn('tradeins', 'newitem_cost', $this->string());
        $this->addColumn('tradeins', 'newitem_jomashop_currentprice', $this->string());
        $this->addColumn('tradeins', 'outofpocket_price', $this->string());
        $this->addColumn('tradeins', 'creation_time', $this->dateTime() . ' DEFAULT NOW()');
    }

    public function down()
    {
        $this->dropColumn('tradeins', 'customeritem_if_new');
        $this->dropColumn('tradeins', 'customeritem_retail_value');
        $this->dropColumn('tradeins', 'customeritem_vendor_offer');
        $this->dropColumn('tradeins', 'customeritem_jomashop_offer');
        $this->dropColumn('tradeins', 'purchase_date');
        $this->dropColumn('tradeins', 'purchased_from');
        $this->dropColumn('tradeins', 'box_papers');
        $this->dropColumn('tradeins', 'condition');
        $this->dropColumn('tradeins', 'image1');
        $this->dropColumn('tradeins', 'image2');
        $this->dropColumn('tradeins', 'image3');
        $this->dropColumn('tradeins', 'image4');
        $this->dropColumn('tradeins', 'image5');
        $this->dropColumn('tradeins', 'info_newitem_customer_wants');
        $this->dropColumn('tradeins', 'newitem_cost');
        $this->dropColumn('tradeins', 'newitem_jomashop_currentprice');
        $this->dropColumn('tradeins', 'outofpocket_price');
        $this->dropColumn('tradeins', 'creation_time');

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
