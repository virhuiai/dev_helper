<?php

namespace App\Models;

class DbModel
{
    public function listTables(){
        $db = db_connect();

        $tables = $db->listTables();
        foreach ($tables as $table)
        {
            echo $table."<br>";
        }

        $db->close();
    }

    public function getFieldNames($table_name){
        $db = db_connect();

        $fields = $db->getFieldNames($table_name);
        foreach ($fields as $field)
        {
            echo $field."<br>";
        }

        $db->close();
    }

    public function getFieldData($table_name){
        $db = db_connect();

        $fields = $db->getFieldData($table_name);

        foreach ($fields as $field)
        {
            echo $field->name;
            echo $field->type;
            echo $field->max_length;
            echo $field->primary_key;
        }

        $db->close();
    }

    private function toJavaClass($string)
    {
        $arr = explode('.', $string);
        return $arr[count($arr) - 1];
    }

    private function toCamelCase($string, $isFirstLetter = false)
    {
        $string = strtolower($string);
        $arr = explode('_', $string);
        foreach ($arr as $key => $value) {
            $flag = $key > 0 || $isFirstLetter;
            $arr[$key] = $flag ? ucfirst($value) : $value;
        }
        return implode('', $arr);
    }


//    private function toClassCamelCase($string, $isFirstLetter = false)
//    {
//        $string = strtolower($string);
//        $arr = explode('_', $string);
//        foreach ($arr as $key => $value) {
//            $arr[$key] = ucfirst($value);
//        }
//        return implode('', $arr);
//    }

    public function getSpringDo($table_name){
        $db = db_connect();
        $fields = $db->getFieldData($table_name);
        $db->close();

        $rs = json_decode(json_encode($fields), true);

        $do_class_name = $this->toCamelCase($table_name, true)."DO";

        $TYPE_MAP = array(
            "VARCHAR" => "java.lang.String",
            "CHAR" => "java.lang.String",
            "BLOB" => "java.lang.byte[]",
            "TEXT" => "java.lang.String",
            "INT" => "java.lang.Integer",
            "INTEGER" => "java.lang.Integer",
            "TINYINT" => "java.lang.Integer",
            "SMALLINT" => "java.lang.Integer",
            "MEDIUMINT" => "java.lang.Integer",
            "BIT" => "java.lang.Boolean",
            "BIGINT" => "java.lang.Long",
            "FLOAT" => "java.lang.Float",
            "DOUBLE" => "java.lang.Double",
            "DECIMAL" => "java.math.BigDecimal",
            "BOOLEAN" => "java.lang.Integer",

            "DATE" => "java.sql.Date",
            "TIME" => "java.sql.Time",
            "DATETIME" => "java.sql.Timestamp",
            "TIMESTAMP" => "java.sql.Timestamp",
            "YEAR" => "java.sql.Date",
            "LONGTEXT" => "java.lang.String",
        );

        // import 语句
        $java_import_arr = array();
        // 字段语句
        $java_field_arr = array();
        $java_get_set_arr = array();

        foreach ($rs as &$v){

            if(1 == $v['primary_key']){
                $before_set_func = "@Id";
            }else{
                $before_set_func = "@Basic";
            }

            $v['type'] = strtoupper($v['type']);
            $v['name_4_java'] = $this->toCamelCase($v['name']);
            if(isset($TYPE_MAP[$v['type']])){
                $v['type_4_java'] = $TYPE_MAP[$v['type']];
                $v['type_4_java_lite'] = $this->toJavaClass($v['type_4_java'], true);

                if (!isset($java_import_arr[$v['type_4_java_lite']])) {
                    $java_import_arr[$v['type_4_java_lite']] = "import ". $v['type_4_java'].";";
                }
                $java_field_arr[] = <<<Private
    private {$v['type_4_java_lite']} {$v['name_4_java']};
Private;
            }else{
                echo $v['type'];
                exit();
            }

            $set_method_name = $this->toCamelCase('set_'.$v['name']);
            $get_method_name = $this->toCamelCase('get_'.$v['name']);

            $java_get_set_arr[] =<<<Private
    {$before_set_func}
    @Column(name = "{$v['name']}")
    public {$v['type_4_java_lite']} {$get_method_name}(){
        return this.{$v['name_4_java']};
    }
    
    public void {$set_method_name}({$v['type_4_java_lite']} {$v['name_4_java']}){
        this.{$v['name_4_java']} = {$v['name_4_java']};
    }
    
Private;
        }

        $java_packege =<<<JAVA
package com.cheersmind.psytest.model.dto;
JAVA;
        $java_import_more=<<<JAVA
import org.springframework.data.annotation.CreatedDate;
import org.springframework.data.annotation.LastModifiedDate;
import org.springframework.data.jpa.domain.support.AuditingEntityListener;
JAVA;

        $java_class_begin =<<<JAVA
@Entity
@Table(name = "{$table_name}")
@EntityListeners(AuditingEntityListener.class)
public class {$do_class_name} {
JAVA;

        $java_class_end =<<<JAVA
}
JAVA;

        $java_do_file_line_arr = array();
        $java_do_file_line_arr[] = $java_packege;
        $java_do_file_line_arr[] = $java_import_more;
        foreach ($java_import_arr as $import){
            $java_do_file_line_arr[] = $import;
        }
        $java_do_file_line_arr[] = $java_class_begin;

        foreach ($java_field_arr as $java_field){
            $java_do_file_line_arr[] = $java_field;
        }

        foreach ($java_get_set_arr as $set_get){
            $java_do_file_line_arr[] = $set_get;
        }

        $java_do_file_line_arr[] = $java_class_end;

        foreach ($java_do_file_line_arr as $java_line){
            echo $java_line."\n";
        }


    }

//

//    public function listTables(){
//        $db = db_connect();
//
//
//        $db->close();
//    }

}
