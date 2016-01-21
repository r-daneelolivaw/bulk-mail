<?php
require '../vendor/autoload.php';
$csvPath = 'files/one-column-mailing-list.csv';
// @todo provide more examples
$bulkmail = new \Colorfield\Bulkmail\BulkMail($csvPath);
$bulkmail->clean(true);
