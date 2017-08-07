<?php
namespace Home\Controller;
use Think\Controller;
use Common\ORG\Util\MySendMail;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }

    public function test(){
        $mail = new MySendMail();
        $mail->setServer("127.0.0.1", "admin", "gaoxioalv");
        $mail->setFrom("15838350795@163.com");
        $mail->setReceiver("1427033272@qq.com");
//$mail->setReceiver("XXXXX@XXXXX");
//        $mail->setCc("XXXXX@XXXXX");
//        $mail->setCc("XXXXX@XXXXX");
//        $mail->setBcc("XXXXX@XXXXX");
//        $mail->setBcc("XXXXX@XXXXX");
//        $mail->setBcc("XXXXX@XXXXX");
        $mail->setMailInfo("test", "<b>test</b>", "sms.zip");
        $mail->sendMail();
    }
}