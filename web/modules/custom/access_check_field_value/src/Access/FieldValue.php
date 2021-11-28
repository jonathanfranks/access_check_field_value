<?php

namespace Drupal\access_check_field_value\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Symfony\Component\Routing\Route;

/**
 * Determines whether the entity in the parameter has the given field value.
 *
 * @package Drupal\access_check_field_value\Access
 */
class FieldValue implements AccessInterface {

  /**
   * Access based on whether the current user owns the specified class.
   *
   * @param \Symfony\Component\Routing\Route $route
   *   The route.
   * @param \Drupal\Core\Routing\RouteMatchInterface $routeMatch
   *   The route matcher.
   *
   * @return \Drupal\Core\Access\AccessResultAllowed|\Drupal\Core\Access\AccessResultForbidden
   *   The access result.
   */
  public function access(Route $route, RouteMatchInterface $routeMatch) {
    $parameter = $route->getRequirement('_field_value_parameter');
    $field = $route->getRequirement('_field_value_field');
    $value = $route->getRequirement('_field_value_value');
    $negate = $route->getRequirement('_field_value_negate');

    $entity = $routeMatch->getParameter($parameter);
    if ($entity instanceof EntityInterface) {
      $actualValue = $entity->hasField($field) ? $entity->get($field)->value : NULL;
      if ($negate && $actualValue != $value) {
        return AccessResult::allowed();
      }
      elseif (!$negate && $actualValue == $value) {
        return AccessResult::allowed();
      }
    }
    return AccessResult::forbidden();
  }

}
