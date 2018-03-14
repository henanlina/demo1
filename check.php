<?php

class Check{
    protected $redis = '';
    protected $sql_con = '';
    function __construct($token)
    {
        //连接redis
        $this->redis = new Redis();
        $redis_ip = '127.0.0.1';//redis地址 todo
        $password = '';//redis密码 todo
        $conn = $this->redis->connect($redis_ip,6379);
        $this->redis->auth($password);
        if(!$conn){
            die(json_encode(['status'=>201,'msg'=>'redis连接失败']));
        }
        $phone = $this->get_phone($token);
        if(empty($phone)){
            die(json_encode(['status'=>201,'msg'=>'无效token，查询不到手机号']));
        }
        //连接数据库
        $host = '127.0.0.1';//数据库host todo
        $username='root';//用户名 todo
        $password='';//密码 todo
        $this->sql_con = mysqli_connect($host,$username,$password);
        if(!$this->sql_con){
            die(json_encode(['status'=>201,'msg'=>'数据库连接失败']));
        }
        $phone = '15838350795';
        $check_phone = $this->verify_phone($phone);
        //关闭数据库
        mysqli_close($this->sql_con);

        if($check_phone){
            //手机号存在
            $url = 'http://demo1.tp32.com/test2.php';//todo
            $post_data = [
                    'test'=>'test1'
                ];//todo
        }else{
            //手机号不存在
            $url = 'http://demo1.tp32.com/test2.php';//todo
            $post_data = [
                'test'=>'test2'
            ];//todo
        }
        $res = $this->curl_post($url,$post_data);
        die($res);
    }
    //根据token从redis中取出phone
    public function get_phone($token){
        if(empty($token)){
            die(json_encode(['status'=>201,'msg'=>'token为空']));
        }
        $phone = $this->redis->get($token);
        return $phone;
    }
    //从数据库中查询phone是否存在
    public function verify_phone($phone){
        $db_name = 'test';//数据库名字
        mysqli_select_db($this->sql_con,$db_name);
        $sql='select * from test WHERE  phone ='.$phone;//todo
        $res = $this->sql_con->query($sql);
        $row = mysqli_fetch_row($res);
        if(empty($row)){
            return false;
        }
        return true;
    }
    //发送post请求
    public function curl_post($url,$post_data,$timeout=5){
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_POST, 1);
        if($post_data != ''){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $file_contents = curl_exec($ch);
        curl_close($ch);
        return $file_contents;
    }
}

$token = $_GET['token'];//传入token参数
if(empty($token)){
    die(json_encode(['status'=>201,'msg'=>'token为空']));
}
$aa = new Check($token);
echo json_encode($aa);
