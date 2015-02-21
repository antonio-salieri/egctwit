<?php
namespace EgcTweet\Table;

use Zend\Db\TableGateway\TableGateway;
use EgcTweet\Collection\FollowingCollection;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use EgcTweet\Entity\Following;

class FollowingTable
{

    const TABLE_NAME = 'following';

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getAllFollowings()
    {
        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql->select();
        $select->from(self::TABLE_NAME);

        $rowset = $this->tableGateway->selectWith($select);

        $collection = new FollowingCollection();
        foreach ($rowset as $row) {
            $collection->add($row);
        }

        return $collection;
    }
    public function getUserFollowings($userId)
    {
        $id = (int) $userId;
        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql->select();
        $select->from(self::TABLE_NAME)
            ->where(array(
                'userId' => $id
            ));

        $rowset = $this->tableGateway->selectWith($select);

        $collection = new FollowingCollection();
        foreach ($rowset as $row) {
            $collection->add($row);
        }

        return $collection;
    }

    public function getUserFollowing($id, $user_id)
    {
        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql->select();
        $select->from(self::TABLE_NAME)
            ->where(array(
                'id' => $id,
                'userId' => $user_id
            ));

        $rowset = $this->tableGateway->selectWith($select);

        $row = $rowset->current();
        if (! $row) {
            throw new \Exception("Could not find following");
        }

        return $row;
    }

    public function saveFollowing(Following $following, $user_id)
    {
        $id = (int) $following->getId();

        if (!$id)
        {
        	$following->setUserId($user_id);
        }
        $data = $following->getData();
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getUserFollowing($id, $user_id)) {
                $this->tableGateway->update($data, array(
                    'id' => (int)$id
                ));
            } else {
                throw new \Exception('Following does not exist');
            }
        }
    }

    public function deleteFollowing($id, $user_id)
    {
        $this->tableGateway->delete(array(
            'id' => (int) $id,
        	'userId' => (int)$user_id
        ));
    }
}
