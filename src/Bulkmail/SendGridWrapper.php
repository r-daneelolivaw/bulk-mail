<?php
namespace Colorfield\Bulkmail;

use SendGrid\SendGrid;
use SendGrid\Email;

/**
 * Adapter for Sendgrid.
 * @see https://github.com/sendgrid/sendgrid-php
 */
class SendGridWrapper implements Sender {
  // @todo move in settings.yml
  const KEY = ''; // @todo replace by api key, set this in settings.yml

  private $client = NULL;

  function __construct() {
    $this->client = new SendGrid(SendGridWrapper::KEY);
  }

  /**
   * {@inheritdoc}
   */
  public function sendMessage(array $variables) {
    $email = new SendGrid\Email();
    $email->addTo($variables['to']) // @todo foreach
          ->setFrom($variables['from'])
          ->setSubject($variables['subject'])
          ->setHtml($variables['html']);
    $response = $this->client->send($email);
  
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
