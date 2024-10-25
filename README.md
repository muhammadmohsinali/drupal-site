# Drupal Site 
  Version: 10.3.6
  PHP Version: 8.2.25
  MySQL Version: 8.0.30

#IMPORTANT NOTE

1) You need to run composer install command in order to have Drupal core with all dependencies.
2) The database is attached in the main repo, called database.zip.

# Drupal JSON User Migration

A Drupal 10 project that provides functionality to import users and company data from the JSONPlaceholder API into Drupal entities.

## Overview

This drupal project demonstrates how to:
- Import external JSON data into Drupal entities
- Create relationships between migrated entities
- Handle nested JSON data structures
- Implement custom Drush commands for migration management
- Display migrated data in a custom table view

## Requirements

- Drupal 9.x or 10.x
- PHP 8.1+
- [Migrate Plus](https://www.drupal.org/project/migrate_plus)
- [Migrate Tools](https://www.drupal.org/project/migrate_tools)

## Installation

1. Download and enable required modules:
```bash
composer require drupal/migrate_plus drupal/migrate_tools
```

2. Clone this repository to your Drupal installation:
```bash
cd web/modules/custom
git clone [your-repository-url] custom_user_migration
```

3. Enable the module:
```bash
drush en custom_user_migration -y
```

## Usage

### Running Migrations

1. Import company data:
```bash
drush migrate:import company_migration
```

2. Import user data:
```bash
drush migrate:import user_migration
```

### Rolling Back Migrations

To remove all migrated data:
```bash
drush custom:rollback-users
# or use the alias
drush cmr
```

### Viewing Migrated Data

Visit `/user-companies` to see a table of all imported users and their associated company information.

## Data Structure

### Companies
The module creates companies as nodes with the following fields:
- Title (Company Name)
- Catch Phrase
- Business Strategy (BS)

### Users
Users are created with these additional fields:
- Full Name
- Phone
- Website
- Address Information (Street, Suite, City, Zipcode)
- Geolocation (Latitude, Longitude)
- Company Reference

## API Source

This module uses [JSONPlaceholder](https://jsonplaceholder.typicode.com/) as its data source:
- Users API: `https://jsonplaceholder.typicode.com/users`

## Troubleshooting

If migrations aren't working:

1. Clear Drupal's cache:
```bash
drush cr
```

2. Check migration status:
```bash
drush migrate:status
```

3. Reset migrations:
```bash
drush migrate:reset-status company_migration
drush migrate:reset-status user_migration
```

4. Check recent log messages:
```bash
drush watchdog:show
```

## Module Structure

```
custom_user_migration/
├── config/
│   └── install/
│       ├── migrate_plus.migration_group.json_migrations.yml
│       ├── migrate_plus.migration.company_migration.yml
│       └── migrate_plus.migration.user_migration.yml
├── src/
│   ├── Controller/
│   │   └── UserCompanyController.php
│   └── Commands/
│       └── CustomUserMigrationCommands.php
├── custom_user_migration.info.yml
├── custom_user_migration.routing.yml
└── README.md
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Credits

- JSONPlaceholder for providing the test API
- Drupal Migration API contributors
- Migrate Plus and Migrate Tools module maintainers

## Author

[Muhammad Mohsin Ali]
- GitHub: [https://github.com/muhammadmohsinali/]
- Linkedin: [https://pk.linkedin.com/in/muhammadmohsinali071]

## Support

For support, please:
1. Check the issues page in the GitHub repository
2. Create a new issue if your problem isn't already listed
3. Contact the maintainer
