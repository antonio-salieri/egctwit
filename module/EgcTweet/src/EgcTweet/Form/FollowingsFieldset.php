<?php

namespace EgcTweet\Form;

use Zend\ModuleManager\Feature\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods;
use EgcTweet\Entity\Following;
use Zend\Form\Element\Text;

class FollowingsFieldset extends Fieldset implements InputFilterProviderInterface {

	public function __construct() {
		parent::__construct('following');

		$this->setHydrator(new ClassMethods(false))
			->setObject(new Following());


        $text_el = new Text('followingName', array(
			'label' => 'Follow'
		));
		$text_el->setAttribute('placeholder', 'Type name here');
		$text_el->setAttribute('autocomplete', 'off');
		$text_el->setAttribute('class', 'typeahead form-control');
// 		$text_el->setAttribute('class', 'form-control');
		$text_el->setAttribute('data-provide', 'typeahead');

		$this->add($text_el);

		$this->add(array(
			'type' => 'Hidden',
			'name' => 'followingId'
		));

		$this->add(array(
			'type' => 'Hidden',
			'name' => 'id'
		));

		$this->add(array(
	            'type' => 'Hidden',
        	    'name' => 'userId'
		));
	}

	public function getInputFilterConfig() {
		return array(
			'followingName' => array(
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				)
			),
			'followingId' => array(
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				)
			),
			'id' => array(
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				)
			),
			'userId' => array(
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				)
			)
		);
	}
}
