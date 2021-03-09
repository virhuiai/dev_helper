<?php


namespace App\O\Bo;


class TableIdFieldInfoBo
{
    private $type_for_java;//="java.lang.Long";
    private $type_for_java_lite;//="Long";
    private $java_import;//="import java.lang.Long;";
    private $name;//="id";
    private $type;//="int";

    /**
     * TableIdFieldInfoBo constructor.
     * @param string $type_for_java
     * @param string $type_for_java_lite
     * @param string $java_import
     * @param string $name
     * @param string $type
     */
    public function __construct(string $type_for_java, string $type_for_java_lite, string $java_import, string $name, string $type)
    {
        $this->type_for_java = $type_for_java;
        $this->type_for_java_lite = $type_for_java_lite;
        $this->java_import = $java_import;
        $this->name = $name;
        $this->type = $type;
    }


    /**
     * @return string
     */
    public function getTypeForJava(): string
    {
        return $this->type_for_java;
    }

    /**
     * @param string $type_for_java
     */
    public function setTypeForJava(string $type_for_java): void
    {
        $this->type_for_java = $type_for_java;
    }

    /**
     * @return string
     */
    public function getTypeForJavaLite(): string
    {
        return $this->type_for_java_lite;
    }

    /**
     * @param string $type_for_java_lite
     */
    public function setTypeForJavaLite(string $type_for_java_lite): void
    {
        $this->type_for_java_lite = $type_for_java_lite;
    }

    /**
     * @return string
     */
    public function getJavaImport(): string
    {
        return $this->java_import;
    }

    /**
     * @param string $java_import
     */
    public function setJavaImport(string $java_import): void
    {
        $this->java_import = $java_import;
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



}