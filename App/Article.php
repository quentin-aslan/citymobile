<?php

class Article
{
    public $errors = [];
    private $id;
    private $type;
    private $mark;
    private $name;
    private $price;
    private $photo;
    private $description;
    private $date_create;

    const ERROR_TYPE = 1;
    const ERROR_MARK = 2;
    const ERROR_NAME = 3;
    const ERROR_PRICE = 4;
    const ERROR_PHOTO = 5;
    const ERROR_DESCRIPTION = 6;

    public function __construct($datas = [])
    {
        $this->hydrate($datas);
    }

    public function hydrate($datas)
    {
        foreach ($datas as $key => $value) {
            $method = 'set' . ucfirst($key);
            $this->$method($value);
        }
    }

    // Getter & Setter

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        if(!is_string($type) && empty($type))
            $this->errors = self::ERROR_TYPE;
        else
            $this->type = $type;
    }

    /**
     * @return string
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * @param string $mark
     */
    public function setMark($mark)
    {
        if(!is_string($mark) && empty($mark))
            $this->errors = self::ERROR_MARK;
        else
            $this->mark = $mark;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        if(!is_string($name) && empty($name))
            $this->errors = self::ERROR_NAME;
        else
            $this->mark = $name;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->price = (int) $price;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        if(!is_string($photo) && empty($photo))
            $this->errors = self::ERROR_PHOTO;
        else
            $this->photo = $photo;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        if (!is_string($description) && empty($description))
            $this->errors = self::ERROR_DESCRIPTION;
        else
            $this->description = $description;
    }

    /**
     * @return Date
     */
    public function getDateCreate()
    {
        return $this->date_create;
    }

    /**
     * @param Date $date_create
     */
    public function setDateCreate($date_create)
    {
        $this->date_create = $date_create;
    }


}