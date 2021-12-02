<?php
  function cmp_dayi_test1($x,$y){
    $c_now_time=time();
    $leftx=$x['end_time']-$c_now_time;
    $lefty=$y['end_time']-$c_now_time;
    if($leftx<=0&&$lefty>=0)return 1;
    if($lefty<=0&&$leftx>=0)return 0;
    if($lefty<=0&&$leftx<=0)return (int)($x['end_time']<$y['end_time']);
    $ans=$x['end_time']>$y['end_time'];
    return (int)$ans; 
  }
?>