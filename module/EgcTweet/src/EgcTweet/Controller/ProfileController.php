<?php

namespace EgcTweet\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProfileController extends AbstractActionController {
	
	protected $profileTable;
	
	protected function getProfileTable() {
		if (!$this->profileTable) {
			$sm = $this->getServiceLocator();
			$this->profileTable = $sm->get('EgcTweet\Table\FollowingTable');
		}
		return $this->profileTable;
	}
	
	public function indexAction() {
		
		$profileTable = $this->getProfileTable();
		var_dump($profileTable->getUserFollowings(2));
		
		return new ViewModel();
	}
}
