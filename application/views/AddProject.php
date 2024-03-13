<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Task</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<h1 class="page-header text-center">Task</h1>
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			<h3>Add Project
				<span class="pull-right"><a href="<?php echo base_url(); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></span>
			</h3>
			<hr>
            
            <div class="error" style="color: red;">

                <?php echo validation_errors(); ?>

            </div>
			<form method="POST" action="<?php echo base_url(); ?>index.php/ProjectController/insert">
				<div class="form-group">
					<label>Project Code:</label>
					<input type="text" class="form-control" name="project_code">
				</div>
				<div class="form-group">
					<label>Project Name:</label>
					<input type="text" class="form-control" name="project_name">
				</div>
				<hr>
				<div class="form-group" id="task-fields">
					<label>Tasks Details:</label>
					<div class="task">
					<label>Task Name:</label>
						<input type="text" class="form-control" name="task_name[]">
					<label>Hours:</label>
						<input type="number" class="form-control" name="task_hours[]">
					</div>
				</div>
				<button type="button" class="btn btn-success" id="add-task"><span class="glyphicon glyphicon-plus"></span> Add Task</button>
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
			</form>
		</div>
	</div>
</div>
<script>
		document.getElementById('add-task').addEventListener('click', function() {
			var taskFields = document.getElementById('task-fields');
			var taskDiv = document.createElement('div');
			taskDiv.className = 'task';
			taskDiv.innerHTML = `
				<label>Task Name:</label>
				<input type="text" class="form-control" name="task_name[]">
				<label>Hours:</label>
				<input type="number" class="form-control" name="task_hours[]">
				<br>
				<button type="button" class="btn btn-danger remove-task"><span class="glyphicon glyphicon-remove"></span> Remove</button>
			`;
			taskFields.appendChild(taskDiv);
		});

		document.addEventListener('click', function(event) {
			if (event.target && event.target.className === 'btn btn-danger remove-task') {
				event.target.parentNode.remove();
			}
		});
</script>

</body>
</html>

