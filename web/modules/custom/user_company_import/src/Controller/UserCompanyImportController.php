<?php

namespace Drupal\user_company_import\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\Entity\User;

class UserCompanyImportController extends ControllerBase {
  public function userCompanyList() {
    // Fetch all users.
    $users = User::loadMultiple();

    // Log the number of users found
    \Drupal::logger('user_company_import')->notice('Number of users found: ' . count($users));

    // Table header.
    $header = [
        'ID',
        'Name',
        'Username',
        'Email',
        'Phone',
        'Website',
    ];

    // Table rows.
    $rows = [];
    foreach ($users as $user) {
        $rows[] = [
            $user->id(),
            $user->getDisplayName(),
            $user->get('field_username')->value ?? 'N/A',
            $user->getEmail(),
            $user->get('field_phone')->value ?? 'N/A',
            $user->get('field_website')->value ?? 'N/A',
        ];
    }

    return [
        '#theme' => 'user_company_list',
        '#header' => $header,
        '#rows' => $rows,
    ];
}

}
