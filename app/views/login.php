<?php ob_start() ?>
    <div class="container">
        <header class="py-5 text-center">
            <h1>Log In</h1>
        </header>
        <main class="col-sm-4 mx-auto">
            <div class="d-flex justify-content-end">
                <a class="text-decoration-none" href="/">&lt; Back</a>
            </div>
            <form method="POST" novalidate>
                <label class="d-flex flex-column">
                    <div>Username</div>
                    <input class="mt-1 px-2 py-1" name="username"
                           value="<?= $this->safeInput['username'] ?? null ?>" required>
                    <?php if (isset($this->errors['username'])): ?>
                        <div class="mt-1 small font-bold text-danger"><?= $this->errors['username'] ?></div>
                    <?php endif ?>
                </label>
                <label class="d-flex flex-column mt-3">
                    <div>Password</div>
                    <input class="mt-1 px-2 py-1" name="password" type="password" required>
                    <?php if (isset($this->errors['password'])): ?>
                        <div class="mt-1 small font-bold text-danger"><?= $this->errors['password'] ?></div>
                    <?php endif ?>
                </label>
                <div class="d-flex justify-content-center">
                    <button class="mt-4 px-5 py-2 rounded-pill bg-dark text-white">Submit</button>
                </div>
            </form>
        </main>
    </div>
<?php $content = ob_get_clean() ?>

<?php $title = 'Log In' ?>

<?php include 'layout.php' ?>
