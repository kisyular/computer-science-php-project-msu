<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/20
 * Time: 6:55 PM
 */

namespace Enigma;


class SendController extends CommunicateController
{
    public function __construct(Site $site, System $system, array $post, array &$session){
        parent::__construct($site,$system,$post, "send.php");
        $root = $site->getRoot();
        if(isset($post['search'])){
            $users = new Users($site);
            $results = $users->search($post['searchVal']);
            $session['results'] = $results;
            $this->redirect = "$root/searchresults.php";
            return;
        }
        if(isset($post['remove'])){
            $users = new Users($site);
            $user = $users->getById($post['remove']);
            if (($key = array_search($user, $session['choice'])) !== false) {
                unset($session['choice'][$key]);
            }
            $this->redirect = "$root/send.php";
            return;
        }
        if(isset($post['send'])){
            if(isset($post['code']) && !empty($system->getEncodedBatch()) && strlen($post['code']) < 4){
                $messageRow = array(
                    'id' => null,
                    'message' => $system->getEncodedBatch(),
                    'code' => strtoupper(trim(strip_tags($post['code']))),
                    'senderid' => $post['userid'],
                    'date' => null
                );

                $message = new Message($messageRow);
                $messages = new Messages($site);
                $messageid = $messages->addMessage($message);
                if(!$messageid){
                    $this->redirect = "$root/send.php?e=".self::SENDING_FAILED;
                }
                $recipients = new Recipients($site);
                if(count($session['choice'])===0){
                    $this->redirect = "$root/send.php?e=".self::NO_RECIPIENTS;
                    return;
                }
                foreach($session['choice'] as $choice){
                    $recipientid = $choice->getId();
                    $recipients->addRecipient(new Recipient(array('recipientid'=>$recipientid, 'messageid'=>$messageid)));
                }
                unset($session['choice']);
                $this->redirect = "$root/send.php";
            } else {
                $this->redirect = "$root/send.php?e=".self::EMPTY_MESSAGE;
            }

        }
    }
    const SENDING_FAILED = 5;
    const NO_RECIPIENTS = 9;
    const EMPTY_MESSAGE = 10;
}