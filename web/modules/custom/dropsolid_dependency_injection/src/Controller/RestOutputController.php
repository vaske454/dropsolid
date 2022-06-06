<?php

namespace Drupal\dropsolid_dependency_injection\Controller;

use Drupal\dropsolid_dependency_injection\RestConnectionInterface;

/**
 * Class RestOutputController
 * @package Drupal\dropsolid_dependency_injection\Controller
 */
class RestOutputController {

  /**
   * @return array
   */
  public function showPhotos() {
    $restConnection = new RestConnectionInterface();
    return $restConnection->restConnection();
  }

}
