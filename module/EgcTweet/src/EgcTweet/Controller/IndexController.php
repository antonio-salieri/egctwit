<?php
namespace EgcTweet\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractController
{

    public function indexAction()
    {
        $profile_table = $this->getProfileTable();

        $identity = $this->zfcUserAuthentication()->getIdentity();
        if (! $identity) {
            $followings = $profile_table->getThreeRandomFollowings();
        } else {
            $followings = $profile_table->getUserFollowings($identity->getId());
        }
        return new ViewModel(array(
            'followings' => $followings
        ));
    }
}
