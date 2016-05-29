<?php
// Get Devices models from the devicemodelview based on $_GET['term'] for Ajax output on devices.php
require_once("../../../classes/db2.class.php");
require_once("../../../config/config.inc.php");
$db2  = new db2();
$term = $_GET['term'];
$db2->query("SELECT cmd.command as value
                FROM cmdCatTbl AS cct
                LEFT JOIN configcommands AS cmd ON cmd.id = cct.configCmdId
                WHERE cct.nodeCatId = (SELECT nodeCatId from nodes WHERE id = :term)");
$db2->bind(':term', $term); //bind here and create wildcard search term here also
$rows = $db2->resultset();
echo json_encode($rows);