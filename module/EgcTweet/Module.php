<?php
namespace EgcTweet;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use EgcTweet\Entity\Following;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use EgcTweet\Service\Twitter;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            )
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'EgcTweet\Table\FollowingTable' => function ($sm)
                {
                    $tableGateway = $sm->get('FollowingTableGateway');
                    $table = new \EgcTweet\Table\FollowingTable($tableGateway);
                    return $table;
                },
                'FollowingTableGateway' => function ($sm)
                {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Following());
                    return new TableGateway(\EgcTweet\Table\FollowingTable::TABLE_NAME, $dbAdapter, null, $resultSetPrototype);
                },
                'EgcTwitter' => function($sm)
                {
                	$config = $sm->get('Config');
                	return new Twitter($config['egc_tweet']);
                }
            )
        );
    }
}
