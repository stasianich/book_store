<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20200720134132 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE "book" (id UUID NOT NULL,
                                                title VARCHAR(255) NOT NULL,
                                                photo VARCHAR(255) DEFAULT NULL, 
                                                price INT NOT NULL, 
                                                description TEXT DEFAULT NULL, 
                                                created_time INT NOT NULL, 
                                                updated_time INT NOT NULL, 
                                                PRIMARY KEY(id))');

        $this->addSql('CREATE TABLE "user" (id UUID NOT NULL, 
                                                name VARCHAR(255) NOT NULL, 
                                                mobile BIGINT NOT NULL, 
                                                mailing BOOLEAN NOT NULL, 
                                                is_deleted BOOLEAN NOT NULL, 
                                                PRIMARY KEY(id))');

        $this->addSql('CREATE TABLE "admin" (id UUID NOT NULL, 
                                                 email VARCHAR(255) NOT NULL,
                                                 password_hash VARCHAR(128) NOT NULL, 
                                                 PRIMARY KEY(id))');

        $this->addSql('CREATE TABLE "order" (id UUID NOT NULL,
                                                 book_id UUID NOT NULL, 
                                                 buyer_id UUID NOT NULL, 
                                                 admin_id UUID NOT NULL, 
                                                 created_time INT NOT NULL, 
                                                 moderated_time INT NOT NULL, 
                                                 PRIMARY KEY(id),
                                                FOREIGN KEY(book_id) REFERENCES "book"(id),
                                                FOREIGN KEY(buyer_id) REFERENCES "user"(id),
                                                FOREIGN KEY(admin_id) REFERENCES "admin"(id))');

        $this->addSql('INSERT INTO "book"(id, title, photo, price, description, created_time, updated_time)
                           VALUES(:id, :title, :photo, :price, :description, :created_time, :updated_time)',
                           [
                               ':id' => '10bc05ea-a876-400e-81bc-ffdc4c74dbaf',
                               ':title' => 'test_title01',
                               ':photo' => 'assets/main/images/portfolio/cake.png',
                               ':price' => 30000,
                               ':description' => 'test_description',
                               ':created_time' => 1595272048,
                               ':updated_time' => 0,
                           ]);

        $this->addSql('INSERT INTO "user"(id, name, mobile, mailing, is_deleted)
                           VALUES(:id, :name, :mobile, :mailing, :is_deleted)',
                           [
                               ':id' => '416d34fa-120d-47f4-999c-8db68c18a014',
                               ':name' => 'Stas',
                               ':mobile' => 380969483279,
                               ':mailing' => "true",
                               ':is_deleted' => "false"
                           ]);

        $this->addSql('INSERT INTO "admin"(id, email, password_hash)
                           VALUES(:id, :email, :password_hash)',
                           [
                               ':id' => 'fe77ad80-e99b-4c62-8071-3d8c8c16b66e',
                               ':email' => 'spechenuy@gmail.com',
                               ':password_hash' => '$argon2i$v=19$m=65536,t=4,p=1$MFlXaGE5eUx0NWxQNHRYOQ$g6YDv08Isc8uTcSj46OQ/mwL0ftAon4qxOYrrIoPNXE'
                           ]);

        $this->addSql('INSERT INTO "order"(id, book_id, buyer_id, admin_id, created_time, moderated_time)
                           VALUES(:id, :book_id, :buyer_id, :admin_id, :created_time, :moderated_time)',
                           [
                               ':id' => '8921a1c2-c6ed-4d1d-8288-18841238892c',
                               ':book_id' => '10bc05ea-a876-400e-81bc-ffdc4c74dbaf',
                               ':buyer_id' => '416d34fa-120d-47f4-999c-8db68c18a014',
                               ':admin_id' => 'fe77ad80-e99b-4c62-8071-3d8c8c16b66e',
                               ':created_time' => 1595273734,
                               ':moderated_time' => 0
                           ]);
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
/*
        $this->addSql('DELETE FROM "order" WHERE id = :id', [':id' => "8921a1c2-c6ed-4d1d-8288-18841238892c"]);

        $this->addSql('DELETE FROM "admin" WHERE id = :id', [':id' =>  "fe77ad80-e99b-4c62-8071-3d8c8c16b66e"]);

        $this->addSql('DELETE FROM "user" WHERE id = :id', [':id' => "416d34fa-120d-47f4-999c-8db68c18a014"]);

        $this->addSql('DELETE FROM "book" WHERE id = :id', [':id' => "10bc05ea-a876-400e-81bc-ffdc4c74dbaf"]);
*/
        $this->addSql('DROP TABLE "order"');

        $this->addSql('DROP TABLE "admin"');

        $this->addSql('DROP TABLE "user"');

        $this->addSql('DROP TABLE "book"');
    }
}
