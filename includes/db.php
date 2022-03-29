<?php

// instantiation of Database -> providing connetion
// transferring constant variables to class Database __constructor
$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
return $db->getConn();
