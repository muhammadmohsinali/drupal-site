<?php

namespace Drupal\custom_user_migration\Commands;

use Drush\Commands\DrushCommands;
use Drupal\migrate\MigrateExecutable;
use Drupal\migrate\MigrateMessage;

/**
 * Custom Drush commands for user migration.
 */
class CustomUserMigrationCommands extends DrushCommands {

    /**
     * Runs the user and company migrations.
     *
     * @command custom:migrate-users
     * @aliases cmu
     * @usage custom:migrate-users
     */
    public function migrateUsers() {
        try {
            // Run company migration first
            $migration_company = \Drupal::service('plugin.manager.migration')
                ->createInstance('company_migration');
            $executable = new MigrateExecutable($migration_company, new MigrateMessage());
            $executable->import();

            $this->output()->writeln('Company migration completed successfully.');

            // Then run user migration
            $migration_user = \Drupal::service('plugin.manager.migration')
                ->createInstance('user_migration');
            $executable = new MigrateExecutable($migration_user, new MigrateMessage());
            $executable->import();

            $this->output()->writeln('User migration completed successfully.');

        } catch (\Exception $e) {
            $this->output()->writeln('Migration failed: ' . $e->getMessage());
        }
    }

    /**
     * Rolls back user and company migrations.
     *
     * @command custom:rollback-users
     * @aliases cmr
     * @usage custom:rollback-users
     */
    public function rollbackUsers() {
        try {
            // Rollback user migration first
            $migration_user = \Drupal::service('plugin.manager.migration')
                ->createInstance('user_migration');
            $executable = new MigrateExecutable($migration_user, new MigrateMessage());
            $executable->rollback();

            $this->output()->writeln('User migration rolled back successfully.');

            // Then rollback company migration
            $migration_company = \Drupal::service('plugin.manager.migration')
                ->createInstance('company_migration');
            $executable = new MigrateExecutable($migration_company, new MigrateMessage());
            $executable->rollback();

            $this->output()->writeln('Company migration rolled back successfully.');

        } catch (\Exception $e) {
            $this->output()->writeln('Rollback failed: ' . $e->getMessage());
        }
    }
}