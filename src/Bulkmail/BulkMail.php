<?php
namespace Colorfield\Bulkmail;

use League\Csv\Reader;

/**
 * Class BulkMail
 * @todo CLI helper to pass parameters from the command line
 * @todo description
 * @package colorfield\bulkmail
 */
class BulkMail {
  private $csv = null;
  private $validator = null;
  private $cleaner = null;
  private $sender = null;
  private $mailColumn = 0;

  function __construct($pathToCSV, $column = 0) {
    // @todo handle exception (try catch)
    $this->mailColumn = $column;
    // @see http://csv.thephpleague.com/
    // @todo
    $this->csv = Reader::createFromPath($pathToCSV);
  }

  /**
   * @todo description
   * @param bool $ignoreFirst
   */
  public function clean($ignoreFirst = false, $addGrade = false, $addDidYouMean = false) {
    // read csv
    $rows = array();
    if ($ignoreFirst) {
      // side effect of fetchOne iterates to the next row
      // so either fetchOne or setOffset(1) should be used, not both
      //$headers = $this->csv->fetchOne();
      $rows = $this->csv->setOffset(1)->fetchAll();
    }
    else {
      $rows = $this->csv->fetchAll();
    }

    if (!empty($rows)) {
      // @todo provide factory or inject dependence or fetch from settings.yml
      $this->validator = new MailGunWrapper();
      // @todo parse addresses first and retain only the correct ones
      // @todo log the wrong addresses in a csv log :
      foreach($rows as $row) {
        $result = $this->validator->validateAddress($row[$this->mailColumn]);
        print_r($result);
      }
    }
  }

  /**
   * @todo description
   * Validation and/or cleaning must be handled by the client.
   * @param $pathToHtml
   * @param $pathToText
   * @param array $options
   */
  public function send($pathToHtml, $pathToText, array $options) {
    // @todo implement
    // @todo provide factory or inject dependence or fetch from settings.yml
    $this->sender = new MandrillWrapper();

    // @todo populate to with csv
    // @todo set html from file
    // @todo set text from file

    // @todo provide the same object if it implements both Cleaner and Sender
    $result = $this->sender->sendMessage($options);
  }

  /**
   * Outputs the difference between two CSV lists
   * @param $firstCsv
   * @param $secondCsv
   * @param $mailColumn
   */
  public function diff($firstCsv, $secondCsv, $mailColumn) {
    // @todo implement
    // @todo review https://packagist.org/packages/diff/diff and https://packagist.org/packages/sebastian/diff
  }

  /**
   * Outputs the intersection between two CSV lists
   * @param $firstCsv
   * @param $secondCsv
   * @param $mailColumn
   */
  public function intersect($firstCsv, $secondCsv, $mailColumn) {
    // @todo implement
  }

}
