--TEST--
PECL PDO_OCI Bug #11345 (Test invalid character set name)
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

// This tests only part of PECL bug 11345.  The other part - testing
// when the National Language Support (NLS) environment can't be
// initialized - is very difficult to test portably.

try {
    $dbh = new PDO('oci:dbname=xxx;charset=yyy', 'abc', 'def');
}
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage(). "\n";
    exit;
}

echo "Done\n";

?>
--EXPECTF--
Connection failed: SQLSTATE[HY000]: OCINlsCharSetNameToId: unknown character set name (%s)
