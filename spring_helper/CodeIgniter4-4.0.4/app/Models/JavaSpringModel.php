<?php

namespace App\Models;

//use App\O\Bo\TableFieldBo;
use App\O\Bo\TableIdFieldInfoBo;
use App\O\Bo\JpaFileInfoBo;
use App\O\Bo\RepositoryFileBo;

class JavaSpringModel
{
    /**
     * 返回表字段结构
     * @param $table_name
     * @return mixed
    //[
    //    {
    //        "name": "id",
    //        "type": "int",
    //        "max_length": 11,
    //        "nullable": false,
    //        "default": null,
    //        "primary_key": 1
    //    }
    //]
     */
    public function getFieldData($table_name) {
        $db = db_connect();
        $fields = $db->getFieldData($table_name);
        $db->close();
        $rs_list = json_decode(json_encode($fields), true);
        return $rs_list;

//        $r = array();
//        foreach($rs_list as $rs){
//            $r[] = new TableFieldBo($rs['name'], $rs['type'], $rs['primary_key']);
//        }
//        return $r;

    }

    /**
     * 将变量名格式转为驼峰式的
     * @param $string
     * @param bool $isFirstLetter  首字母是否大写，如果作为java的类名，是要的
     * @return string
     */
    private function toCamelCase($string, $isFirstLetter = false){
        $string = strtolower($string);
        $arr = explode('_', $string);
        foreach ($arr as $key => $value) {
            $flag = $key > 0 || $isFirstLetter;
            $arr[$key] = $flag ? ucfirst($value) : $value;
        }
        return implode('', $arr);
    }

    private $TYPE_MAP = array(
        "VARCHAR" => "java.lang.String",
        "CHAR" => "java.lang.String",
        "BLOB" => "java.lang.byte[]",
        "TEXT" => "java.lang.String",
        "INT" => "java.lang.Long",
        "INTEGER" => "java.lang.Long",
        "TINYINT" => "java.lang.Integer",
        "SMALLINT" => "java.lang.Integer",
        "MEDIUMINT" => "java.lang.Integer",
        "BIT" => "java.lang.Boolean",
        "BIGINT" => "java.math.BigInteger",
        "FLOAT" => "java.lang.Float",
        "DOUBLE" => "java.lang.Double",
        "DECIMAL" => "java.math.BigDecimal",
        "BOOLEAN" => "java.lang.Integer",
        "DATE" => "java.sql.Date",
        "TIME" => "java.sql.Time",
        "DATETIME" => "java.sql.Timestamp",
        "TIMESTAMP" => "java.sql.Timestamp",
        "YEAR" => "java.sql.Date",
    );

    private $KEY_TYPE_FOR_JAVA = "type_for_java";
    private $KEY_TYPE_FOR_JAVA_LITE = "type_for_java_lite";
    private $KEY_JAVA_IMPORT = "java_import";

    /**
     * 根据 php（ci） 从mysql返回的表元数据信息，返回对应的java类型信息
     * @param $type_from_mysql
    //{
    //    "type_for_java": "java.lang.Long",
    //    "type_for_java_lite": "Long",
    //    "java_import": "import java.lang.Long;"
    //}
     */
    private function getFieldType4Java($type_from_mysql){
        $upper_type = strtoupper($type_from_mysql);

        if (isset($this->TYPE_MAP[$upper_type])) {
            $type_for_java = $this->TYPE_MAP[$upper_type];

            $tmp_arr = explode('.', $type_for_java);
            $type_for_java_lite = $tmp_arr[count($tmp_arr) - 1];

            $java_import = "import ". $type_for_java.";";


            return array(
                $this->KEY_TYPE_FOR_JAVA => $type_for_java,
                $this->KEY_TYPE_FOR_JAVA_LITE => $type_for_java_lite,
                $this->KEY_JAVA_IMPORT => $java_import,
            );
        } else {
            echo $upper_type.',这个类型的未配置';
            exit();
        }
    }

    /**
     * 取得表中主键的字段信息
     * @param $table_field_data
     * @return array|null
    //{
    //    "type_for_java": "java.lang.Long",
    //    "type_for_java_lite": "Long",
    //    "java_import": "import java.lang.Long;",
    //    "name": "id",
    //    "type": "int"
    //}
     */
    private function getIdFieldInfo($table_field_data): ?TableIdFieldInfoBo
    {
        foreach ($table_field_data as $v) {
            if (1 == $v['primary_key']) {
                $rs = $this->getFieldType4Java($v['type']);
                $rs['name'] = $v['name'];
                $rs['type'] = $v['type'];
//                return $rs;

                $type_for_java = $rs['type_for_java'];
                $type_for_java_lite = $rs['type_for_java_lite'];
                $java_import = $rs['java_import'];
                $name = $rs['name'];
                $type = $rs['type'];
                return new TableIdFieldInfoBo($type_for_java, $type_for_java_lite, $java_import, $name, $type);
            }
        }
        return null;
    }

    private $KEY_DO_CLASS_NAME = 'do_class_name';
    private $KEY_DO_PACKAGE_LINE = 'do_package_line' ;

    private $KEY_REPOSITORY_CUSTOM_CLASS_NAME = 'repository_custom_class_name' ;
    private $KEY_REPOSITORY_CUSTOM_PACKAGE_LINE = 'repository_custom_package_line';

    private $KEY_REPOSITORY_IMPL_CLASS_NAME = 'repository_impl_class_name' ;
    private $KEY_REPOSITORY_IMPL_PACKAGE_LINE = 'repository_impl_package_line';

    private $KEY_REPOSITORY_CLASS_NAME = 'repository_class_name' ;
    private $KEY_REPOSITORY_PACKAGE_LINE = 'repository_package_line' ;

    /**
     * 根据表名，生成JPA的相关文件名
     * @param $table_name
     * @return string
    //{
    //    "do_class_name": "NewsDO",
    //    "do_package_line": "package com.cheersmind.psytest.model.dto;",
    //    "repository_custom_class_name": "NewsRepositoryCustom",
    //    "repository_custom_package_line": "package com.cheersmind.psytest.dao;",
    //    "repository_impl_class_name": "NewsRepositoryImpl",
    //    "repository_impl_package_line": "package com.cheersmind.psytest.dao;",
    //    "repository_class_name": "NewsRepository",
    //    "repository_package_line": "package com.cheersmind.psytest.dao;"
    //}
     */
    private function getFileInfoName($table_name): JpaFileInfoBo
    {
        $do_class_name = $this->toCamelCase($table_name, true) . "DO";
        $do_package_line = 'package com.cheersmind.psytest.model.dto;';

        $repository_custom_class_name = $this->toCamelCase($table_name, true) . "RepositoryCustom";
        $repository_custom_package_line = 'package com.cheersmind.psytest.dao;';

        $repository_class_name = $this->toCamelCase($table_name, true) . "Repository";
        $repository_package_line = "package com.cheersmind.psytest.dao;";

        $repository_impl_class_name = $this->toCamelCase($table_name, true) . "RepositoryImpl";
        $repository_impl_package_line = 'package com.cheersmind.psytest.dao;';

        return new JpaFileInfoBo($do_class_name, $do_package_line, $repository_custom_class_name, $repository_custom_package_line, $repository_impl_class_name, $repository_impl_package_line, $repository_class_name, $repository_package_line);
    }

    /**
     * 生成 Repository 文件
     * todo imort do
     * @param JpaFileInfoBo $fileInfo
     * @param TableIdFieldInfoBo $id_file_info
     * @return string
     */
    private function getSpringRepositoryFile(JpaFileInfoBo $fileInfo, TableIdFieldInfoBo $id_file_info): string
    {
        $java_file_line_arr = array();
        $java_file_line_arr[] = $fileInfo->getRepositoryPackageLine();
        //        todo imort do
        $java_file_line_arr[] = 'import org.springframework.data.jpa.repository.JpaRepository;';
        $java_file_line_arr[] = <<<JAVA
public interface {$fileInfo->getRepositoryClassName()} extends JpaRepository<{$fileInfo->getDoClassName()},{$id_file_info->getTypeForJavaLite()}>,{$fileInfo->getRepositoryCustomClassName()} {

}
JAVA;
        return implode("\n", $java_file_line_arr);
    }

    /**
     * 生成 RepositoryCustom
     * @param JpaFileInfoBo $fileInfo
     * @param TableIdFieldInfoBo $id_file_info
     * @return string
     */
    private function getSpringRepositoryCustomFile(JpaFileInfoBo $fileInfo, TableIdFieldInfoBo $id_file_info): string
    {
        $today = date("Y/m/d");
        $java_file_line_arr = array();
        $java_file_line_arr[] = $fileInfo->getRepositoryCustomPackageLine();
        $java_file_line_arr[] = <<<JAVA

/**
 * @author：virhuiai
 * @date：{$today}
 */
public interface {$fileInfo->getRepositoryCustomClassName()} {
}
JAVA;
        return implode("\n", $java_file_line_arr);
    }

    /**
     * 生成 RepositoryImpl
     * @param JpaFileInfoBo $fileInfo
     * @param TableIdFieldInfoBo $id_file_info
     * @return string
     */
    private function getSpringRepositoryImplFile(JpaFileInfoBo $fileInfo, TableIdFieldInfoBo $id_file_info): string
    {
        $today = date("Y/m/d");
        $java_file_line_arr = array();
        $java_file_line_arr[] = $fileInfo->getRepositoryImplPackageLine();
        $java_file_line_arr[] = <<<JAVA

/**
 * @author：virhuiai
 * @date：{$today}
 */
public class {$fileInfo->getRepositoryImplClassName()} implements {$fileInfo->getRepositoryCustomClassName()} {
}
JAVA;
        return implode("\n", $java_file_line_arr);
    }

    /**
     * 将关联对象转换为PHP Bo 类
     * @param array $assocArray
     * @param string $className
     * @return string
     *
     * ex:
     * $this->assocArrayToPhpClass($id_field_info, "TableIdFieldInfo")
     */
    private function assocArrayToPhpClass(array $assocArray, string $className){
        $field_arr = array();
        $field_arr_comment = array();
        foreach ($assocArray as $k => $v){
            if(is_string($v)){
                $v = '"'.$v.'"';
            }

            $field_arr[] =<<<PHPStr
    private \${$k}={$v};
PHPStr;
            $field_arr_comment[] =<<<PHPStr
//    private \${$k};
PHPStr;
        }

        // 注释部分，用于上面的部分，先利用 ide 的set get 方法生成带有类型的方法后，再将这部分注释的代码替换上一部分代码
        $field_str = implode("\n", $field_arr);
        $field_str_comment = implode("\n", $field_arr_comment);
        $rs =<<<PHPStr
class {$className}Bo
{
{$field_str}
{$field_str_comment}
}
PHPStr;
        return $rs;
    }

    /**
     * 返回 SpringRepository 相关的三个文件的内容
     * @param $table_name
     * @return RepositoryFileBo
     */
    public function getSpringRepository($table_name):RepositoryFileBo{
        $table_field_data = $this->getFieldData($table_name);
        // 主键的字段信息
        $id_field_info = $this->getIdFieldInfo($table_field_data);
        $file_info = $this->getFileInfoName($table_name);

        $repository_file_content = $this->getSpringRepositoryFile($file_info, $id_field_info);
        $repository_custom_file_content = $this->getSpringRepositoryCustomFile($file_info, $id_field_info);
        $repository_impl_file_content = $this->getSpringRepositoryImplFile($file_info, $id_field_info);

//        $test = array(
//            'repository_file_content' => 'repository_file_content',
//            'repository_custom_file_content' => 'repository_custom_file_content',
//            'repository_impl_file_content' => 'repository_impl_file_content',
//        );

        return new RepositoryFileBo($repository_file_content, $repository_custom_file_content, $repository_impl_file_content);
    }
}
