<?php
if($event == "login")
{
    if(acc($name, $pass))
    {
        return true;
    }
}
if($event == "register"){
    if(acc($name, $pass, 0))
    {
        echo "ACCOUNT ALREADY CREATED";
        exit();
    }
    else
    {
        $username = 'user'.$time.rand(100,999);
        $r = mysqli_query($db, "INSERT INTO accounts (name,username,password,admin,time,log_time,notice_time,ip) VALUES ('$name','$username','$pass',false,'$time','$time',0,'$ip')");
        echo "OK";
    }
}
    
function acc($name, $pass='-', $e=1)
{
    global $db;
    if($e == 1){
        $r = mysqli_query($db, "SELECT * FROM accounts WHERE name = '$name' AND password = '$pass'");
    } else {
        $r = mysqli_query($db, "SELECT * FROM accounts WHERE name = '$name'");
    }
    if($s = mysqli_fetch_array($r))
    {
        if($e == 1){
            $r  = mysqli_query($db, "UPDATE accounts SET ip = '$ip', log_time = '$time' WHERE name = '$name'");
        }
        return true;
    }
    else
    {
        if($e == 1){
            echo "INCORRECT ACCOUNT";
            exit();
        }
        else
        {
            return false;
        }
    }
}
function permission($id, $per=-1)
{
    global $db;
    $r = mysqli_query($db, "SELECT * FROM accounts WHERE id = '$id'");
    if($s = mysqli_fetch_array($r))
    {
        $nowper = false;
        if($s['admin'] == true)
        {
            $nowper = 1;
        }
        if($per == -1)
        {
            return $nowper;
        }
        else
        {
            if($nowper == $per)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
    else
    {
        return false;
    }
}
?>
