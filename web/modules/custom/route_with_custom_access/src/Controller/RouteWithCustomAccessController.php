<?php

namespace Drupal\route_with_custom_access\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;

class RouteWithCustomAccessController extends ControllerBase {

  /**
   * Returns the word "Okay".
   *
   * @param \Drupal\node\NodeInterface $node
   *   The node.
   *
   * @return string[]
   *   The build array.
   */
  public function returnOk(NodeInterface $node) {
    return [
      '#markup' => 'Okay',
    ];
  }

}
