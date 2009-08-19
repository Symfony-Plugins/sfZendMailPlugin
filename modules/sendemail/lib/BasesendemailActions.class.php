<?php

/**
 * Base actions for the sfZendMailPlugin sendemail module.
 *
 * @package     sfZendMailPlugin
 * @subpackage  sendemail
 * @author      Benjamin Runnels <benjamin.r.runnels@citi.com>
 * @version     SVN: $Id: BaseActions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
class BasesendemailActions extends sfActions
{
  public function executeSendEmail()
  {
    $this->forward404Unless($this->getRequest()->isXmlHttpRequest());
    $this->sendEmail($this->getModuleName(), 'email');
    return $this->renderText(json_encode(array('success'=>true)));
  }

  public function executeEmail(sfWebRequest $request)
  {
    $mail = new sfZendMail();
    $mail->setFrom($request->getParameterHolder()->get('from'));

    $tos = explode(';',$request->getParameterHolder()->get('to'));
    foreach($tos as $to)
    {
      $mail->addTo($to);
    }


    if($request->getParameterHolder()->get('cc',false))
    {
      $ccs = explode(';',$request->getParameterHolder()->get('cc'));
      foreach($ccs as $cc)
      {
        $mail->addCc($cc);
      }
    }

    if($request->getParameterHolder()->get('bcc',false))
    {
      $bccs = explode(';',$request->getParameterHolder()->get('bcc'));
      foreach($bccs as $bcc)
      {
        $mail->addBcc($bcc);
      }
    }

    $mail->setSubject($request->getParameterHolder()->get('subject'));
    $mail->setBodyText($request->getParameterHolder()->get('msg'));
    $this->mail = $mail;
  }
}
