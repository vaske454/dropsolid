<?php

namespace Drupal\dropsolid_dependency_injection;

/**
 * JsonPlaceholderService is a simple example of a Drupal 9 service
 */
class JsonPlaceholderService {

  /**
   * @return array
   */
  public function showPhotos() {
    $build = [
      '#cache' => [
        'max-age' => 60,
        'contexts' => ['url']
      ]
    ];

    try {
      $response = \Drupal::httpClient()->request('GET', "https://jsonplaceholder.typicode.com/albums/5/photos");
      $data = $response->getBody()->getContents();
      $decoded = json_decode($data);
      if (!$decoded) {
        throw new \Exception('Invalid data returned from API');
      }
    } catch (\Exception $e) {
      return $build;
    }

    foreach ($decoded as $item) {
      $build['rest_output_block']['photos'][] = [
        '#theme' => 'image',
        '#uri' => $item->thumbnailUrl,
        '#alt' => $item->title,
        '#title' => $item->title
      ];
    }

    return $build;
  }
}
