<?php
namespace Colorfield\Bulkmail;

interface Cleaner {
  /**
   * Validates an email address
   * @see https://documentation.mailgun.com/api-email-validation.html#example
   * @param $mail
   * @return mixed
   */
  public function validateAddress($mail);

  /**
   * Parses a list of email addresses
   * @param $mailList
   * @return mixed
   */
  public function parseAddressList(array $mailList);
}