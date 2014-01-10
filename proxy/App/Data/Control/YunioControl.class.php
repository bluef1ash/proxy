<?php
/**
 * yunio网盘控制器
 */
class YunioControl extends Control{
        /**
         * 获取yunio网盘真实地址
         * @return [type] [description]
         */
        public function yunio(){
            if(!$id = $this->_get("id"))
                $this->error("请输入ID！");
            $page = file_data("https://s.yunio.com/".$id);
            echo $page;
            preg_match("/publiclink_root\s*=\s*([0-9A-Za-z]+).*url\s*=\s*(?:.*);\n*\t*\s*path\s*=\s*'(.*)';.*var path1\s*=\s*'(.*);/iUs", $page, $arr);
            $url = str_replace("'+url+\"", $id, $arr[3]);
            $url = str_replace('"name"', "", $url);
            $url = str_replace('"+path+"', $arr[2], $url);
            $url = str_replace('"+name', urlencode($arr[1]), $url);
            echo $url;die;
            go($url);
        }
        /**
         * 生成列表
         * @param  string $id 视频ID
         * @return array     视频列表及视频名称
         */
        public function listpage($id){
            preg_match("/lk\/([0-9A-Za-z]{13})/iUs", $id, $ids);
            $page = file_data($id);
            preg_match("/name : '(.*)\.flv|\.mp4?',/iUs", $page, $arr);
            $vName = $arr[1];
            $xml = '<m type="" src="'.U("data/sanliuling/yunpan", array("id"=>$ids[1])).'" label="'.$vName."\" />\n";
            return array("xml"=>"<list>\n".$xml."</list>","vName"=>$vName);
        }
}
?>