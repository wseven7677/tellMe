<?php 
	//数据库信息：
	define('DB_HOST', '***');
	define('DB_USER', '***');
	define('DB_PW', '***');
	define('DB_NAME', '***');
	
    $num_flag = 50;   //显示最新几条信息？不足此数目时就显示所有信息。

    $dbc2 = mysqli_connect(DB_HOST,DB_USER,DB_PW,DB_NAME) or die('error connecting to mysql server');
    //收集数量：
    $query_rm = "
    	SELECT count(*) FROM knowYourTimeBox
    ";
    $func_rm = mysqli_query($dbc2,$query_rm) or die('error querying database');
    $rm_num_temp = mysqli_fetch_array($func_rm);//use rm_num_temp[0]
    $rm_num = $rm_num_temp[0] - 1;
    //收集时间：
    $query_rm = "
      SELECT time FROM knowYourTimeBox
    ";
    $func_rm = mysqli_query($dbc2,$query_rm) or die('error querying database');
    $rm_time = mysqli_fetch_all($func_rm);
    //收集msg：
    $query_rm = "
      SELECT text FROM knowYourTimeBox
    ";
    $func_rm = mysqli_query($dbc2,$query_rm) or die('error querying database');
    $rm_text = mysqli_fetch_all($func_rm);
    //关闭数据库：
    mysqli_close($dbc2);
    foreach (array_reverse($rm_time) as $key => $value){    ?>
        <div class="spDisplay">
    		<span>    <?php  echo implode($value);             ?>    </span>
     		<span> “   <?php  echo implode($rm_text[$rm_num]);  ?>  ”  </span>
        </div>
      <?php 
      $rm_num--;
      $num_flag--;
      if($num_flag == 0 or $rm_num == -1){break;}
    }
?>
