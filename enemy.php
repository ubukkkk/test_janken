<?php

    trait Enemy{
        //敵のじゃんけんの手
        public function enemy(){
            //敵のじゃんけん配列に引き渡す乱数処理
            $rand = mt_rand(0, 2);
            $enm_arr = ["グー","チョキ","パー"];
            $enm = $enm_arr[$rand];
            return $enm;
        }

    }
?>