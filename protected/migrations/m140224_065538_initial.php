<?php

class m140224_065538_initial extends CDbMigration {
    public function up() {

        $transaction = $this->getDbConnection()->beginTransaction();
        try {

            /*
             * Role table
             *
             * This table us used to set access control rules to the admin site.
             */
            $this->createTable('role',
                array(
                     'id'    => 'INT(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
                     'key'   => 'varchar(45) NOT NULL',
                     'label' => 'varchar(45) NOT NULL',
                ), 'ENGINE = InnoDB');

            $this->execute("INSERT INTO role (`id`, `key`, `label`) VALUES (1, 'user', 'User');");
            $this->execute("INSERT INTO role (`id`, `key`, `label`) VALUES (2, 'admin', 'Admin');");

            /*
             * Admin table
             *
             * This table managed the admin accounts
             */
            $this->createTable('admin',
                array(
                     'id'           => 'INT(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
                     'given_name'   => 'varchar(45) NOT NULL',
                     'family_name'  => 'varchar(45) NOT NULL',
                     'email'        => 'varchar(80) NOT NULL',
                     'password'     => 'varchar(100) NOT NULL',
                     'role_id'      => 'INT(20) UNSIGNED NOT NULL',
                     'date_created' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
                     'last_login'   => 'timestamp NULL',
                ), 'ENGINE = InnoDB');

            $this->addForeignKey(
                'admin_role_id',
                'admin',
                'role_id',
                'role',
                'id'
            );

            $this->createIndex(
                'email_password_UNIQUE',
                'admin',
                'email, password',
                true
            );

            $this->createIndex(
                'email_UNIQUE',
                'admin',
                'email',
                true
            );

            /*
             * url table
             *
             * This table holds all the urls that will be shortened.
             */

            $this->createTable('url',
                array(
                     'id'           => 'INT(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
                     'url'          => 'varchar(255) NOT NULL',
                     'key'          => 'varchar(45)',
                     'alias'        => 'varchar(45)',
                     'admin_id'     => 'INT(20) UNSIGNED NOT NULL',
                     'description'  => 'TEXT(500)',
                     'date_created' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
                     'active'       => 'BOOL NULL DEFAULT 1',
                ), 'ENGINE = InnoDB');

            $this->createIndex(
                'url_UNIQUE',
                'url',
                'url',
                true
            );

            $this->createIndex(
                'key_UNIQUE',
                'url',
                'key',
                true
            );

            $this->createIndex(
                'alias_INDEX',
                'url',
                'alias'
            );

            /*
             * url_hit
             *
             * Table holds all the hits for a url
             */
            $this->createTable('url_hit',
                array(
                     'id'           => 'INT(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
                     'url_id'       => 'INT(20) UNSIGNED NOT NULL',
                     'date'         => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
                     'referral_url' => 'varchar(255) NOT NULL',
                ), 'ENGINE = InnoDB');

            $this->addForeignKey(
                'url_url_id',
                'url_hit',
                'url_id',
                'url',
                'id',
                'CASCADE'
            );

            $this->createIndex(
                'url_UNIQUE',
                'url_hit',
                'url_id',
                false
            );

            /*
             * short_url
             *
             * This table holds the short site urls. eg tiny.url or ozlot.to
             */
            $this->createTable('domain',
                array(
                     'id'           => 'INT(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
                     'url'          => 'varchar(255) NOT NULL',
                     'description'  => 'TEXT(500)',
                     'date_created' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
                     'active'       => 'BOOL NULL DEFAULT 1',
                     'priority'     => 'INT(20) UNSIGNED',
                ), 'ENGINE = InnoDB');

            $this->createIndex(
                'domain_UNIQUE',
                'domain',
                'url',
                true
            );


            $transaction->commit();
        } catch (Exception $e) {
            echo "Exception: " . $e->getMessage() . "\n";
            $transaction->rollback();
            return false;
        }
    }

    public
    function down() {
        $this->dropTable('admin');
        $this->dropTable('role');
        $this->dropTable('user');
    }
}