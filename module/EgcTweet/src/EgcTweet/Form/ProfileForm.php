<?php
namespace EgcTweet\Form;

use Zend\Form\Element\Button;
use EgcTweet\Entity\Following;
class ProfileForm extends BaseForm
{
    const NAME = 'user_profile';
    const FOLLOWINGS_FIELDSET_NAME = 'followings';

    public function __construct($name = self::NAME, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
			'type' => 'EgcTweet\Form\Element\Collection',
// 			'type' => 'Zend\Form\Element\Collection',
			'name' => self::FOLLOWINGS_FIELDSET_NAME,
			'options' => array (
				'label' => 'Please enter names of person/thing to follow',
				'count' => 3,
				'allow_add' => false,
// 				'allow_remove' => false,
				'target_element' => array (
					'type' => 'EgcTweet\Form\FollowingsFieldset'
				),
				'use_as_base_fieldset' => true
			)
        ));

        $submitElement = new Button('submit');
        $submitElement->setLabel('Save');
        $submitElement->setAttribute('class', 'btn btn-primary');
        $submitElement->setAttribute('type', 'submit');

        $this->add($submitElement);
    }
}
