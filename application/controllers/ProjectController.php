<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProjectController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('ProjectModel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['projects'] = $this->ProjectModel->getAllProjects();

        $this->load->view('project_list', $data);
    }

    public function addnew()
    {
        $this->load->view('AddProject');
    }

    public function insert()
    {

        $this->form_validation->set_rules('project_code', 'Project Code', 'required|is_unique[project.PROJECT_CODE]');
        $this->form_validation->set_rules('project_name', 'Project Name', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('AddProject');
        } else {

            $project['project_code'] = $this->input->post('project_code');
            $project['project_name'] = $this->input->post('project_name');

            $query = $this->ProjectModel->insertProject($project);
            $project_id = $this->db->insert_id();

            $task_names = $this->input->post('task_name');
            $task_hours  = $this->input->post('task_hours');

            foreach ($task_names as $index => $task_name) {
                $task_data = array(
                    'project_id' => $project_id,
                    'task_name' => $task_name,
                    'task_hours' => $task_hours[$index]
                );
                // print_r($task_data);die;
              $this->ProjectModel->insertTask($task_data);
            
            }

            if ($query) {
                header('location:' . base_url() . $this->index());
            }
        }
    }

    public function edit($id)
    {
        $data['project'] = $this->ProjectModel->getProject($id);        
        // echo "<pre>";
        // print_r($data['project']);die;
        $this->load->view('editProject', $data);
    }

    public function update($id)
    {   
        $this->form_validation->set_rules('project_code', 'Project Code', 'required');
        $this->form_validation->set_rules('project_name', 'Project Name', 'required');

        if ($this->form_validation->run() == FALSE) {

            // $this->load->view('edit/'. $id);
            redirect('index.php/ProjectController/edit/' . $id);

        } else {

            $project['project_code'] = $this->input->post('project_code');
            $project['project_name'] = $this->input->post('project_name');
            $query = '';
            $query = $this->ProjectModel->updateProject($project, $id);
            
            $task_names = $this->input->post('task_name');
            $task_hours  = $this->input->post('task_hours');
            $task_ids  = $this->input->post('task_id');

            foreach ($task_ids as $index => $task_id) {
                $task_data = array(
                    'task_name' => $task_names[$index],
                    'task_hours' => $task_hours[$index]
                );
                // print_r($task_data);die;
                $this->ProjectModel->updateTask($task_data, $task_id);
                // echo $this->db->last_query();die;
            
            }
            
            if ($query) {
                header('location:' . base_url() . $this->index());
            }
        }
    }

    public function delete($id)
    {
        $query = $this->ProjectModel->deleteProject($id);

        if ($query) {
            header('location:' . base_url() . $this->index());
        }
    }
}
