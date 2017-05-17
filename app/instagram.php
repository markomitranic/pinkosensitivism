<?php

class Instagram {
    var $url = 'https://www.instagram.com/pinkosensitivism/media/';
    var $fileLocation = 'cache.json';
    var $data = array();
    var $server_temporary;
    var $local_temporary;
    var $currentPostOnCache;
    var $currentPostOnServer;

    public function Return_instagram_data() {

        if (file_exists($this->fileLocation)) {
            $this->data = $this->GetFileContents();
        } else {
            $this->CreateNewFile();
            $this->CreateCache();
        }

        $this->UpdateCacheIfNeeded();
        $this->display($this->data);

    }

    public function UpdateCacheIfNeeded() {
        if ($this->ShouldUpdateCache()) {
            $this->currentPostOnCache = $this->data->posts[0];
            $this->local_temporary = array();
            $this->UpdateCache();
            $this->data->posts = array_merge($this->local_temporary, $this->data->posts);
            $this->CreateOverwriteFile($this->data);
        }
    }

    public function UpdateCache() {
        foreach ($this->server_temporary->items as $key => $post) {
            if ($post->id == $this->currentPostOnCache->id) {
                break;
            }

            array_push($this->local_temporary, $this->FormatPost($post));

            if ($key >= count($this->server_temporary->items)-1) {
                if ($this->server_temporary->more_available == false) {
                    break;
                }

                sleep(2);
                $this->server_temporary = json_decode($this->GetDataFromServer($post->id));
                $this->UpdateCache();
                break;
            }
        }
    }

    public function CreateCache() {
        $this->data[last_cache] = time();
        $this->server_temporary = json_decode($this->GetDataFromServer());
        $this->CreateCacheData();
        $this->CreateOverwriteFile($this->data);
    }

    public function CreateCacheData() {
        foreach ($this->server_temporary->items as $key => $post) {
            
            array_push($this->data[posts], $this->FormatPost($post));

            if ($key >= count($this->server_temporary->items)-1) {
                if ($this->server_temporary->more_available == false) {
                    break;
                }

                sleep(7);
                echo "started new loop | ".$post->id."\n";
                $this->server_temporary = json_decode($this->GetDataFromServer($post->id));
                $this->CreateCacheData();
                break;
            }
        }
    }

    public function FormatPost($post) {
        $formatted = array(
            'image' => $post->images->standard_resolution->url,
            'code' => $post->code,
            'link' => $post->link,
            'id' => $post->id
            );
        return $formatted;
    }

    public function ShouldUpdateCache() {
        if (!$this->AllowedToCallServer()) {
            return false;
        }
        if (!$this->IsThereNewPosts()) {
            $this->data->last_cache = time();
            $this->CreateOverwriteFile($this->data);
            return false;
        }
        return true;
    }

    public function IsThereNewPosts() {
        $this->server_temporary = json_decode($this->GetDataFromServer());
        $this->currentPostOnServer = $this->server_temporary->items[0]->id;

        if (!isset($this->data->posts[0]->id) || $this->currentPostOnServer != $this->data->posts[0]->id) {
            return true;
        } else {
            return false;
        }
    }

    public function AllowedToCallServer() {
        return true; // DEV BLOCK
        $now = time();
        $timeDifference = $now - $this->data->last_cache;
        if ($timeDifference > 3600) {
            return true;
        } else {
            return false;
        }
    }

    public function GetDataFromServer($previous_post = '') {
        if ($previous_post) {
            $apiData = $this->SendRequest('https://www.instagram.com/pinkosensitivism/media/?max_id='.$previous_post);
        } else {
            $apiData = $this->SendRequest('https://www.instagram.com/pinkosensitivism/media/');
        }
        return $apiData;
    }

    public function SendRequest($url) {
        date_default_timezone_set("Europe/Belgrade");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");
        $data = curl_exec($ch);
        curl_close($ch);
        if (!$data) { die('Connection Error'); }
        return $data;
    }

    public function GetFileContents() {
        return json_decode(file_get_contents($this->fileLocation));
    }

    public function CreateNewFile() {
        $this->data = array(
            'last_cache' => time(),
            'posts' => array()
        );
        $this->CreateOverwriteFile($this->data);
    }

    public function CreateOverwriteFile($data) {
        $fp = fopen($this->fileLocation, 'w');
        fwrite($fp, json_encode($data));
        fclose($fp);
    }

    public function display($data) {
        echo json_encode($data);
    }

    public static function dd($input) {
        echo "<pre>";
        var_dump($input);
        echo "</pre>";
        echo "(die)";
        exit();
    }

}





$marko = new Instagram();
echo $marko->Return_instagram_data();
