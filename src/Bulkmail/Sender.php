<?php
namespace Colorfield\Bulkmail;

interface Sender
{
  /**
   * Sends a message.
   * @param $variables
   * @return \stdClass
   */
  public function sendMessage(array $variables);
}