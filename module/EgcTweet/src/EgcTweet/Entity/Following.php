<?php
namespace EgcTweet\Entity;

class Following extends Base
{

    /**
     * @var int Id of the following entry
     */
    protected $id;

    /**
     * @var int Id of the user who owns this following
     */
    protected $userId;

    /**
     * @var string Twitter display name which is followed
     */
    protected $followingName;
    
    /**
     * @var int Id on Twitter for display name which is followed
     */
    protected $followingId;

    /**
     * @var int Order at which this following is added displayed
     */
    protected $followingOrder;

    public function exchangeArray(array $data)
    {
        foreach (array_keys(get_class_vars(__CLASS__)) as $prop_name)
        {
            $this->$prop_name = null;
            if (!empty($data[$prop_name]))
            {
                $this->$prop_name = $data[$prop_name];                
            }
        }
    }
}
