<?php
/**
 * Class defined for App Model
 * @since 29-04-2015
 * @author Anila Gopi
 */
class AppModel extends Model
{	
	public function getAllTables()
	{
		$sql = "SELECT table_name, column_name , data_type
						FROM INFORMATION_SCHEMA.COLUMNS
						WHERE table_schema = '".DB_NAME."'
						ORDER BY table_name";
		
		$this->_setSql($sql);
		$data = $this->getAll();
		
		if (empty($data))
		{
			return false;
		}
		
		return $data;
	}
	
	
	public function save($tablename,$fields)
	{
	   
		$values="";
		$fieldNames = implode('`, `', array_keys($fields));
		foreach ($fields as $key => $value) {
            $values .=':'.$key.',';
        }
		$values =trim($values,',');
		$sql = "INSERT INTO ".$tablename."
					(`".$fieldNames."`)
 				VALUES 
 					(".$values.")";
		$sth = $this->_db->prepare($sql);
		return $sth->execute($fields);
		
	}
	public function delete($tablename)
	{
	   foreach($tablename as $row):
		$sql = "DELETE FROM $row";
		$sth = $this->_db->prepare($sql);
		$sth->execute();
	   endforeach;
	}
}