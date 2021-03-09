<?php namespace App\Controllers;

use App\Models\DbModel;
use App\Models\JavaSpringModel;

class Tool extends BaseController
{

//    /**
//     * listTables
//     * http://127.0.0.1/index.php/Tool/ci_list_tables
//     * @return string
//     */
//    public function ci_list_tables()
//    {
//        $model = new DbModel();
//        $model->listTables();
////        return view('LearnFront/Ci/ci_1.php');
//    }
//
//    /**
//     * http://127.0.0.1/index.php/Tool/get_field_names
//     */
//    public function get_field_names()
//    {
//        $model = new DbModel();
//        $model->getFieldNames("WROX_USER");
////        return view('LearnFront/Ci/ci_1.php');
//    }
//
//    /**
//     * http://127.0.0.1/index.php/Tool/get_field_data
//     */
//    public function get_field_data()
//    {
//        $model = new DbModel();
//        $model->getFieldData("WROX_USER");
////        return view('LearnFront/Ci/ci_1.php');
//    }
//
//    /**
//     * fixme 重新组织下代码，每个函数不超过 36 行
//     * 生成spring的do
//     * http://127.0.0.1/index.php/Tool/spring_do
//     */
//    public function spring_do()
//    {
//        $model = new DbModel();
//        $model->getSpringDo("psy_exam_workstation_rec_img");
////        return view('LearnFront/Ci/ci_1.php');
//    }
//
//    /**
//     * http://127.0.0.1/index.php/Tool/json_to_php_class
//     */
//    public function json_to_php_class(){
//
//    }
//
//    /**
//     * spring_repository工具
//     * http://127.0.0.1/index.php/Tool/spring_repository
//     */
//    public function spring_repository(){
//        $model = new JavaSpringModel();
////        $model->getFieldData("news");
//        $repository = $model->getSpringRepository("psy_exam_workstation_rec_img");
//
//        $custom = $repository->getRepositoryCustomFileContent();
//        $r = $repository->getRepositoryFileContent();
//        $impl = $repository->getRepositoryImplFileContent();
//
//        echo $custom."\n//----------------------------------------------------\n\n";
//        echo $r."\n//----------------------------------------------------\n";
//        echo $impl."\n//----------------------------------------------------\n";
//    }


	/**
	 * http://127.0.0.1/index.php/Tool/one/psy_exam_workstation_rec_img
	 * @param null $t
	 */
	public function one($t = null)
	{
//		echo $t;exit();
		if (null != $t) {
			echo "\n//----------------------------------------------------\n";
			$do_model = new DbModel();
			$do_model->getSpringDo($t);
			echo "\n//----------------------------------------------------\n";


			$model = new JavaSpringModel();
			$repository = $model->getSpringRepository($t);

			$custom = $repository->getRepositoryCustomFileContent();
			$r = $repository->getRepositoryFileContent();
			$impl = $repository->getRepositoryImplFileContent();

			echo $custom . "\n//----------------------------------------------------\n\n";
			echo $r . "\n//----------------------------------------------------\n";
			echo $impl . "\n//----------------------------------------------------\n";

		}
	}






}
