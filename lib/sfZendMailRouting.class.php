<?php

/**
 * Routing configuration
 *
 * @package    sfZendMailPlugin
 * @subpackage routing
 * @author     Benjamin Runnels <kraven@kraven.org>
 * @see        http://www.symfony-project.org/plugins/sfZendMailPlugin
 */
class sfZendMailPluginRouting
{
  /**
   * Listens to the routing.load_configuration event.
   *
   * @param sfEvent An sfEvent instance
   */
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $r = $event->getSubject();

    $r->prependRoute(
      'send_email',
      new sfRoute(
        '/send_email.:sf_format',
        array('module' => 'sendemail', 'action' => 'sendEmail')
      )
    );
  }
}
