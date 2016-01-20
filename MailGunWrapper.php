<?php
require 'vendor/autoload.php';
use Mailgun\Mailgun;

/**
 * Facade for MailGun
 * @todo define and implement EmailValidator interface to allow dependency injection and change vendor (e.g. MailboxValidator)
 * @see https://documentation.mailgun.com
 */
class MailGunWrapper
{
  const key = 'pubkey-5ogiflzbnjrljiky49qxsiozqef5jxp7'; // @todo replace by api key
  const domain = 'your-domain'; // @todo replace by your domain

  var $client = null;

  function __construct()
  {
    $this->client = new Mailgun(MailGunWrapper::key);
  }

  /**
   * Sends a message.
   * @todo multipart test
   * @param $variables
   * @return \stdClass
   * @throws \Mailgun\Messages\Exceptions\MissingRequiredMIMEParameters
   */
  public function sendMessage($variables)
  {
    $response = $this->client->sendMessage(MailGunWrapper::domain, $variables);
    $result = $this->getResponse($response);
    return $result;
  }

  /**
   * Validates an email address
   * @see https://documentation.mailgun.com/api-email-validation.html#example
   * @param $mail
   * @return mixed
   */
  public function validateAddress($mail)
  {
    $response = $this->client->get("address/validate", array('address' => $mail));
    $result = $this->getResponse($response);
    return $result;
  }

  /**
   * Parsed a list of email addresses
   * @param $mailList
   * @return mixed
   */
  public function parseAddressList($mailList)
  {
    $response = $this->client->get("address/parse", array('addresses' => $mailList));
    $result = $this->getResponse($response);
    return $result;
  }

  /**
   * Basic response handler
   * @todo review decode
   * @param $response
   * @return null
   */
  private function getResponse($response)
  {
    $result = null;
    if((int) $response->http_response_code === 200) {
      $result = $response->http_response_body;
    }else {
      // @todo throw exception
    }
    return $result;
  }

}

// @todo move in unit test
$mailGun = new MailGunWrapper();
// send a message
/*
$variables = array(
  'from'    => 'Mailgun Sandbox <postmaster@your-sandobx.mailgun.org>',
  'to'      => 'John Doe <your@email.com>',
  'subject' => 'Hello John Doe',
  'text'    => 'Test email'
);
$result = $mailGun->sendMessage($variables);
print_r($result);
*/

// validate email
$result = $mailGun->validateAddress('your@email.com');
print_r($result);