<?php

/**
 * sfZendMailPlugin configuration.
 *
 * @package     sfZendMailPlugin
 * @subpackage  config
 * @author      Benjamin Runnels <benjamin.r.runnels@citi.com>
 * @version     SVN: $Id: PluginConfiguration.class.php 17207 2009-04-10 15:36:26Z Kris.Wallsmith $
 */
class sfZendMailPluginConfiguration extends sfPluginConfiguration
{
  const VERSION = '1.0.0-DEV';

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $this->dispatcher->connect('routing.load_configuration', array('sfZendMailPluginRouting', 'listenToRoutingLoadConfigurationEvent'));
    $this->dispatcher->connect('component.method_not_found', array('sfZendMailUtil', 'componentMethodNotFound'));
    $this->dispatcher->connect('configuration.method_not_found', array('sfZendMailUtil', 'configurationMethodNotFound'));
  }
}
