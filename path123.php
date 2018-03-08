<?php
//每次循环处理10条

//老数据库账号密码
$db_name = '';
$old_host = '';
$old_username = '';
$old_password = '';

//新数据库账号密码
$new_db_name = '';//数据库名
$new_host = '';//host
$new_username = '';//用户名
$new_password = '';//密码

$max = 4118990;
$end = $begin = 2194510;
//连接新老数据库
$sql_con = get_sql_fetch($old_host,$old_username,$old_password,$db_name);
$new_con = get_sql_fetch($new_host,$new_username,$new_password,$new_db_name);
while ($end<=$max){
    $end +=10;
    $query = "SELECT CASE WHEN B.Kind = 'DOCUMENTKIND/SHENFENZHENGFANMIAN' THEN CONCAT(S.ClientIndenNo,'_back.jpg')
			WHEN B.Kind = 'DOCUMENTKIND/SHENFENZHENGZHENGMIAN' THEN CONCAT(S.ClientIndenNo,'_front.jpg')
			WHEN B.Kind = 'DOCUMENTKIND/SHOUCHISHENFENZHENG' THEN CONCAT(S.ClientIndenNo,'_person.jpg')
			END AS filename,MAX(U.Path) AS Path
FROM [kkdfile].[dbo].[Sign] S WITH(NOLOCK)
INNER JOIN [kkdfile].[dbo].[BussDocument] B WITH(NOLOCK)
ON S.Bid = B.Bid
INNER JOIN [kkdfile].[dbo].[UserFile] U WITH(NOLOCK)
ON B.FileId = U.Id
WHERE S.Id BETWEEN ".$begin." AND ".$end." GROUP BY S.ClientIndenNo,B.Kind
ORDER BY S.ClientIndenNo,B.Kind";

    $result = mysql_query($query);
    $sql = '';
    while ($row = mysql_fetch_array($result)){

        $filename = $row['filename'];
        $path = $row['Path'];
        if(empty($filename)||empty($path)){
            break;
        }
        $new_name = get_new_name($filename,$path);
        if(empty($new_name)){
            break;
        }
        $sql.= "INSERT INTO table_name (filename,fid,created) VALUES ('".$filename."','".$path."',NOW());";
    }
    //将新文件地址存入数据库
    $result = mysql_query($sql);
}
//关闭新老数据库连接
mysql_close($sql_con);
mysql_close($new_con);

function get_sql_fetch($host,$username,$password,$db_name){
    $sql_con = mysql_connect($host,$username,$password);
    if(!$sql_con){
        die('数据库连接失败'.mysql_error());
    }
    mysql_select_db($db_name,$sql_con);
    return $sql_con;
}

function get_new_name($filename,$path){
    //调用接口获取新的文件地址
    $url = 'http://10.10.16.151:22122/car.kkcredit.cn/dfs/upload';
    $post_data = [
        'filename'=>$filename,
        'path'=>$path
    ];
    return curl_post($url,$post_data);
}

function curl_post($url,$data){
    $ch = curl_init ( $url );
    curl_setopt ( $ch, CURLOPT_POST, 1 );
    curl_setopt ( $ch, CURLOPT_HEADER, 0 );
    curl_setopt ( $ch, CURLOPT_FRESH_CONNECT, 1 );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt ( $ch, CURLOPT_FORBID_REUSE, 1 );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
    $ret = curl_exec ( $ch );
    echo  "Request Info : url: " . $url . " ,send data: " . $data . "  \n";
    echo  "Response Info : " . $ret . "  \n";
    curl_close ( $ch );
    return $ret;
}