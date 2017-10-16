<?php
//-------------------
//　TCreateHTML
//根据模板文件生成一个静态html文件的类
//-------------------
//*****定义所需工作函数
//约定以标记 <!--##name##-->为开始
//以标记<!--@@name@@-->为结束
function isbegin($str){
    $pattern="<!--##[a-zA-Z]+##-->";
    if(ereg($pattern,$str)) return true;
    return false;
}
function isfinish($str){
    $pattern="<!--@@[a-zA-Z]+@@-->";
    if(ereg($pattern,$str)) return true;
    return false;
}
function getname($str){
    $tmp=explode("##",$str);
    return $tmp[1];
}
//******************
//*******定义类
class TCreateHTML {
    var $HTemplate;
    var $FileName;
    var $ModiString;
    //********接口函数
    //构造模板
    function TCreateHTML($tmplate){
    $this->HTemplate=$tmplate;
}
//设置输出文件名
function SetHTML($filename){
    $this->FileName=$filename;
}
//设置标记的名字与相应取代的字串
function EditableBlock($name,$replace){
    $this->ModiString[$name]=$replace;
}
//写HTML文件
function WriteHtml(){
    $fc=file($this->HTemplate);
    $fp=fopen($this->FileName,"w");
    $k=count($fc);
    $begin=false;
    $first=false;
    $tag="";
    for($i=0;$i<$k;$i++){
        if(isbegin($fc[$i])){
            fputs($fp,$fc[$i]);
            $begin=true;
            $first=true;
            $tag=getname($fc[$i]);
            continue;
        }
        if(isfinish($fc[$i])){
            fputs($fp,$fc[$i]);
            $begin=false;
            $first=false;
            $tag="";
            continue;
        }
        if($begin==true){
            if($first==true) {
                $fc[$i]=$this->ModiString[$tag]." ";
                $first=false;
            }
            else $fc[$i]="";
        }
        
        fputs($fp,$fc[$i]);
    }
    fclose($fp);
}
//--------class end
}
?>