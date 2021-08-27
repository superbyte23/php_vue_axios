<?php 
	class Crud extends Connection
	{		
		public function __construct(connection $conn)
		{
        	$this->conn = $conn->conn;
    	}

    	
    	public function getAllData()
    	{
    		$stmt = $this->conn->prepare("SELECT * FROM `contacts`");
    		$stmt->execute();
    		$stmt->setFetchMode(PDO::FETCH_OBJ);
    		return $stmt->fetchAll(); 
    	}

		public function getSingleData($id)
    	{
    		$stmt = $this->conn->prepare("SELECT * FROM `contacts` WHERE `id` = :id");
    		$stmt->bindParam(':id', $id); 
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			return $stmt->fetch(); 
    	}
		public function deleteSingleData($id)
    	{
    		$stmt = $this->conn->prepare("DELETE FROM `contacts` WHERE `id` = :id");
    		$stmt->bindParam(':id', $id); 
			$stmt->execute();
			if ($stmt->rowCount()>0) {
				return ['msg'=> 'Data deleted successfully'];
			}
    	}
		
		public function insertData($request)
    	{
    		foreach ($_POST as $key => $value) {
		      if (!$value || $value == "") {
		        return ['msg'=> 'Please fill in required inputs']; 
		        die();
		      }
		    }
    		$stmt = $this->conn->prepare("insert into contacts (name, email, city, country, job) values (:name, :email, :city, :country, :job)");
    		$stmt->bindParam(':name', $request["name"]);
		    $stmt->bindParam(':email', $request["email"]);
		    $stmt->bindParam(':country', $request["country"]);
		    $stmt->bindParam(':city', $request["city"]);
		    $stmt->bindParam(':job', $request["job"]); 
			$stmt->execute();
			if ($stmt->rowCount()>0) {
				return ['msg'=> 'Success'];
			}
    	}
		public function updateData($request)
    	{
    		foreach ($_POST as $key => $value) {
		      if (!$value || $value == "") {
		        return ['msg'=> 'Please fill in required inputs']; 
		        die();
		      }
		    }
    		$stmt = $this->conn->prepare("UPDATE `contacts` SET `name`=:name, `email`= :email, `city`=:city, `country`= :country, `job`=:job WHERE `id` = :id");
    		$stmt->bindParam(':id', $request["id"]);
    		$stmt->bindParam(':name', $request["name"]);
		    $stmt->bindParam(':email', $request["email"]);
		    $stmt->bindParam(':country', $request["country"]);
		    $stmt->bindParam(':city', $request["city"]);
		    $stmt->bindParam(':job', $request["job"]); 
			$stmt->execute();
			if ($stmt->rowCount()>0) {
				return ['msg'=> 'Successfully Updated'];
			}
    	}

	} 
 
		