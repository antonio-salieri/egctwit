<?php
namespace EgcTweet\Table;

use Zend\Db\TableGateway\TableGateway;
use EgcTweet\Collection\FollowingCollection;

class FollowingTable
{
    const TABLE_NAME = 'following';
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getUserFollowings($userId)
    {
        $id = (int) $userId;
        $rowset = $this->tableGateway->select(array(
            'userId' => $id
        ));
        
        $collection = new FollowingCollection();
        foreach ($rowset as $row)
        {
        	$collection->add($row);
        }

//         $row = $rowset->current();
//         if (! $row) {
//             throw new \Exception("Could not find row $id");
//         }
        return $collection;
    }
}
