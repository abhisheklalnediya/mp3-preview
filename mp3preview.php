<?php
    $filename=$data['plink'];
    //echo basename($filename);
    $handle = fopen($filename, "rb");
    $tmpfile=uniqid().basename($filename);
    $handle1=  fopen('1min/'.$tmpfile, "w");
    

?>
<style type="text/css"> 
.mp3file
{
	position:relative;
	float:left;
	width:auto;
	padding:5px;
}
.mp3player
{
	position:relative;
	margin:0px;
	width:200px;
	float:left;
	padding:5px;

}
</style>


<div class="mp3file">
	Music Sample
</div>
<div class="mp3player">
<object type="application/x-shockwave-flash" data="dewplayer.swf" width="200" height="20" id="dewplayer" name="dewplayer"> 
	<param name="wmode" value="transparent" />
	<param name="movie" value="dewplayer.swf" />
        <param name="flashvars" value="mp3=<?php  echo '1min/'.urlencode($tmpfile).'s';?>" />
</object>
</div>
<?php
flush();
$c=0;
    while (!feof($handle)) {
        flush();
        $temp=fread($handle, 1024);
        fwrite($handle1, $temp);
        $c++;
        if($c>1000)
        {
        	break;
        }	
}
fflush($handle1);
fclose($handle1);
fclose($handle);
include_once 'class.mp3.php';
$mp3 = new mp3;
$mp3->cut_mp3('1min/'.$tmpfile, '1min/'.$tmpfile.'s', 0, 60, 'second', false);
unlink('1min/'.$tmpfile);
?>
