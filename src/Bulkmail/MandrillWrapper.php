<?php
namespace Colorfield\Bulkmail;

use DotBlue\Mandrill;

/**
 * Class MandrillWrapper
 * Adapter for Mandrill, based on DotBlue api wrapper.
 * @package colorfield\bulkmail
 */
class MandrillWrapper implements Sender
{
  private $mandrill;
  private $mailer;
  private $message;

  function __construct() {
    // @todo fetch $apiKey from settings.yml
    $apiKey = '';
    $this->mandrill = new \DotBlue\Mandrill\Mandrill($apiKey);
    $this->mailer = new \DotBlue\Mandrill\Mailer(new \DotBlue\Mandrill\Exporters\MessageExporter(), $this->mandrill);
    $this->message = new \DotBlue\Mandrill\Message();
  }

  /**
   * {@inheritdoc}
   * @todo provide decorator to implement all api features
   * @see https://mandrillapp.com/api/docs/messages.php.html
   * @see https://packagist.org/packages/dotblue/mandrill
   */
  public function sendMessage(array $variables) {
    print_r($variables);

    $this->message->setFrom($variables['from']);
    $this->message->subject = $variables['subject'];

    // @todo foreach
    foreach($variables['to'] as $to){
      $this->message->addTo($to);
    }
    //$this->message->addBcc(); // @todo
    $this->message->html = $variables['html'];
    $this->message->text = $variables['text'];
    $this->mailer->send($this->message);
  }
}