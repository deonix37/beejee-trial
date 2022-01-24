<?php ob_start() ?>
    <div class="container">
        <header class="py-5 text-center">
            <h1>Edit task</h1>
        </header>
        <main class="col-6 mx-auto">
            <div class="d-flex justify-content-end">
                <a class="text-decoration-none" href="/">&lt; Back</a>
            </div>
            <form method="POST" novalidate>
                <input name="id" type="hidden" value="<?= $this->safeInput['id'] ?? null ?>">
                <label class="d-flex flex-column">
                    <div>Text</div>
                    <textarea class="mt-1 px-2 py-1" name="text"
                              rows="5" required><?= $this->safeInput['text'] ?? $this->task['text'] ?></textarea>
                    <?php if (isset($this->errors['text'])): ?>
                        <div class="mt-1 small text-danger"><?= $this->errors['text'] ?></div>
                    <?php endif ?>
                </label>
                <label class="d-flex flex-column mt-3">
                    <div>Username</div>
                    <input class="mt-1 px-2 py-1" name="username" required
                           value="<?= $this->safeInput['username'] ?? $this->task['username'] ?>">
                    <?php if (isset($this->errors['username'])): ?>
                        <div class="mt-1 small text-danger"><?= $this->errors['username'] ?></div>
                    <?php endif ?>
                </label>
                <label class="d-flex flex-column mt-3">
                    <div>Email</div>
                    <input class="mt-1 px-2 py-1" name="email" type="email" required
                           value="<?= $this->safeInput['email'] ?? $this->task['email'] ?>">
                    <?php if (isset($this->errors['email'])): ?>
                        <div class="mt-1 small text-danger"><?= $this->errors['email'] ?></div>
                    <?php endif ?>
                </label>
                <div class="mt-3">
                    <div>Status</div>
                    <?php foreach ($this::TASK_STATUSES as $value => $title): ?>
                        <label class="d-flex align-items-center">
                            <input name="status" type="radio" value="<?= $value ?>"
                                   <?= ($this->safeInput['status'] ?? $this->task['status']) === $value ? 'checked' : '' ?>>
                            <div class="ms-2"><?= $title ?></div>
                        </label>
                    <?php endforeach ?>
                    <?php if (isset($this->errors['status'])): ?>
                        <div class="mt-1 small text-danger"><?= $this->errors['status'] ?></div>
                    <?php endif ?>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="mt-4 px-5 py-2 rounded-pill bg-dark text-white">Submit</button>
                </div>
            </form>
        </main>
    </div>
<?php $content = ob_get_clean() ?>

<?php $title = 'Edit task' ?>

<?php include 'layout.php' ?>
