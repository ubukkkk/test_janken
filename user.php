<?php
require_once('Status.php');
require_once('Enemy.php');

//
class User extends Status{
    //Enemyトレイトの宣言
    use Enemy;

    //乱数の変数の最大値４
    const MAX = 4;
    //乱数の変数の最小値０
    const MIN = 0;
    //じゃんけんの各配列
    public $arr_gu;
    public $arr_chiki;
    public $arr_pa;
    public $user;

    //ユーザーの名前
    public $name;

    //変数の初期化
    public function __construct($name){

        //ユーザーの名前
        $this->name = $name;

        //じゃんけんの配列グータイプ
        $this->arr_gu = ["グー","チョキ","グー","パー","グー"];
        //じゃんけんの配列チョキタイプ
        $this->arr_choki = ["チョキ","グー","チョキ","パー","チョキ"];
        //じゃんけんの配列パータイプ
        $this->arr_pa = ["パー","グー","パー","チョキ","パー"];

    }

    //ユーザー名の表示
    public function user_name(){

        echo "ユーザー名: ".$this->name;

    }

    //じゃんけんのタイプを求める処理
    public function type_select(){

        //$lengにint型パラメータを引き渡す処理。ユーザー名以外のパラメータはStatusクラスより継承
        $leng = strlen($this->name) + parent::from_date();

        if($leng % 3 === 0){
            $arr = $this->arr_gu;
        }elseif($leng %3 === 1){
            $arr = $this->arr_choki;
        }else{
            $arr = $this->arr_pa;
        }
        return $arr;

    }

    //Userのじゃんけんを行う処理
    public function rand_a(){

        //じゃんけん配列に引き渡す乱数　変数MAX～MIN参照
        $this->rnd = mt_rand(self::MIN, self::MAX);
        //じゃんけんの表示
        //echo $this->rnd.":". $this->type_select()[$this->rnd];

        //ここでrand_aメソッドの処理結果を返す。
        return $this->type_select()[$this->rnd];

        //じゃんけんタイプの表示
        if($this->type_select() == $this->arr_gu){
            echo "Type:グー";
            echo "<br />";
        }elseif($this->type_select() == $this->arr_choki){
            echo "Type:チョキ";
            echo "<br />";
        }else{
            echo "Type:パー";
            echo "<br />";
        }
        //じゃんけんタイプの中身
        for($i = 0;$i < self::MAX + 1; $i++){
            echo "*".$this->type_select()[$i]." ";
        }


    }

    //UserとEnemyのじゃんけんの処理
    public function battle(){

        //パラメータの初期化
        $count = 7;
        $win = 0;


        echo "<br />";

        //じゃんけんの繰り返し処理
        for($i = 1; $i <= $count; $i++){       
             //じゃんけん勝負の条件分岐処理
            if($this->rand_a() === $this->enemy()){
                //ここでメソッドを変数に格納して、戻り値を確定させる
                //※戻り値には乱数要素があるため

                //引き分けの場合の処理
                $user = $this->rand_a();
                $enemy = $this->enemy();
                echo $this->name."は ".$user;
                echo "<br />";
                echo "敵は ".$enemy;
                echo "<br />";
                echo "どちらも ".$user." なので引き分け";
                echo "<br /><br />";

            }elseif(($this->rand_a() === "グー" && $this->enemy() ==="チョキ") || ($this->rand_a() === "チョキ" && $this->enemy() ==="パー") || ($this->rand_a() === "パー" && $this->enemy() ==="グー")){
                //ここでメソッドを変数に格納して、戻り値を確定させる
                //※戻り値には乱数要素があるため

                //ユーザーが勝利した場合の処理
                $user = $this->rand_a();
                $enemy = $this->enemy();
                echo $this->name."は ".$user;
                echo "<br />";
                echo "敵は ".$enemy;
                echo "<br />";
                echo $this->name." の勝ち";
                echo "<br /><br />";
                //勝利数をカウント
                $win++;
            }else{
                //ここでメソッドを変数に格納して、戻り値を確定させる
                //※戻り値には乱数要素があるため

                //敵が勝利した場合の処理
                $user = $this->rand_a();
                $enemy = $this->enemy();
                echo $this->name."は ".$user;
                echo "<br />";
                echo "敵は ".$enemy;
                echo "<br />";
                echo "敵 の勝ち";
                echo "<br /><br />";

            }
        }
        //ユーザーの勝率の表示
        $win_rate = $this->name."の勝率は ".(int)(($win * 100) / $count)."% "."\n";

        echo $win_rate;

        //ファイル名の設定
        $fileName = './result.txt';

        //書き込む文字列
        $string = date("Y/m/d H:i:s ").$win_rate;

        //データの書込み
        file_put_contents($fileName, $string, LOCK_EX | FILE_APPEND);

        echo "<br />勝率をテキストファイルに保存しました。<br>";


    }
}

?>