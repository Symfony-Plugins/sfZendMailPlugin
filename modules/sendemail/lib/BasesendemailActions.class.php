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
    $from = $request->getParameterHolder()->get('from');
    $toStr = $request->getParameterHolder()->get('to');
    $subject = $request->getParameterHolder()->get('subject');
    $body = $request->getParameterHolder()->get('msg');
    
    $this->forward404Unless($from && $toStr && $subject && $body);
    
    $from = trim(str_replace(array(',', ';'), '', $from));
    
    echo $from;
    
    $mail = new sfZendMail();
    $mail->setFrom($from);

    $tos = explode(';', $toStr);
    foreach($tos as $to)
    {
      $to = trim($to);
      if($to != '')
      {
        $mail->addTo($to);
      }
    }


    if($request->getParameterHolder()->get('cc',false))
    {
      $ccs = explode(';', $request->getParameterHolder()->get('cc'));
      foreach($ccs as $cc)
      {
        $cc = trim($cc);
        if($cc != '')
        {
          $mail->addCc($cc);
        }
      }
    }

    if($request->getParameterHolder()->get('bcc',false))
    {
      $bccs = explode(';', $request->getParameterHolder()->get('bcc'));
      foreach($bccs as $bcc)
      {
        $bcc = trim($bcc);
        if($bcc != '')
        {
          $mail->addBcc($bcc);
        }
      }
    }

    $mail->setSubject($subject);
    
    if($request->getParameter('content') == 'html')
    {
      $mail->setBodyHtml($body);
    }
    else
    {
      $mail->setBodyText($body);
    }
    $this->mail = $mail;
  }
}
