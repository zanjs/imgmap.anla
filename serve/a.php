<?php


echo $_GET["t"];		//输出 2
echo $_GET["id"];		//输出 10


$getTitle = $_GET["t"];


function replaceTemplateString($templateString) {
    // 用来替换的变量
    $title = $getTitle;
    $body = "这里主体";
    // 替换模板中指定字符串
    $showString = str_replace ( "%title%", $title, $templateString );
    $showString = str_replace ( "%body%", $body, $showString );
    // 返回替换后的结果
    return $showString;
}


$template_file = "template.html";
$new_file      = "edm.html";






// 模版文件指针
$template_juBing = fopen ( $template_file, "r" );
// 要生成的文件指针
$newFile_juBing = fopen ( $new_file, "w" );
// 方式一获取整体模板内容字符串，替换后赋给新文件
$templateString = fread ( $template_juBing, filesize ( $template_file ) );
$showString = replaceTemplateString ( $templateString ); // 替换模板中字符串
fwrite ( $newFile_juBing, $showString ); // 将替换后的内容写入生成的HTML文件
/*
// 方式二循环读取模版每行内容字符串，替换后依次添加到新文件
while ( ! feof ( $template_juBing ) ) { // feof() 函数检测是否已到达文件末尾。如果文件指针到了末尾或者出错时则返回 TRUE。否则返回FALSE（包括 socket 超时和其它情况）。
    $templateString = fgets ( $template_juBing ); // fgets(file,length) 从文件指针中读取一行并返回长度最多为 length - 1 字节长度的字符串，包括换行符。如果没有指定 length，则默认为 1K，或者说 1024 字节。
    $showString = replaceTemplateString ( $templateString );
    fwrite ( $newFile_juBing, $showString ); // 第一次往打开的指针文件中写入内容时会替换指针文件中原有内容，在该文件指针关闭前，fwrite函数再添加内容会在已添加内容之后
}
*/
// 关闭文件指针
fclose ( $newFile_juBing );
fclose ( $template_juBing );


?>