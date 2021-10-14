<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%multi_tech_subgroup}}`.
 */
class m211014_072543_create_multi_tech_subgroup_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%multi_tech_subgroup}}', [
            'id' => $this->primaryKey(),
            'technic_id' => $this->integer(),
            'subgroup_id' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%multi_tech_subgroup}}');
    }
}
