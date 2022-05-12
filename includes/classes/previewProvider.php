<?php
class PreviewProvider{

    private $con;
    private $username;

    #constructor
    public function __construct($con,$username){

        $this->con = $con;
        $this->username = $username;
    }

    public function createTVShowPreviewVideo(){
        $entitiesArray = entityProvider::getTVShowEntities($this->con, null, 1);

        if(sizeof($entitiesArray)==0){
            ErrorMessage::show("No TV shows to display");
        }

        return $this->createPreviewVideo($entitiesArray[0]);
    }

    public function createCategoryPreviewVideo($categoryId){
        $entitiesArray = entityProvider::getEntities($this->con, $categoryId, 1);

        if(sizeof($entitiesArray)==0){
            ErrorMessage::show("No TV shows to display");
        }

        return $this->createPreviewVideo($entitiesArray[0]);
    }

    public function createMoviePreviewVideo(){
        $entitiesArray = entityProvider::getMovieEntities($this->con, null, 1);

        if(sizeof($entitiesArray)==0){
            ErrorMessage::show("No movies to display");
        }

        return $this->createPreviewVideo($entitiesArray[0]);
    }

    public function createPreviewVideo($entity){
        if($entity == null){
            $entity = $this->getRandomEntity();
        }

        $id = $entity->getId();
        $name = $entity->getName();
        $preview = $entity->getPreview();
        $thumbnail = $entity->getThumbnail();

     

        return "<div class='previewContainer'>

                    <img src='$thumbnail' class='previewImage' hidden>

                    <video autoplay muted class='previewVideo' onended='previewEnded()'>
                        <source src='$preview' type='video/mp4'>
                    </video>

                    <div class='previewOverlay'>
                        
                        <div class='mainDetails'>
                            <h3>$name</h3>

                            <div class='buttons'>
                            <button onclick='watchVideo($videoId)'><i class='fas fa-play'></i> Play</button>
                                <button onclick='volumeToggle(this)'>Volume</button>
                            </div>

                        </div>

                    </div>
        
                </div>";

    }

    public function createEntityPreviewSquare($entity){
        $id = $entity->getId();
        $thumbnail = $entity->getThumbnail();
        $name = $entity->getName();

        return "<a href='entity.php?id=$id'>
                    <div class='previewContainer small'>
                        <img src ='$thumbnail' title='$name'>
                    </div>
                </a>";
 
    }

    #displays a different show on each refresh in the home page
    private function getRandomEntity(){
       $entity = EntityProvider::getEntities($this->con, null, 1);
       return $entity[0];
    }
}
?>