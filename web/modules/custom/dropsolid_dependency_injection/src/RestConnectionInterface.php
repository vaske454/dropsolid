<?php
namespace Drupal\dropsolid_dependency_injection;

class RestConnectionInterface {
  public function restConnection() {
    return \Drupal::service('dropsolid_dependency_injection.jsonplaceholder')
      ->showPhotos();
  }
}
