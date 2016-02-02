<?php
require '../vendor/autoload.php';

// one column, without header
$csvPath = 'files/csv/one-column-mailing-list.csv';
$htmlPath = 'files/html/mail.html';
$txtPath = 'files/html/mail.html';
// to, text, html are prepared by the send method
$options = array(
  'from' => 'john@example.com',
  // @todo implement in send
  'to' => array(
    'john@example.com',
    ),
  'cc'  => array(),
  'bcc'  => array(),
  'subject' => 'Test',
  'text'    => 'Test email',  // @todo implement in send
  'html'    => '<p>Test email</p>',  // @todo implement in send
);
$bulkmail = new \Colorfield\Bulkmail\BulkMail($csvPath);
$bulkmail->send($htmlPath,$txtPath,$options);
