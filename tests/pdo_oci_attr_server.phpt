--TEST--
PDO_OCI: Attribute: Server version and info
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

$dbh = PDOTest::factory();

echo "Test 1\n";
echo "ATTR_SERVER_VERSION: ";
var_dump($dbh->getAttribute(PDO::ATTR_SERVER_VERSION));

echo "Test 2\n";
echo "ATTR_SERVER_INFO\n";
$si = $dbh->getAttribute(PDO::ATTR_SERVER_INFO);
$pos = strpos($si, "Oracle");
if ($pos === 0) {
    echo "Found 'Oracle' at position $pos as expected\n";
} else {
    echo "Unexpected result.  Server info was:\n";
    var_dump($si);
}

echo "Done\n";

?>
--EXPECTF--
Test 1
ATTR_SERVER_VERSION: string(%d) "%d.%d.%d.%d.%d"
Test 2
ATTR_SERVER_INFO
Found 'Oracle' at position 0 as expected
Done
