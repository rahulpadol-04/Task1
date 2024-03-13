<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>View Project Details</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
	
</head>
<body>
<div class="container">
	<h1 class="page-header text-center">View Project Details</h1>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<a href="<?php echo base_url(); ?>index.php/ProjectController/addnew" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add New</a><br><br>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Project Code</th>
						<th>Project Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($projects as $project){
						?>
						<tr>
							<!-- <td><?php echo $project->id; ?></td> -->
							<td><?php echo $project['project_code']; ?></td>
							<td><?php echo $project['project_name']; ?></td>
							
							<td><a href="<?php echo base_url(); ?>index.php/ProjectController/edit/<?php echo $project['project_id']; ?>" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> Edit</a> || <a href="<?php echo base_url(); ?>index.php/ProjectCOntroller/delete/<?php echo $project['project_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a></td>
						</tr>
						
						<?php
							foreach($project['tasks'] as $task){
						?>
							<tr>
								<td></td>
								<td><?= $task['task_name'] . ' – ' . $task['task_hours'] . ' hours' ?></td>
								<td></td>
							</tr>
							<!-- end of task loop -->
							<?php } ?>	
							<!-- end of project loop -->
						<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</body>
</html>