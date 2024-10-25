# Custom User Migration

This module provides a migration solution for importing users and company data from a JSON API into Drupal.

## Requirements

- Drupal 9 or 10
- Migrate Plus module
- Migrate Tools module

## Installation

1. Place this module in your Drupal installation under `modules/custom/custom_user_migration`
2. Enable required modules:
   ```bash
   drush en migrate_plus migrate_tools custom_user_migration -y
   ```

## Usage

### Run Migration
```bash

drush migrate:import user_migration
drush migrate:import company_migration

```

### Rollback Migration
```bash
drush custom:rollback-users
# or use the alias
drush cmr
```

### View Results
Visit `/user-companies` to see the imported data in a table format.

## Features

- Imports company data as nodes
- Imports user data with complete address information
- Creates relationships between users and companies
- Provides a custom page to view all imported data
- Includes Drush commands for easy migration management
