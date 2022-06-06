<?php

namespace Drupal\dropsolid_dependency_injection\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\dropsolid_dependency_injection\RestConnectionInterface;

/**
 * Provides a 'RestOutputBlock' block.
 *
 * @Block(
 *  id = "rest_output_block",
 *  admin_label = @Translation("Rest output block"),
 * )
 */
class RestOutputBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $restConnection = new RestConnectionInterface();
    return $restConnection->restConnection();
  }

}
