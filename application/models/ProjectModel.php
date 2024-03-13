<?php
	class ProjectModel extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		// public function getAllProjects(){
		// 	$query = $this->db->get('project');
		// 	return $query->result(); 
		// }

		public function getAllProjects(){
			$query = $this->db->select('project.ID,project.PROJECT_CODE, project.PROJECT_NAME, task.TASK_NAME, task.TASK_HOURS')
                          ->from('project')
                          ->join('task', 'project.ID = task.PROJECT_ID', 'left')
                          ->order_by('project.ID')
                          ->order_by('task.ID')
                          ->get();

			$projects = array();

			foreach ($query->result_array() as $row) {
				$project_id = $row['ID'];
				
				if (!isset($projects[$project_id])) {
					$projects[$project_id] = array(
						'project_id' => $project_id,
						'project_code' => $row['PROJECT_CODE'],
						'project_name' => $row['PROJECT_NAME'],
						'tasks' => array()
					);
				}
				if (!empty($row['TASK_HOURS'])) {
					$projects[$project_id]['tasks'][] = array(
						'task_name' => $row['TASK_NAME'],
						'task_hours' => $row['TASK_HOURS']
					);
				}
			}
					// echo $this->db->last_query();die;
        return $projects;
		}

		public function getProject($project_id) {

			$query = $this->db->select('project.*, task.TASK_NAME,task.ID as "task_id", task.TASK_HOURS')
							  ->from('project')
							  ->join('task', 'project.ID = task.PROJECT_ID', 'left')
							  ->where('project.ID', $project_id)
							  ->get();
		
			if ($query->num_rows() > 0) {

				$project = array();
				foreach ($query->result_array() as $row) {
					// echo "<pre>";
					// print_r($row['TASK_NAME']);die;					
					$project['project_id'] = $row['ID'];
					$project['project_code'] = $row['PROJECT_CODE'];
					$project['project_name'] = $row['PROJECT_NAME'];
					if (!empty($row['TASK_NAME'])) {
						
						$project['tasks'][] = array(
							'task_id' => $row['task_id'],
							'task_name' => $row['TASK_NAME'],
							'task_hours' => $row['TASK_HOURS']
						);
					}
				}
				
				return $project;
			} else {
				
				return null;
			}
		}
		public function insertProject($project){
			return $this->db->insert('project', $project);
		}
		public function insertTask($tasks){

			return $this->db->insert('task', $tasks);
		}

		public function updateProject($project, $id){
			$this->db->where('project.ID', $id);
			return $this->db->update('project', $project);
		}

		public function updateTask($task, $id){
			$this->db->where('task.ID', $id);
			return $this->db->update('task', $task);
			
		}

		public function deleteProject($id){
			$this->db->where('project.ID', $id);
			return $this->db->delete('project');
		}

	}
?>