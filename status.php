<?php
    //Userクラスの親クラス
    //じゃんけんタイプを決める為のパラメータをステータスとして求めるクラス。
    class Status{

        //Dataクラスからじゃんけんタイプを決めるパラメータの取得処理
        public function from_date(){
            //月と年、秒の値をdateクラスから取得してint型に直す
            $date = (int)date('nys');
            return $date;
        }
    }
?>