<?php

use yii\db\Migration;

/**
 * Handles the creation of table `scan`.
 */
class m200312_222136_create_scan_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('scan', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('название'),
            'loaded_at' => $this->dateTime()->comment('дата и время загрузки'),
            'link' => $this->string()->comment('ссылка на файл'),
            'author_id' => $this->integer()->comment('кто загрузил'),

            'driver_id' => $this->integer(),
            'bid_id' => $this->integer(),
        ]);
        $this->createIndex(
            'idx-scan-author_id',
            'scan',
            'author_id'
        );
        $this->addForeignKey(
            'fk-scan-author_id',
            'scan',
            'author_id',
            'user',
            'id',
            'SET NULL'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {

        $this->dropForeignKey(
            'fk-scan-author_id',
            'scan'
        );
        $this->dropIndex(
            'idx-scan-author_id',
            'scan'
        );

        $this->dropTable('scan');

    }
}
