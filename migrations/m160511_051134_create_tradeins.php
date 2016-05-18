<?php

use yii\db\Migration;

/**
 * Handles the creation for table `tradeins`.
 */
class m160511_051134_create_tradeins extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tradeins', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string(),
            'watch' => $this->string()->notNull(),
            'model' => $this->string(),
            'brand' => $this->string(),
            'value' => $this->string()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tradeins');
    }
}
