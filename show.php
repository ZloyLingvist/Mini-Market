<?php
$link = mysqli_connect("localhost", "root", "");
mysqli_set_charset($link,"utf8");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

mysqli_select_db($link,"mini-market");
$query="SHOW TABLES";
$result=mysqli_query($link,$query) or die("Error ".mysqli_error($link));
$table=mysqli_fetch_array($result);


//$k=0;
//while(){
	//echo ('<div id="'.$k.'" onclick="newtable('.$k.')">'.$table[0].'</div><br>');
	//$k=$k+1;
}


//$data = mysqli_query($link,"SELECT * FROM personal");

/*$output = "<br><table border='1'>";
    foreach($data as $key => $var) {
        if($key===0) {
            $output .= '<tr align="center">';
            foreach($var as $col => $val) {
                $output .= "<td style='width: 70px;'><strong>" . $col . '</strong></td>';
            }
            $output .= '</tr>';
            foreach($var as $col => $val) {
                $output .= '<td style="width: 100px;">' . $val . '</td>';
            }
            $output .= '</tr>';
        }
        else {
            $output .= '<tr>';
            foreach($var as $col => $val) {
                $output .= '<td style="width: 100px;">' . $val . '</td>';
            }
            $output .= '</tr>';
        }
    }
    $output .= '</table>';
    echo $output;*/

mysqli_close($link);

?>
