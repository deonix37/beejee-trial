<?php

class TaskEditController extends TaskFormController {
    protected const TEMPLATE = 'app/views/edit.php';

    protected const REQUIRED_FIELDS = [
        'id' => 'Id',
        'text' => 'Text',
        'username' => 'Username',
        'email' => 'Email',
        'status' => 'Status',
    ];

    protected Task $model;
    protected array $task;

    public function __construct() {
        if (!$this->checkPermission()) {
            header('Location: /login');
            exit();
        }

        parent::__construct();
        $this->model = new Task();
        $this->task = $this->findTask();
    }

    protected function checkPermission(): bool {
        return $_SESSION['user']['is_admin'] ?? false;
    }

    protected function findTask(): array {
        $task = $this->model->findById($this->safeInput['id']);

        if (!$task) {
            http_response_code(404);
            exit();
        }

        return $task;
    }

    protected function submit(): void {
        try {
            $this->model->update($this->getValidatedData());
        } catch (PDOException $e) {
            header('Location: /?error_message=' . $e->getMessage());
            exit();
        }
        header('Location: /?success_message=Successfully updated the task');
    }

    protected function getValidatedData(): array {
        return [
            'id' => $this->safeInput['id'],
            'text' => $this->safeInput['text'],
            'username' => $this->safeInput['username'],
            'email' => $this->safeInput['email'],
            'status' => $this->safeInput['status'],
            'modified_text_at' => $this->isTextModified()
                ? date('Y-m-d H:i:s') : null,
        ];
    }

    protected function isTextModified(): bool {
        return !$this->task['modified_text_at']
            && $this->safeInput['text'] !== $this->task['text'];
    }
}
