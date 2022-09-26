<?
    require_once 'get_filenames.php';
    function get_img_list($folder){
        $hostname='http://'.$_SERVER['HTTP_HOST'];
        $image_pathes = array();

        $settings = json_decode(file_get_contents('../storage.json'), true);
        $target = explode("/",$folder)[3];
        $folder_number = array_key_exists($target,$settings["imgs"]) ? $settings["imgs"][$target] : 1;
        if (!file_exists("..".$folder.'/'.$folder_number) ){
            $folder_number = 1;
        }
        $image_names = get_filenames(".".$folder.'/'.$folder_number);
        foreach ($image_names as $img){
           $image_path = $hostname.$folder.'/'.$folder_number.'/'.$img;
           array_push($image_pathes, $image_path);
        }
        $settings["imgs"][$target] =  $folder_number + 1;
        file_put_contents('../storage.json', json_encode($settings));
        $strinify_pathes = implode(" | ", $image_pathes);
        return $strinify_pathes;
    }
?>