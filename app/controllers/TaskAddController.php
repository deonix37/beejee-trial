<?php

class TaskAddController extends TaskFormController {
    protected const TEMPLATE = 'app/views/add.php';

    protected const REQUIRED_FIELDS = [
        'text' => 'Text',
        'username' => 'Username',
        'email' => 'Email',
    ];

    protected function submit(): void {
        try {
            (new Task())->create($this->getValidatedData());
        } catch (PDOException $e) {
            header('Location: /?error_message=Failed to add a new task');
            exit();
        }
        header('Location: /?success_message=Successfully added a new task');
    }

    protected function getValidatedData(): array {
        return [
            'text' => $this->safeInput['text'],
            'username' => $this->safeInput['username'],
            'email' => $this->safeInput['email'],
            'status' => 'In progress',
        ];
    }
}
