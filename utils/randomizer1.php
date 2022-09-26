<pre>
<?
    function randomize($filename){
        $local_text =  file_get_contents($filename);
        $substr_regex = '/\{.*?\}/';
        preg_match_all($substr_regex,$local_text,$all_substr);
        $counter = 0;
        foreach($all_substr[0] as $substr){
            $placeholder = str_replace('/','\/',$substr);
            $placeholder = str_replace('{', '/\\{',$placeholder);
            $placeholder = str_replace('}', '\\}/', $placeholder);
            $placeholder = str_replace('|', '\\|', $placeholder);
            $local_text = preg_replace($placeholder,'{count'.$counter.'}',$local_text);
            $counter+=1;
        }
        $result = array($local_text);
        $counter = 0;
        foreach($all_substr[0] as $substr){
            $temporary_result = array();
            $elements = explode('|',str_replace('{', '', str_replace('}','', $substr)));

            foreach($elements as $element){
                $key = 'count'.$counter;
                foreach ($result as $temp_res){
                    $pattern_element = '/\{'.$key.'\}/';
                    $res_of_sub = preg_replace($pattern_element,$element,$temp_res);
                    array_push($temporary_result,$res_of_sub);
                }
            }
                $result = $temporary_result;
                $counter += 1;
        }
        $rand_key = array_rand($result);
        return($result[$rand_key]);
    }

?>
</pre>