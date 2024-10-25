# User Company Import

This custom module imports user and company data from a JSON API and displays it on a custom route.

## Dependencies

- Migrate Plus

## Installation

1. Enable the module: `drush en user_company_import`
2. Run the migrations: `drush user_company_import:migrate`
3. Visit `/user-company-list` to see the data.

## Drush Command

- `drush uci-migrate`: Runs the user and company migrations.
