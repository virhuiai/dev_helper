<?php


namespace App\O\Bo;


class RepositoryFileBo
{
//    private $repository_file_content="repository_file_content";
//    private $repository_custom_file_content="repository_custom_file_content";
//    private $repository_impl_file_content="repository_impl_file_content";

    private $repository_file_content;
    private $repository_custom_file_content;
    private $repository_impl_file_content;
    /**
     * $repository_file_content, $repository_custom_file_content, $repository_impl_file_content
     * RepositoryFileBo constructor.
     * @param string $repository_file_content
     * @param string $repository_custom_file_content
     * @param string $repository_impl_file_content
     */
    public function __construct(string $repository_file_content, string $repository_custom_file_content, string $repository_impl_file_content)
    {
        $this->repository_file_content = $repository_file_content;
        $this->repository_custom_file_content = $repository_custom_file_content;
        $this->repository_impl_file_content = $repository_impl_file_content;
    }

//    /**
//     * RepositoryFileBo constructor.
//     * @param $repository_file_content
//     * @param $repository_custom_file_content
//     * @param $repository_impl_file_content
//     */
//    public function __construct($repository_file_content, $repository_custom_file_content, $repository_impl_file_content)
//    {
//        $this->repository_file_content = $repository_file_content;
//        $this->repository_custom_file_content = $repository_custom_file_content;
//        $this->repository_impl_file_content = $repository_impl_file_content;
//    }


    /**
     * @return string
     */
    public function getRepositoryFileContent(): string
    {
        return $this->repository_file_content;
    }

    /**
     * @param string $repository_file_content
     */
    public function setRepositoryFileContent(string $repository_file_content): void
    {
        $this->repository_file_content = $repository_file_content;
    }

    /**
     * @return string
     */
    public function getRepositoryCustomFileContent(): string
    {
        return $this->repository_custom_file_content;
    }

    /**
     * @param string $repository_custom_file_content
     */
    public function setRepositoryCustomFileContent(string $repository_custom_file_content): void
    {
        $this->repository_custom_file_content = $repository_custom_file_content;
    }

    /**
     * @return string
     */
    public function getRepositoryImplFileContent(): string
    {
        return $this->repository_impl_file_content;
    }

    /**
     * @param string $repository_impl_file_content
     */
    public function setRepositoryImplFileContent(string $repository_impl_file_content): void
    {
        $this->repository_impl_file_content = $repository_impl_file_content;
    }

}