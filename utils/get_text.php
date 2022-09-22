<?
    require_once ('./randomizer.php');
    function get_text($filename,$title,$price=""){
        $fn = '..'.$filename;
        $text = randomize($fn);
        $text = str_replace("_title_",$title,$text);
        $text = str_replace("_price_",$price,$text);
        return $text;
    }
?>