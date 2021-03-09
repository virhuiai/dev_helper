<?php


namespace App\O\Bo;


class JpaFileInfoBo
{
    private $do_class_name="NewsDO";
    private $do_package_line="package com.cheersmind.psytest.model.dto;";
    private $repository_custom_class_name="NewsRepositoryCustom";
    private $repository_custom_package_line="package com.cheersmind.psytest.dao;";
    private $repository_impl_class_name="NewsRepositoryImpl";
    private $repository_impl_package_line="package com.cheersmind.psytest.dao;";
    private $repository_class_name="NewsRepository";
    private $repository_package_line="package com.cheersmind.psytest.dao;";

//    private $do_class_name;
//    private $do_package_line;
//    private $repository_custom_class_name;
//    private $repository_custom_package_line;
//    private $repository_impl_class_name;
//    private $repository_impl_package_line;
//    private $repository_class_name;
//    private $repository_package_line;

//    /**
//     * JpaFileInfoBo constructor.
//     * @param $do_class_name
//     * @param $do_package_line
//     * @param $repository_custom_class_name
//     * @param $repository_custom_package_line
//     * @param $repository_impl_class_name
//     * @param $repository_impl_package_line
//     * @param $repository_class_name
//     * @param $repository_package_line
//     */
//    public function __construct($do_class_name, $do_package_line, $repository_custom_class_name, $repository_custom_package_line, $repository_impl_class_name, $repository_impl_package_line, $repository_class_name, $repository_package_line)
//    {
//        $this->do_class_name = $do_class_name;
//        $this->do_package_line = $do_package_line;
//        $this->repository_custom_class_name = $repository_custom_class_name;
//        $this->repository_custom_package_line = $repository_custom_package_line;
//        $this->repository_impl_class_name = $repository_impl_class_name;
//        $this->repository_impl_package_line = $repository_impl_package_line;
//        $this->repository_class_name = $repository_class_name;
//        $this->repository_package_line = $repository_package_line;
//    }
    /**
     * JpaFileInfoBo constructor.
     * $do_class_name, $do_package_line, $repository_custom_class_name, $repository_custom_package_line, $repository_impl_class_name, $repository_impl_package_line, $repository_class_name, $repository_package_line
     * @param string $do_class_name
     * @param string $do_package_line
     * @param string $repository_custom_class_name
     * @param string $repository_custom_package_line
     * @param string $repository_impl_class_name
     * @param string $repository_impl_package_line
     * @param string $repository_class_name
     * @param string $repository_package_line
     */
    public function __construct(string $do_class_name, string $do_package_line, string $repository_custom_class_name, string $repository_custom_package_line, string $repository_impl_class_name, string $repository_impl_package_line, string $repository_class_name, string $repository_package_line)
    {
        $this->do_class_name = $do_class_name;
        $this->do_package_line = $do_package_line;
        $this->repository_custom_class_name = $repository_custom_class_name;
        $this->repository_custom_package_line = $repository_custom_package_line;
        $this->repository_impl_class_name = $repository_impl_class_name;
        $this->repository_impl_package_line = $repository_impl_package_line;
        $this->repository_class_name = $repository_class_name;
        $this->repository_package_line = $repository_package_line;
    }


    /**
     * @return string
     */
    public function getDoClassName(): string
    {
        return $this->do_class_name;
    }

    /**
     * @param string $do_class_name
     */
    public function setDoClassName(string $do_class_name): void
    {
        $this->do_class_name = $do_class_name;
    }

    /**
     * @return string
     */
    public function getDoPackageLine(): string
    {
        return $this->do_package_line;
    }

    /**
     * @param string $do_package_line
     */
    public function setDoPackageLine(string $do_package_line): void
    {
        $this->do_package_line = $do_package_line;
    }

    /**
     * @return string
     */
    public function getRepositoryCustomClassName(): string
    {
        return $this->repository_custom_class_name;
    }

    /**
     * @param string $repository_custom_class_name
     */
    public function setRepositoryCustomClassName(string $repository_custom_class_name): void
    {
        $this->repository_custom_class_name = $repository_custom_class_name;
    }

    /**
     * @return string
     */
    public function getRepositoryCustomPackageLine(): string
    {
        return $this->repository_custom_package_line;
    }

    /**
     * @param string $repository_custom_package_line
     */
    public function setRepositoryCustomPackageLine(string $repository_custom_package_line): void
    {
        $this->repository_custom_package_line = $repository_custom_package_line;
    }

    /**
     * @return string
     */
    public function getRepositoryImplClassName(): string
    {
        return $this->repository_impl_class_name;
    }

    /**
     * @param string $repository_impl_class_name
     */
    public function setRepositoryImplClassName(string $repository_impl_class_name): void
    {
        $this->repository_impl_class_name = $repository_impl_class_name;
    }

    /**
     * @return string
     */
    public function getRepositoryImplPackageLine(): string
    {
        return $this->repository_impl_package_line;
    }

    /**
     * @param string $repository_impl_package_line
     */
    public function setRepositoryImplPackageLine(string $repository_impl_package_line): void
    {
        $this->repository_impl_package_line = $repository_impl_package_line;
    }

    /**
     * @return string
     */
    public function getRepositoryClassName(): string
    {
        return $this->repository_class_name;
    }

    /**
     * @param string $repository_class_name
     */
    public function setRepositoryClassName(string $repository_class_name): void
    {
        $this->repository_class_name = $repository_class_name;
    }

    /**
     * @return string
     */
    public function getRepositoryPackageLine(): string
    {
        return $this->repository_package_line;
    }

    /**
     * @param string $repository_package_line
     */
    public function setRepositoryPackageLine(string $repository_package_line): void
    {
        $this->repository_package_line = $repository_package_line;
    }




}