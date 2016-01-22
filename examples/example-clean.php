<?php
require '../vendor/autoload.php';

// one column, without header
$csvPath = 'files/one-column-mailing-list.csv';
$bulkmail = new \Colorfield\Bulkmail\BulkMail($csvPath);
$bulkmail->clean(false);

// @todo multiple columns, with header

// @todo add did you mean addresses

// @todo add grade