--TEST--
PDO OCI checkliveness (code coverage)
--EXTENSIONS--
pdo
pdo_oci
--SKIPIF--
<?php
require(getenv('PDO_TEST_DIR').'/pdo_test.inc');
PDOTest::skip();
?>
--FILE--
<?php

require(getenv('PDO_TEST_DIR').'/pdo_test.inc');
$db = PDOTest::test_factory(getenv('PDO_OCI_TEST_DIR').'/common.phpt');

$dsn = getenv('PDOTEST_DSN');
$user = getenv('PDOTEST_USER');
$pass = getenv('PDOTEST_PASS');
$attr = getenv('PDOTEST_ATTR');

try {
    $db = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true));
}
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

// This triggers the call to check liveness
try {
    $db = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true));
}
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

try {
    $stmt = $db->prepare('SELECT * FROM dual');
    $stmt->execute();
    $row = $stmt->fetch();
    var_dump($row);
} catch (PDOException $e) {
    print $e->getMessage();
}

$db = null;
?>
--EXPECT--
array(2) {
  ["DUMMY"]=>
  string(1) "X"
  [0]=>
  string(1) "X"
}
