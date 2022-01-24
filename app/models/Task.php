<?php

class Task extends BaseModel {
    public const STATUS_COMPLETED = 'Completed';
    public const STATUS_IN_PROGRESS = 'In progress';

    protected string $table = 'task';

    public function findById(int $id): mixed {
        $stmt = $this->db->prepare(
            "SELECT `id`, `username`, `email`, `text`, `status`, `modified_text_at`
            FROM $this->table
            WHERE `id` = :id"
        );
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function get(
        string $orderField = 'id',
        string $orderDirection = 'ASC',
        ?int $limit = null,
        int $offset = 0,
    ): array {
        $limit = $limit ?? 'NULL';

        $stmt = $this->db->prepare(
            "SELECT
                `id`, `username`, `email`, `text`, `status`, `modified_text_at`
            FROM $this->table
            ORDER BY `$orderField` $orderDirection
            LIMIT :limit OFFSET :offset;",
        );
        $stmt->bindParam('limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam('offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool {
        return $this->db->prepare(
            "INSERT INTO $this->table (`username`, `email`, `text`, `status`)
            VALUES (:username, :email, :text, :status);",
        )->execute($data);
    }

    public function update(array $data): bool {
        $stmt = $this->db->prepare(
            "UPDATE task
            SET `username` = :username,
                `email` = :email,
                `text` = :text,
                `status` = :status,
                `modified_text_at` = :modified_text_at
            WHERE `id` = :id;",
        );
        $stmt->bindParam('username', $data['username']);
        $stmt->bindParam('email', $data['email']);
        $stmt->bindParam('text', $data['text']);
        $stmt->bindParam('status', $data['status']);
        $stmt->bindParam('modified_text_at', $data['modified_text_at']);
        $stmt->bindParam('id', $data['id'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function count(): int {
        return $this->db->query("SELECT COUNT(*) FROM $this->table;")
            ->fetchColumn();
    }
}
