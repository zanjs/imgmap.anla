<?php


//在生成html代码中要先有一个模板，之后再通过模板替换其中的内容，
header("content-type:text/html; charset=utf-8");
//"content-type: text/html; charset=utf-8"


   $getTitle = $_POST["t"];
   $getImg = $_POST["i"];
   $getId = $_POST["id"];


    $tmf = './tmp/t2.html';
    
    $title = $getTitle;
    $content = $getImg;
    $id = $getId;
    $path = "edm.html";

    $urlName = str_replace(' ', '_', $getTitle);
    

    $fp = fopen($tmf,"r");//只读打开模板
    $str = fread($fp,filesize($tmf));//读取模板内容

    $str = str_replace("{title}",$title,$str);//使用尖括号是在里面加内容，替换不了。
    $str = str_replace("{content}",$content,$str);//替换内容.这是替换的html里面的内容，写在body中有{content}，把content替换为新闻内容
    $str = str_replace("{id}",$id,$str);
    $str = str_replace("{urlName}",$urlName,$str);
    
    fclose($fp);

    $handle = fopen($path,'w');//写入方式打开新闻路径	
    fwrite($handle,$str);//把刚替换的内容写进生成的html文件
    fclose($handle);

    if($handle){
        echo '生成成功';
    }else{
        echo "生成失败";
    }
?>