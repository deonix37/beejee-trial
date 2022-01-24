<?php

class LoginController {
    protected const TEMPLATE = 'app/views/login.php';

    protected const REQUIRED_FIELDS = [
        'username' => 'Username',
        'password' => 'Password',
    ];

    protected array $safeInput = [];
    protected array $errors = [];

    public function __construct() {

        $this->safeInput = array_map('htmlspecialchars', $_POST);
    }

    public function get(): void {
        require_once $this::TEMPLATE;
    }

    public function post(): void {
        if ($this->validate()) {
            $user = $this->findUser();

            if ($user) {
                $_SESSION['user'] = [
                    'username' => $user['username'],
                    'is_admin' => $user['is_admin'],
                ];
                header('Location: /');
                exit();
            }

            $this->errors['password'] = 'Incorrent username or password.';
        }

        require_once $this::TEMPLATE;
    }

    protected function validate(): bool {
        foreach ($this::REQUIRED_FIELDS as $name => $title) {
            if (($this->safeInput[$name] ?? '') === '') {
                $this->errors[$name] = "$title is required.";
            }
        }

        return empty($this->errors);
    }

    protected function findUser(): mixed {
        return (new User())->find(
            $this->safeInput['username'],
            $this->safeInput['password'],
        );
    }
}
