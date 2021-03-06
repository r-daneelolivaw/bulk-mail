<?php
namespace Colorfield\Bulkmail;

use Mailgun\Mailgun;

/**
 * Adapter for MailGun.
 * Allows both cleaning and sending.
 * @see https://documentation.mailgun.com
 */
class MailGunWrapper implements Cleaner, Sender {
  // @todo move in settings.yml
  const KEY = 'pubkey-5ogiflzbnjrljiky49qxsiozqef5jxp7'; // @todo replace by api key, set this in settings.yml
  const DOMAIN = 'your-domain'; // @todo replace by your domain, set this in settings.yml

  private $client = NULL;

  function __construct() {
    $this->client = new Mailgun(MailGunWrapper::KEY);
  }

  /**
   * {@inheritdoc}
   * @throws \Mailgun\Messages\Exceptions\MissingRequiredMIMEParameters
   */
  public function sendMessage(array $variables) {
    $response = $this->client->sendMessage(MailGunWrapper::DOMAIN, $variables);
    $result = $this->getResponse($response);
    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function validateAddress($mail) {
    $response = $this->client->get("address/validate", array('address' => $mail));
    $result = $this->getResponse($response);
    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function parseAddressList(array $mailList) {
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
  private function getResponse($response) {
    $result = NULL;
    if ((int) $response->http_response_code === 200) {
      $result = $response->http_response_body;
    }
    else {
      // @todo throw exception
    }
    return $result;
  }
}
