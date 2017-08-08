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
        /**
         * 使用163邮箱需要开启用户授权码，不开启授权发送不成功
         */
        $mail->setServer("smtp.163.com", "15838350795@163.com", "LiGx3375Nav");
        //发送人
        $mail->setFrom("15838350795@163.com");
        //接收人
        $mail->setReceiver("1427033272@qq.com");
        //接收人可以是多个
        //$mail->setReceiver("XXXXX@XXXXX");
        //抄送人
        //$mail->setCc("XXXXX@XXXXX");
        //$mail->setCc("XXXXX@XXXXX");
        //秘密抄送人
        //$mail->setBcc("XXXXX@XXXXX");
        //$mail->setBcc("XXXXX@XXXXX");
        //$mail->setBcc("XXXXX@XXXXX");
        $mail->setMailInfo("test", "<b>test</b>", "sms.zip");
        $mail->sendMail();
    }
}