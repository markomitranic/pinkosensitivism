<?php

class Instagram {

    private function createDataObject() {
        if (file_exists($this->fileLocation)) {
            $this->data = $this->GetFileContents();
        } else {
            $this->CreateNewFile();
            $this->CreateCache();
        }

        $this->UpdateCacheIfNeeded();
    }

    private function UpdateCacheIfNeeded() {
        if ($this->ShouldUpdateCache()) {
            $this->currentPostOnCache = $this->data->posts[0];
            $this->local_temporary = array();
            $this->UpdateCache();
            $this->data->posts = array_merge($this->local_temporary, $this->data->posts);
            $this->CreateOverwriteFile($this->data);
        }
    }

    private function ShouldUpdateCache() {
        if (!$this->AllowedToCallServer()) {
            return false;
        }
        if (!$this->thereIsNewPosts()) {
            $this->data->last_cache = time();
            $this->CreateOverwriteFile($this->data);
            return false;
        }
        return true;
    }

    private function UpdateCache() {
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

    private function CreateCache() {
        $this->data[last_cache] = time();
        $this->server_temporary = json_decode($this->GetDataFromServer());
        $this->CreateCacheData();
        $this->CreateOverwriteFile($this->data);
    }

    private function CreateCacheData() {
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



    private function thereIsNewPosts() {
        $this->server_temporary = json_decode($this->GetDataFromServer());
        $this->currentPostOnServer = $this->server_temporary->items[0]->id;

        if (!isset($this->data->posts[0]->id) || $this->currentPostOnServer != $this->data->posts[0]->id) {
            return true;
        } else {
            return false;
        }
    }

    private function AllowedToCallServer() {
        $now = time();
        $timeDifference = $now - $this->data->last_cache;
        if ($timeDifference > 3600) {
            return true;
        } else {
            return false;
        }
    }



}
