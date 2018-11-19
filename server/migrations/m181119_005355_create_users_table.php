<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m181119_005355_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id'            => $this->primaryKey(),
            'phone'         => $this->string(20)->notNull()->unique(),
            'surname'       => $this->string(20)->notNull(),
            'name'          => $this->string(20)->notNull(),
            'patronymic'    => $this->string(20),
            'sex'           => $this->integer(),
            'birthday'      => $this->date(),
            'token'         => $this->string(32)->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
