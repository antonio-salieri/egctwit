<?php
namespace EgcTweet\Form;

class Profile extends Base
{
    const NAME = 'user_profile';
    
    public function __construct($name = self::NAME, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array(
            'name' => 'names_to_follow[]',
            'options' => array(
                'label' => '1st to Follow',
            ),
            'type'  => 'Text',
        ));
        $this->add(array(
            'name' => 'names_to_follow[]',
            'options' => array(
                'label' => '2nd to Follow',
            ),
            'type'  => 'Text',
        ));
        $this->add(array(
            'name' => 'names_to_follow[]',
            'options' => array(
                'label' => '3rd to Follow',
            ),
            'type'  => 'Text',
        ));
    }
}
