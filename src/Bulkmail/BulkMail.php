<?php
namespace Colorfield\Bulkmail;
use League\Csv\Reader;

/**
 * Class BulkMail
 *
 * @todo description
 * @package colorfield\bulkmail
 */
class BulkMail {
  private $csv = NULL;
  private $validator = NULL;
  private $mailColumn = 0;

  function __construct($pathToCSV, $column = 0) {
    // @todo handle exception
    $this->mailColumn = $column;
    // @see http://csv.thephpleague.com/
    // @todo try catch
    $this->csv = Reader::createFromPath($pathToCSV);
  }

  /**
   * @todo description
   * @param bool $ignoreFirst
   */
  public function clean($ignoreFirst = FALSE) {
    // @todo provide factory
    $this->validator = new MailGunWrapper(); // @todo dependency injection + factory

    // read csv
    if ($ignoreFirst) {
      //$headers = $this->csv->fetchOne();
      $rows = $this->csv->setOffset(1)->fetchAll();
    }
    else {
      $rows = $this->csv->fetchAll();
    }
  }

  /**
   * @todo description
   * @param $pathToHtml
   * @param $pathToText
   * @param array $options
   */
  public function send($pathToHtml, $pathToText, array $options) {
    // @todo implement
  }

}
