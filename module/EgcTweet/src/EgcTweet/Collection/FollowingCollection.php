<?php
namespace EgcTweet\Collection;

use EgcTweet\Collection\BaseCollection;
use EgcTweet\Entity\Following;

class FollowingCollection extends BaseCollection
{
    public function add(Following $item)
    {
        parent::add($item);
    }
}
