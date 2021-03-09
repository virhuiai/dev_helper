<?php
namespace App\O\Bo;

class TableFieldBo
{
    private $name;
    private $type;
//    private $max_length;
    //        "max_length": 11,
    //        "nullable": false,
    //        "default": null,
    private $primary_key;


    /**
     * TableFieldBo constructor.
     * @param string $name
     * @param string $type
//     * @param int $max_length
     * @param int $primary_key
     */
    public function __construct(
        string $name
        , string $type
//        , int $max_length
        , int $primary_key)
    {
        $this->name = $name;
        $this->type = $type;
//        $this->max_length = $max_length;
        $this->primary_key = $primary_key;
    }



    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

//    /**
//     * @return int
//     */
//    public function getMaxLength(): int
//    {
//        return $this->max_length;
//    }
//
//    /**
//     * @param int $max_length
//     */
//    public function setMaxLength(int $max_length): void
//    {
//        $this->max_length = $max_length;
//    }

    /**
     * @return int
     */
    public function getPrimaryKey(): int
    {
        return $this->primary_key;
    }

    /**
     * @param int $primary_key
     */
    public function setPrimaryKey(int $primary_key): void
    {
        $this->primary_key = $primary_key;
    }




}