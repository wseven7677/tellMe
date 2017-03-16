<?php
	//数据库信息：
	define('DB_HOST', '***');
	define('DB_USER', '***');
	define('DB_PW', '***');
	define('DB_NAME', '***');
	
	$time = date('Y-m-d H:i:s',time());
	$text = addslashes(htmlspecialchars(strip_tags(trim($_POST['txt']))));
    $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PW,DB_NAME) or die('error connecting to mysql server');
    //查找最大id号：
    $query0 = "
      SELECT MAX(id) FROM knowYourTimeBox
    ";
    $func_id = mysqli_query($dbc,$query0) or die('error querying database[id problem]');
    $numID = mysqli_fetch_array($func_id);//使用时use numID[0]
    $num = $numID[0] + 1;
    //导入信息：
    $query = "
        INSERT INTO knowYourTimeBox (id,time,text) VALUES ('$num','$time','$text')
    ";
    $success = mysqli_query($dbc,$query) or die('error querying database'. mysqli_error($dbc));
    mysqli_close($dbc);
?>
