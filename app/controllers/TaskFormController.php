<?php

abstract class TaskFormController {
    protected const TEMPLATE = '';

    protected const REQUIRED_FIELDS = [];
    protected const TASK_STATUSES = [
        'Completed' => 'Completed',
        'In progress' => 'In progress',
    ];

    protected array $safeInput = [];
    protected array $errors = [];

    public function __construct() {
        $this->safeInput = array_map('htmlspecialchars', $_REQUEST);
    }

    public function get(): void {
        require_once $this::TEMPLATE;
    }

    public function post(): void {
        if ($this->validate()) {
            $this->submit();
        } else {
            require_once $this::TEMPLATE;
        }
    }

    protected function validate(): bool {
        if (!filter_var($this->safeInput['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email must be a valid email address.";
        }

        if (strlen($this->safeInput['username'] ?? '') > 255) {
            $this->errors['username'] = 'Username must not be greater than 255 characters.';
        }

        if (strlen($this->safeInput['text'] ?? '') > 1000) {
            $this->errors['text'] = 'Text must not be greater than 1000 characters.';
        }

        foreach ($this::REQUIRED_FIELDS as $name => $title) {
            if (($this->safeInput[$name] ?? '') === '') {
                $this->errors[$name] = "$title is required.";
            }
        }

        return empty($this->errors);
    }

    abstract protected function getValidatedData(): array;

    abstract protected function submit(): void;
}
