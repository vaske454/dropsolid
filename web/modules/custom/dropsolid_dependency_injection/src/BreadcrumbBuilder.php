<?php

namespace Drupal\dropsolid_dependency_injection;

use Drupal\Core\Breadcrumb\Breadcrumb;
use Drupal\Core\Breadcrumb\BreadcrumbBuilderInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Link;
use Drupal\node\NodeInterface;

class BreadcrumbBuilder implements BreadcrumbBuilderInterface {

  /**
   * {@inheritdoc}
   */
  public function applies(RouteMatchInterface $attributes) {
    $parameters = $attributes->getParameters()->all();
    if (isset($parameters['node']) && $parameters['node'] instanceof NodeInterface) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function build(RouteMatchInterface $route_match) {
    $breadcrumb = new Breadcrumb();

    $breadcrumb->addLink(Link::createFromRoute('Drop', '<front>'));
    $breadcrumb->addLink(Link::createFromRoute('Example', '<nolink>'));
    $node = \Drupal::routeMatch()->getParameter('node');

    // Don't forget to add cache control,otherwise you will surprised,
    // all breadcrumb will be the same for all pages.
    // By setting a "cache context" to the "url", each requested URL gets it's
    // own cache. This way a single breadcrumb isn't cached for all pages on the
    // site.
    $breadcrumb->addCacheContexts(['url']);

    // By adding "cache tags" for this specific node, the cache is invalidated
    // when the node is edited.
    $breadcrumb->addCacheTags(["dropsolid"]);

    return $breadcrumb;
  }

}
