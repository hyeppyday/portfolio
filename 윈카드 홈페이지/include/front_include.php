<?php
    $_httpHost = $_SERVER[ "HTTP_HOST" ];
    $_theRequestUrl = $_SERVER[ "REQUEST_URI" ];
    $_QueryString = $_SERVER[ "QUERY_STRING" ];
    $_phpSelf = $_SERVER[ "PHP_SELF" ];
    $_serverPhpSelf = basename( $_SERVER[ "PHP_SELF" ] );
    $_fileName = substr($_serverPhpSelf, 0, -4);
    $_prevPage = $_SERVER['HTTP_REFERER'];
    $_prevUrl = (explode('?', $_prevPage, 2))[0];

    $_date = date('Y-m-d H:i:s');
    $_localTime = localtime();  //[0]'초' [1]'분' [2]'시' [3]'일' [4]'월-1' [5]'년-1900' [6]'요일' [7]'년기준일-1' [8]'tm_isdst' 
    $_localTime2 = localtime(time(), true); //[0]'tm_sec' [1]'tm_min' [2]'tm_hour' [3]'tm_mday' [4]'tm_mon' [5]'tm_year' [6]'tm_wday' [7]'tm_yday' [8]'tm_isdst' 
    $_mkTime = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y')); //타임스탬프
?>

<script>
    console.log("$_httpHost : <?=$_httpHost?>");
    console.log("$_theRequestUrl : <?=$_theRequestUrl?>");
    console.log("$_QueryString : <?=$_QueryString?>");
    console.log("$_phpSelf : <?=$_phpSelf?>");
    console.log("$_serverPhpSelf : <?=$_serverPhpSelf?>");
    console.log("$_fileName : <?=$_fileName?>");
    console.log("$_prevPage : <?=$_prevPage?>");
    console.log("$_prevUrl : <?=$_prevUrl?>");

    console.log("$_date : <?=$_date?>");
    console.log("$_localTime : <?=$_localTime?>");
    console.log("$_localTime2 : <?=$_localTime2?>");
    console.log("$_mkTime(타임스탬프) : <?=$_mkTime?>");
</script>

<?php 

?>