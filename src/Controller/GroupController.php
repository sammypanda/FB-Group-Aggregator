<?php

namespace Sammy\FbGroupAggregator\Controller;

use Sammy\FbGroupAggregator\Model\Group;

class GroupController {

    public function getGroupName() {
        return Group::getGroupName();
    }

}