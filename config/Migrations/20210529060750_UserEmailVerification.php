<?php

use Migrations\AbstractMigration;

class UserEmailVerification extends AbstractMigration
{

    public function up()
    {

        $this->table('users')
            ->addColumn('is_email_verified', 'boolean', [
                'after' => 'is_active',
                'default' => '0',
                'length' => null,
                'null' => false,
            ])
            ->addColumn('email_verification_code', 'string', [
                'after' => 'is_email_verified',
                'default' => null,
                'length' => 32,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('users')
            ->removeColumn('is_email_verified')
            ->removeColumn('email_verification_code')
            ->update();
    }
}

