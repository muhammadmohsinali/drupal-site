<?php

namespace Drupal\user_company_import\Commands;

use Drush\Commands\DrushCommands;
use Drupal\migrate_tools\MigrateExecutable;
use Drupal\migrate\MigrateMessage;
use Drupal::service;

/**
 * Defines Drush commands for user and company import.
 */
class UserCompanyImportCommands extends DrushCommands {

  /**
   * Run the user and company migration.
   *
   * @command user_company_import:migrate
   * @aliases uci-migrate
   */
  public function migrate() {
    // Run user migration.
    $user_migration = service('plugin.manager.migration')->createInstance('user_migration');
    $user_executable = new MigrateExecutable($user_migration, new MigrateMessage());
    $user_executable->import();

    // Run company migration.
    $company_migration = service('plugin.manager.migration')->createInstance('company_migration');
    $company_executable = new MigrateExecutable($company_migration, new MigrateMessage());
    $company_executable->import();

    $this->output()->writeln('Migration complete.');
  }
}
