<?php

class m140126_122922_create_page_table extends CDbMigration {

    public function up() {
        $this->createTable('page', array(
            'id' => 'pk',
            'parentId' => 'integer NOT NULL',
            'menuTitle' => 'string NOT NULL',
            'pageTitle' => 'string NOT NULL',
            'content' => 'text',
            'seoTitle' => 'string',
            'seoDescription' => 'string',
            'seoKeywords' => 'string',
            'isShow' => 'integer NOT NULL',
            'isDelete' => 'integer NOT NULL',
            'type' => 'integer NOT NULL',
            'sorter' => 'integer NOT NULL',
        ));
        $this->createIndex('uniquePageName', 'page', 'pageTitle', $unique=true);
        $this->insert('page', array(
            'parentId' => 0,
            'menuTitle' => 'Главная',
            'pageTitle' => 'home',
            'content' => 'это главная страница',
            'isShow' => 1,
            'isDelete' => 0,
            'type' => 1,
            'sorter' =>1
            ));
        
        
    }

    public function down() {
        $this->dropTable('page');
    }

    /*
      // Use safeUp/safeDown to do migration with transaction
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
}
