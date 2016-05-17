<?php

use yii\db\Migration;

/**
 * Handles adding contact_notes to table `tradeins`.
 */
class m160516_154928_add_contact_notes_to_tradeins extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('tradeins', 'contact_notes', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('tradeins', 'contact_notes');
    }
}
