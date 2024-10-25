<?php

namespace Drupal\custom_user_migration\Controller;

use Drupal\Core\Controller\ControllerBase;

class UserCompanyController extends ControllerBase {

    /**
     * Displays the user and company information.
     *
     * @return array
     *   Render array for the page content.
     */
    public function content() {
        // Load all users except the anonymous user (uid 0)
        $users = \Drupal::entityTypeManager()
            ->getStorage('user')
            ->loadByProperties(['status' => 1]);

        $rows = [];
        foreach ($users as $user) {
            if ($user->id() == 0) continue;

            $company = $user->field_company->entity;
            $address_parts = [
                $user->field_street->value,
                $user->field_suite->value,
                $user->field_city->value,
                $user->field_zipcode->value,
            ];
            $full_address = implode(', ', array_filter($address_parts));

            $rows[] = [
                'username' => $user->getAccountName(),
                'full_name' => $user->field_full_name->value,
                'email' => $user->getEmail(),
                'phone' => $user->field_phone->value,
                'address' => $full_address,
                'website' => $user->field_website->value,
                'company' => $company ? $company->getTitle() : 'N/A',
                'company_catch_phrase' => $company ? $company->field_catch_phrase->value : 'N/A',
            ];
        }

        // Build the table render array
        $build['table'] = [
            '#type' => 'table',
            '#header' => [
                'Username',
                'Full Name',
                'Email',
                'Phone',
                'Address',
                'Website',
                'Company',
                'Company Catch Phrase',
            ],
            '#rows' => $rows,
            '#empty' => $this->t('No users found.'),
        ];

        return $build;
    }
}