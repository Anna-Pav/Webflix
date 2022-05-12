<?php

class Entity{

    private $con;
    private $data;

    public function __construct($con, $input){
        $this->con = $con;

        if(is_array($input)){
            $this->data = $input;
        }
        else{
            $query = $this->con->prepare("SELECT * FROM entities WHERE id=:id");
            $query->bindValue(":id",$input);
            $query->execute();

            $this->data = $query->fetch(PDO::FETCH_ASSOC);
        }
        
    }

    public function getId(){
        return $this->data["id"];
    }

    public function getName(){
        return $this->data["name"];
    }

    public function getThumbnail(){
        return $this->data["thumbnail"];
    }

    public function getPreview(){
        return $this->data["preview"];
    }



    public function getSeasons(){
        $query=$this->con->prepare("SELECT * FROM videos WHERE entityId=:id
                                 AND isMovie=0 ORDER BY season, episode ASC");
        $query->bindValue(":id",$this->getId());    
        $query->execute();

        $seasons = array();
        $videos = array();
        $currentSeason = null;
        while($row = $query->fetch(PDO::FETCH_ASSOC)){

            if($currentSeason != null && $currentSeason != $row["season"]){
                $seasons[]= new season($currentSeason, $videos);
                $videos = array();
            }

            $currentSeason = $row["season"];
            $videos[] = new video($this->con, $row);
        }

        if(sizeof($videos)!=0){
            $seasons[]= new season($currentSeason, $videos);
        }

        return $seasons;
    }



}


?>