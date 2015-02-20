<?php

namespace EgcTweet\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ZfcUser\Controller\UserController;
use EgcTweet\Form\ProfileForm;
use EgcTweet\Collection\FollowingCollection;

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
		$identity = $this->zfcUserAuthentication()->getIdentity();
		if (!$identity)
		{
			return $this->redirect()->toRoute(UserController::ROUTE_LOGIN);
		}

		$form = new ProfileForm();
		$followings = $profileTable->getUserFollowings($identity->getId());
		$form->bind($followings);

		return new ViewModel(array('form' => $form));
	}

	public function saveAction() {

		$identity = $this->zfcUserAuthentication()->getIdentity();
		if (!$identity)
		{
			return $this->redirect()->toRoute(UserController::ROUTE_LOGIN);
		}

		$form = new ProfileForm();
		$profileTable = $this->getProfileTable();
		$form->setData($this->getRequest()->getPost());
		if ($form->isValid())
		{
			$data = $form->getData();
			$collection = new FollowingCollection($data[ProfileForm::FOLLOWINGS_FIELDSET_NAME]);
			$user_id = $identity->getId();

			foreach ($collection as $item)
			{
				$following_name = $item->getFollowingName();
				// test
				if ($item->getFollowingId() && $following_name)
				    $profileTable->saveFollowing($item, $user_id);
				else if($item->getId() && empty($following_name))
					$profileTable->deleteFollowing($item->getId(), $user_id);
			}
		}

		return $this->redirect()->toRoute('profile');
	}
}
