<?php 

require_once '../config/config.php';
require_once '../Model/Crud.php';

$conn = new Connection;
$crud = new Crud($conn);

// $method = $_SERVER['REQUEST_METHOD'];

switch ($_SERVER['REQUEST_METHOD']) {
	case 'GET':
		if (isset($_GET['ID'])) {
			echo json_encode($crud->getSingleData($_GET["ID"]));
		}elseif(isset($_GET['destroy'])){
			echo json_encode($crud->deleteSingleData($_GET["destroy"])); 
		}else{
			echo json_encode($crud->getAlldata());		
		}		 
		break;
	case 'POST':
		if (isset($_POST['submit'])) {
			echo json_encode($crud->insertData($_POST));
		}elseif (isset($_POST['update'])) {
			echo json_encode($crud->updateData($_POST));
		}
		break; 
	default:
		# code...
		break;
}

?>