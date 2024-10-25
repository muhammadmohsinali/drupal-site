<?php

namespace Drupal\custom_user_migration\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

class MigrationTestController extends ControllerBase {

    public function testFetch() {
        try {
            // Test direct HTTP fetch
            $response = \Drupal::httpClient()->get('https://jsonplaceholder.typicode.com/users');
            $data = json_decode($response->getBody(), TRUE);

            // Log the results
            \Drupal::logger('custom_user_migration')->notice('Fetched @count records', ['@count' => count($data)]);

            foreach ($data as $item) {
                \Drupal::logger('custom_user_migration')->notice('Company data: @data', [
                    '@data' => print_r($item['company'], TRUE)
                ]);
            }

            return new JsonResponse([
                'status' => 'success',
                'count' => count($data),
                'sample' => $data[0]
            ]);
        }
        catch (\Exception $e) {
            \Drupal::logger('custom_user_migration')->error('Fetch error: @error', ['@error' => $e->getMessage()]);
            return new JsonResponse([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}