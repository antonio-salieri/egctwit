<?php

namespace EgcTweet\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $profile_table = $this->getProfileTable();

        $followings = $profile_table->getAllFollowings();
        return new ViewModel(array('followings' => $followings));
    }
}
