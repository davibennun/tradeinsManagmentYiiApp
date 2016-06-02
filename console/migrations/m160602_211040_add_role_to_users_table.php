<?php

use yii\db\Migration;
use common\models\User;
/**
 * Handles adding role to table `users_table`.
 */
class m160602_211040_add_role_to_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'role', $this->string()->defaultValue(User::ROLE_USER));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'role');
    }
}
