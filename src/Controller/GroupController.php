<?php

namespace Sammy\FbGroupAggregator\Controller;

use Sammy\FbGroupAggregator\Model\GroupModel;

class GroupController {

    public function getGroupName() {
        return GroupModel::getGroupName();
    }

}