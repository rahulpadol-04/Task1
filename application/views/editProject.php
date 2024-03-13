<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Edit Project Details</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<h1 class="page-header text-center">Edit Project Details</h1>
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			<h3>Edit Project Details
				<span class="pull-right"><a href="<?php echo base_url(); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></span>
			</h3>
			<hr>
            <div class="error" style="color: red;">

                <?php echo validation_errors(); ?>

            </div>
			<form method="POST" action="<?php echo base_url(); ?>index.php/ProjectController/update/<?php echo $project['project_id']; ?>">
				<div class="form-group">
					<label>Project Code:</label>
					<input type="text" class="form-control" value="<?php echo $project['project_code']; ?>" name="project_code">
				</div>
				<div class="form-group">
					<label>Project Name:</label>
                    <input type="text" class="form-control" name="project_name" value="<?php echo $project['project_name']; ?>">
				</div>
				<div class="form-group" id="task-fields">
                    <label>Tasks:</label>
                    <?php 
                            foreach ($project['tasks'] as $task): ?>
                        <br>
                        <div class="task">
                        <input type="hidden" class="form-control" name="task_id[]" value="<?php echo $task['task_id']; ?>">
                        <label>Name:</label>
                        <input type="text" class="form-control" name="task_name[]" value="<?php echo$task['task_name']; ?>">
                        <br>
                        <label>Hours:</label>
                        <input type="text" class="form-control" name="task_hours[]" value="<?php echo$task['task_hours']; ?>">
                        <br>
                        <button type="button" class="btn btn-danger remove-task"><spanclass="glyphicon glyphicon-remove"></span> Remove</button>
                            
                        </div>
                    <?php endforeach;
                         ?>
                </div>
				<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</button>
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
        <input type="hidden" class="form-control" name="task_id[]">
        <label>Name:</label>
        <input type="text" class="form-control" name="task_name[]">
        <br>
        <label>Hours:</label>
        <input type="number" class="form-control" name="task_hours[]">
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