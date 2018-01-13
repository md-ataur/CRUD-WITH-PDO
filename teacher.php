<?php
spl_autoload_register(function($class){
	include "classes/".$class.".php";
});

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<style type="text/css">
		.table td, .table th{padding:7px 0;}
		td {padding: 0 10px 8px 0;}
	</style>
</head>
<body>
	<div class="container mt-5">
		<div style="display: flow-root;border-bottom: 1px solid #ddd; padding: 0 0 8px;" class="col-sm-12">
			<div class="float-left">CRUD WITH PDO</div>
			<div class="float-right"><span><a href="index.php">For Students</a></span> || <a href="teacher.php">For Teachers</a></span></div>
		</div>
		<br>
		<div style="display: flow-root;">
			
			<?php
				$user = new Teacher();
				if(isset($_POST['submited'])){
					$name  = $_POST['name'];
					$dep   = $_POST['dep'];
					$age   = $_POST['age'];
					
					$user->setName($name);
					$user->setDep($dep);
					$user->setAge($age);

					if($user->insert()){
						echo "<p style='color:green;'>Successfully Data Insert </p>";
					}
				} // data insert 

				if(isset($_POST['update'])){
					$id    = $_POST['id'];
					$name  = $_POST['name'];
					$dep   = $_POST['dep'];
					$age   = $_POST['age'];
					
					$user->setName($name);
					$user->setDep($dep);
					$user->setAge($age);

					if($user->update($id)){
						echo "<p style='color:green;'>Successfully Data Updated </p>";
					}
				} // data update 
			?> 

			<?php
				if(isset($_GET['action']) && $_GET['action'] == "delete"){
					$id = (int) $_GET['id'];
					if($user->delete($id)){
						echo "<p style='color:red;'>Successfully Data Deleted </p>";
					}
				}
			?> <!-- data delete by id -->
			
			<?php
				if(isset($_GET['action']) && $_GET['action'] == "edit") {
					$id = (int)$_GET['id'];
					$result = $user->readById($id);
			?> <!-- data read by id -->

			

			<div style="padding: 0; margin: 0 0 26px;" class="col-sm-4 float-left">
				<form action="" method="post">
					<input type="hidden" class="form-control" value="<?php echo $result['id']?>" name="id">
					<table>
						<tr>
							<td>Name:</td>
							<td><input type="text" class="form-control" value="<?php echo $result['name']?>" name="name"></td>
						</tr>
						<tr>
							<td>Dep:</td>
							<td><input type="text" class="form-control" value="<?php echo $result['dep']?>" name="dep"></td>
						</tr>
						<tr>
							<td>Age:</td>
							<td><input type="text" class="form-control" value="<?php echo $result['age']?>" name="age"></td>
						</tr>
						<tr>
							<td></td>
							<td><input class="btn btn-primary" type="submit" value="Submit" name="update"></td>
						</tr>
					</table>
				</form>	
			</div>
		

			<?php } else { ?>
			
			<div style="padding: 0; margin: 0 0 26px;" class="col-sm-4 float-left">
				<form action="" method="post">	
					<table>
						<tr>
							<td>Name:</td>
							<td><input type="text" class="form-control" required name="name"></td>
						</tr>
						<tr>
							<td>Dep:</td>
							<td><input type="text" class="form-control" required name="dep"></td>
						</tr>
						<tr>
							<td>Age:</td>
							<td><input type="text" class="form-control" required name="age"></td>
						</tr>
						<tr>
							<td></td>
							<td><input class="btn btn-primary" type="submit" value="Submit" name="submited"></td>
						</tr>
					</table>
				</form>	
			</div>
			
			<?php }?>

			<div style="padding: 0;" class="col-sm-8 float-right">
				<table style="text-align: center;" class="table table-bordered table-hover">
					
					<tr>
						<td>No</td>
						<td>Name</td>
						<td>Department</td>
						<td>Age</td>
						<td>Action</td>
					</tr>
					<?php
						$i = 0;
						foreach ($user->dataAll() as $value) {
						$i++;	
					?>
					<tr>
						<td><?php echo $value['id']?></td>
						<td><?php echo $value['name']?></td>
						<td><?php echo $value['dep']?></td>
						<td><?php echo $value['age']?></td>
						<td>
							<span>
								<?php echo "<a href='teacher.php?action=edit&id=".$value['id']."'>Edit</a>"?>
							</span> || 
							<span>
								<?php echo "<a href='teacher.php?action=delete&id=".$value['id']."' onClick='return confirm(\"Are you sure to delete data\")'>Delete</a>"?>
							</span>
						</td>
					</tr>
					<?php 
						} 
					?>
				</table>
			</div>
		</div>		
	</div>
</body>
</html>