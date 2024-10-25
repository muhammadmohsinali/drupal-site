<?php

namespace Drupal\user_company_import\Commands;

use Drush\Commands\DrushCommands;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\migrate\MigrateExecutable;
use Drupal\migrate\MigrateImport;
use Drupal\migrate\MigrateException;

class UserCompanyImportCommands extends DrushCommands {
  
  protected $entityTypeManager;

  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    parent::__construct();
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * Command to import users and companies.
   *
   * @command uci:migrate
   * @description Import users and companies from JSON source.
   * @aliases uci-migrate
   */
  public function import() {
    try {
      // Import users.
      $userMigration = $this->entityTypeManager->getStorage('migrate')->load('migrate_plus.migration.user');
      $userMigration->setStatus(MigrateImport::STATUS_IDLE);
      $userMigrationExecutable = new MigrateExecutable($userMigration);
      $userMigrationExecutable->import();
      $this->output()->writeln("Users imported successfully.");

      // Import companies.
      $companyMigration = $this->entityTypeManager->getStorage('migrate')->load('migrate_plus.migration.company');
      $companyMigration->setStatus(MigrateImport::STATUS_IDLE);
      $companyMigrationExecutable = new MigrateExecutable($companyMigration);
      $companyMigrationExecutable->import();
      $this->output()->writeln("Companies imported successfully.");
      
    } catch (MigrateException $e) {
      $this->output()->writeln("Migration failed: " . $e->getMessage());
    }
  }
}
