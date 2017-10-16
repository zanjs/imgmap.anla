<?
//    文件下载
   
   $edm = "./edm.html";
   
    $file = fopen($edm,"r"); // 打开文件
    // 输入文件标签
    Header("Content-type: application/octet-stream");
    Header("Accept-Ranges: bytes");
    Header("Accept-Length: ".filesize($edm));
    Header("Content-Disposition: attachment; filename=edm.html");
    // 输出文件内容
    echo fread($file,filesize($edm));
    fclose($file);
    exit();
    
?>