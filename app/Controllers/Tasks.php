<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Tasks extends BaseController
{
    // Public Welcome page
    public function today()
    {
        $taskModel = new TaskModel();

        $tasks = $taskModel
            ->where('task_date', date('Y-m-d'))
            ->where('is_archived', 0)
            ->orderBy('task_date', 'ASC')
            ->findAll();

        return view('welcome', [
            'tasks' => $tasks
        ]);
    }

    // Public Task List page
    public function index()
    {
        $taskModel = new TaskModel();

        $tasks = $taskModel
            ->where('is_archived', 0)
            ->orderBy('task_date', 'ASC')
            ->findAll();

        return view('tasks/index', [
            'tasks' => $tasks
        ]);
    }

    // Display New Task form
    public function newTask()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('tasks/new');
    }

    // Save New Task
    public function create()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $rules = [
            'title'     => 'required',
            'task_date' => 'required|valid_date[Y-m-d]'
        ];

        if (! $this->validate($rules)) {
            return view('tasks/new', [
                'validation' => $this->validator
            ]);
        }

        $taskModel = new TaskModel();

        $taskModel->insert([
            'title'       => trim($this->request->getPost('title')),
            'description' => trim($this->request->getPost('description')),
            'task_date'   => $this->request->getPost('task_date'),
            'is_archived' => 0
        ]);

        return redirect()->to('/tasks');
    }

    // Display Edit form
    public function edit($id)
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $taskModel = new TaskModel();

        $task = $taskModel
            ->where('id', $id)
            ->where('is_archived', 0)
            ->first();

        if (! $task) {
            return redirect()->to('/tasks');
        }

        return view('tasks/edit', [
            'task' => $task
        ]);
    }

    // Update Task
    public function update($id)
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $rules = [
            'title'     => 'required',
            'task_date' => 'required|valid_date[Y-m-d]'
        ];

        if (! $this->validate($rules)) {
            $taskModel = new TaskModel();

            return view('tasks/edit', [
                'task'       => $taskModel->find($id),
                'validation' => $this->validator
            ]);
        }

        $taskModel = new TaskModel();

        $taskModel
            ->where('id', $id)
            ->where('is_archived', 0)
            ->set([
                'title'       => trim($this->request->getPost('title')),
                'description' => trim($this->request->getPost('description')),
                'task_date'   => $this->request->getPost('task_date')
            ])
            ->update();

        return redirect()->to('/tasks');
    }

    // Archive Task instead of permanently deleting it
    public function delete($id)
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $taskModel = new TaskModel();

        $taskModel
            ->where('id', $id)
            ->where('is_archived', 0)
            ->set([
                'is_archived' => 1
            ])
            ->update();

        return redirect()->to('/tasks');
    }
}