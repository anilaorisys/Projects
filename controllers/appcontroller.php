<?php
/**
 * Class defined for App Controller
 * @since 29-04-2015
 * @author Anila Gopi
 */
class AppController extends Controller
{

	public function __construct()
	{
		if(PHP_SAPI!='cli')
		{
			echo "This Application run only CLI mode";
			exit;
		}
		$this->_model = new AppModel();
	}
	
	public function index()
	{
		try {
			$tableDetails = $this->_model->getAllTables();
			//print_r($tableDetails);
			if (!empty($tableDetails))
			{
				$insertDetails=$this->_insert($tableDetails);
			}
			else 
			{
				echo "No Tables Found";
			}
						 
		} catch (Exception $e) {
			echo '<h1>Application error:</h1>' . $e->getMessage();
		}
	}
	public function _insert($details)
	{
	try {
			$tablename="";
			$fieldData=array();
			$tablename=array();$i=0;
			foreach($details as $val) {
				array_push($tablename,$val['table_name']);
				$fieldName[$val['table_name']][$i]=$val['column_name'];
				$i++;
			}
			$tablename=array_unique($tablename);
			$deleteDetails=$this->_model->delete($tablename);
			foreach($tablename as $row):
				for($z=1;$z<=COUNT;$z++) {
				foreach($fieldName[$row] as $fields):
				$fieldData[$fields]=$z;
				endforeach;
				$saveDetails=$this->_model->save($row,$fieldData);
				}
				$fieldData = array();
			endforeach;
			echo "Datas Inserted Successfully";
		} catch (Exception $e) {
			echo '<h1>Application error:</h1>' . $e->getMessage();
		}
	}
}