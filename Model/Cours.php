<?php
class Cours{
    public ?int $idCourse;
    public ?int $idCreator;
    public ?string $title;
    public ?string $category;
    public ?string $descript;
    public ?DateTime $Creation_Date;
    

    public function __construct (?int $idCourse,?int $idCreator,?string $title,?string $category,?string $descript,?DateTime $Creation_Date)
    {
        $this->idCourse=$idCourse;
        $this->idCreator=$idCreator;
        $this->title=$title;
        $this->category=$category;
        $this->descript=$descript;
        $this->Creation_Date=$Creation_Date;
    }

    public function getidCreator(): ?int
    {
        return $this->idCreateor;
    }

    public function getidCourse(): ?int
    {
        return $this->idCourse;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function getDescription(): ?string
    {
        return $this->descript;
    }

    public function getCreationDate():?DateTime
    {
        return $this->Creation_Date;
    }
    
    public function setidCoursee(?int $idCourse): void
    {
        $this->idCourse=$idCourse;
    }

    public function setIdCreator(?int $idCreator): void
    {
        $this->idCreator=$idCreator;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function setCategory(?string $category): void
    {
        $this->category = $category;
    } 

    public function setDescription(?string $descript): void
    {
        $this->descript = $descript;
    }

    public function setCreationdate(?DateTime $Creation_Date): void 
    {
        $this->Creation_Date= $Creation_Date;
    }
}

?>