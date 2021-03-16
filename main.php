<?PHP
    require_once('User.php');

    //Userインスタンスの生成
    $user = new User("aaa");

    $user->user_name();
    echo "<br />";
    $user->battle();
?>