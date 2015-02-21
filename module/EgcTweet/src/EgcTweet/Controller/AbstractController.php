<?php
namespace EgcTweet\Controller;

use Zend\Mvc\Controller\AbstractActionController;

abstract class AbstractController extends AbstractActionController
{

    protected $profileTable;

    protected function getProfileTable()
    {
        if (! $this->profileTable) {
            $sm = $this->getServiceLocator();
            $this->profileTable = $sm->get('EgcTweet\Table\FollowingTable');
        }
        return $this->profileTable;
    }
}
