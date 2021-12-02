<?php
  function dayi_print_test1($cnt,$c_id,$c_event,$c_start,$c_end){
    $c_now_time=time();
    $left=$c_end-$c_now_time;
    $left_d=(int)($left/(24*60*60));
    $left_h=(int)(($left)%(24*3600)/3600);//(int)($left/(24*60)-$left_d*24);
    $left_m=(int)(($left)%(3600)/60);
    $left_s=$left%60;
    if((int)$left>=-(24*60*60)){
        if(abs((int)$left)>=(25*60*60))echo $cnt.".".$c_event." 剩余:".round($left/(24*60*60),3)."d";
        else {
          if((int)$left<=0)echo $cnt."."."【似乎已经截止了】".$c_event." 剩余:".round($left/(24*60*60),3)."d";
          else {//一天之内
            echo $cnt.".".$c_event." 剩余:".$left_d."d".$left_h."h".$left_m."m".$left_s."s";
          }
        }
      }
    }
?>