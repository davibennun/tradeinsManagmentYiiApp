<?php

use common\models\Tradein;
use yii\db\Migration;

/**
 * Handles adding status_column to table `tradeins_table`.
 */
class m160603_190942_add_status_column_to_tradeins_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('tradeins', 'status', $this->string()->defaultValue(Tradein::STATUS_ACTIVE));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('tradeins', 'status');
    }
}
