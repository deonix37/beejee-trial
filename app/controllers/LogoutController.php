<?php

class LogoutController {
    public function post(): void {
        unset($_SESSION['user']);
        header('Location: /');
    }
}
