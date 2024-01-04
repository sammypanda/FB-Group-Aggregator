<?php 

require 'vendor/autoload.php';

use Sammy\FbGroupAggregator\Controller\GroupController;

$groupController = new GroupController();
echo $groupController->getGroupName();

?>