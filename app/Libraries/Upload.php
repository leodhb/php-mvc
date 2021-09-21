<?php
namespace Libraries;

class Upload {
    private $path;
    private $file;
    private $result;
    private $error;
    private $abspath;

    public function getResult() : string{ 
        return $this->result;
    }

    public function getError() : string {
        return $this->error;
    }

    public function getAbsPath() : string {
        return $this->abspath;
    }

    public function __construct(string $path)
    {
        $this->path = 'uploads'. DIRECTORY_SEPARATOR . $path;

        if(!file_exists($this->path) && !is_dir($this->path)) {
            mkdir($this->path, 0777);
        }
    }

    public function media(array $file) {
        $this->file = $file;
        $valid_extensions = ["mp4"];
        $valid_mimetypes  = ["video/mp4"];

        $extension = pathinfo($this->file['name'], PATHINFO_EXTENSION);
        $mimetype = $this->file['type'];
        $this->file['name'] = uniqid() . '.' . $extension;

        if(!in_array($extension, $valid_extensions)) {
            $this->error = 'extensao invalida';
        } else if(!in_array($mimetype, $valid_mimetypes)) {
            $this->error = 'tipo invalido';
        } else {
            $this->moveFile();
        }

    }
    public function profilepic(array $file) {
        $this->file = $file;
        $valid_extensions = ["jpg", "png"];
        $extension = pathinfo($this->file['name'], PATHINFO_EXTENSION);
        $this->file['name'] = 'profile.jpg';

        if(!in_array($extension, $valid_extensions)) {
            return false;
        } else {
            $this->moveFile();
            return true;
        }
    }


    private function moveFile() {
        if(move_uploaded_file($this->file['tmp_name'], $this->path . DIRECTORY_SEPARATOR . $this->file['name'])) {
            $this->result = 'DEU BOM';
            $this->abspath =  $this->path . DIRECTORY_SEPARATOR . $this->file['name'];
        }
    }

}