<?php
//每次循环处理10条

$db_name = '';
$old_host = '';
$old_username = '';
$old_password = '';

//获取老的文件数据
$sql_con = mysql_connect($old_host,$old_username,$old_password);
if(!$sql_con){
    die('数据库连接失败'.mysql_error());
}
mysql_select_db($db_name,$sql_con);
$max = 4118990;
$begin = 2194510;
$end = $begin+10;
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
while ($row = mysql_fetch_array($result)){
   $filename = $row['filename'];
   $path = $row['Path'];
    //调用接口获取新的文件地址
    $url = 'http://10.10.16.151:22122/car.kkcredit.cn/dfs/upload';
    $post_data = [

    ];
}

//将新文件地址存入数据库