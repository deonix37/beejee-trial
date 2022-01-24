<?php

class TaskController {
    protected const TEMPLATE = 'app/views/index.php';
    protected const PAGE_LIMIT = 3;

    protected const SORTING_FIELDS = [
        'created_at' => 'Date added',
        'username' => 'Username',
        'email' => 'Email',
        'status' => 'Status',
    ];
    protected const SORTING_ORDERS = [
        'ASC' => 'Ascending',
        'DESC' => 'Descending',
    ];
    protected const FIELDS_DEFAULTS = [
        'sorting' => 'created_at',
        'sorting_order' => 'DESC',
        'page' => 1,
    ];

    protected array $safeInput = [];
    protected Task $model;

    public function __construct() {
        $this->model = new Task();
        $this->safeInput = array_map('htmlspecialchars', $_REQUEST);

        foreach ($this::FIELDS_DEFAULTS as $field => $default) {
            $this->safeInput[$field] = $this->safeInput[$field] ?? $default;
        }
    }

    public function get(): void {
        $tasks = $this->getTasks();
        $totalTaskCount = $this->model->count();
        $totalPageCount = ceil($totalTaskCount / $this::PAGE_LIMIT);

        require_once $this::TEMPLATE;
    }

    public function getPageUrl(int $page): string {
        $queryString = array_map(
            function ($param) {
                return "$param=" . htmlspecialchars($_GET[$param]);
            },
            array_diff(array_keys($_GET), ['page']),
        );

        return "/?page=$page&" . implode('&', $queryString);
    }

    protected function getTasks(): array {
        $pageValid = ((int) $this->safeInput['page']) > 0;
        $sortingValid = in_array(
            $this->safeInput['sorting'],
            array_keys($this::SORTING_FIELDS),
        );
        $sortingOrderValid = in_array(
            $this->safeInput['sorting_order'],
            array_keys($this::SORTING_ORDERS),
        );

        if ($pageValid) {
            $offset = ($this->safeInput['page'] - 1) * $this::PAGE_LIMIT;
        } else {
            $offset = 0;
        }

        if ($sortingValid) {
            $sorting = $this->safeInput['sorting'];
        } else {
            $sorting = $this::FIELDS_DEFAULTS['sorting'];
        }

        if ($sortingOrderValid) {
            $sortingOrder = $this->safeInput['sorting_order'];
        } else {
            $sortingOrder = $this::FIELDS_DEFAULTS['sorting_order'];
        }

        return $this->model->get(
            $sorting, $sortingOrder, $this::PAGE_LIMIT, $offset,
        );
    }
}
