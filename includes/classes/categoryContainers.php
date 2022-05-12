<?php
class categoryContainers{

    private $con;
    private $username;

    #constructor
    public function __construct($con,$username){

        $this->con = $con;
        $this->username = $username;
    }

    public function showAllCategories() {
        $query = $this->con->prepare("SELECT * FROM categories");
        $query->execute();

        $html = "<div class='previewCategories'>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHtml($row, null, true, true);
        }

        return $html . "</div>";
    }

    public function showTVShowCategories() {
        $query = $this->con->prepare("SELECT * FROM categories");
        $query->execute();

        $html = "<div class='previewCategories'>
                    <h1>TV Shows</h1>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHtml($row, null, true, false);
        }

        return $html . "</div>";
    }


    public function showMovieCategories() {
        $query = $this->con->prepare("SELECT * FROM categories");
        $query->execute();

        $html = "<div class='previewCategories'>
                    <h1>Movies</h1>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHtml($row, null, false, true);
        }

        return $html . "</div>";
    }

    public function showCategory($categoryId, $title = null) {
        $query = $this->con->prepare("SELECT * FROM categories WHERE id=:id");
        $query->bindValue(":id", $categoryId);
        $query->execute();

        $html = "<div class='previewCategories noScroll'>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHtml($row, $title, true, true);
        }

        return $html . "</div>";
    }



    private function getCategoryHtml($data, $title, $tvShows, $movies){
        $categoryId = $data["id"];
        $title = $title==null? $data["name"]:$title;

        if($tvShows && $movies){
            $entities = entityProvider::getEntities($this->con, $categoryId, 30);
        } else  if($tvShows){
            //get tv show entities
            $entities = entityProvider::getTVShowEntities($this->con, $categoryId, 30);

        } else {
            //get movie entities
            $entities = entityProvider::getMovieEntities($this->con, $categoryId, 30);

        }

        if(sizeof($entities)==0){
            return;
        }

        $entitiesHtml = " ";
        $previewProvider = new previewProvider($this->con, $this->username);

        foreach($entities as $entity){
            $entitiesHtml .= $previewProvider->createEntityPreviewSquare($entity);
        }

        return "<div class='category'>
                    <a href='category.php?id=$categoryId'>
                        <h3>$title</h3>
                    </a>
                    
                    <div class='entities'>
                    $entitiesHtml
                    </div>
                </div>";
    }
}
    ?>