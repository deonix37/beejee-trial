<?php ob_start() ?>
    <div class="container">
        <header class="py-5 text-center">
            <h1>Tasks</h1>
        </header>
        <main class="row">
            <form class="col-md-3 border-end">
                <div>
                    <div class="fw-bold">Sort by</div>
                    <div class="mt-2 d-flex flex-column">
                        <?php foreach ($this::SORTING_FIELDS as $value => $title): ?>
                            <label>
                                <input type="radio" name="sorting" value="<?= $value ?>"
                                       <?= $this->safeInput['sorting'] === $value ? 'checked' : '' ?>>
                                <?= $title ?>
                            </label>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="mt-2 pt-2 border-top">
                    <div class="fw-bold">Sorting order</div>
                    <div class="mt-2 d-flex flex-column">
                        <?php foreach ($this::SORTING_ORDERS as $value => $title): ?>
                            <label>
                                <input type="radio" name="sorting_order" value="<?= $value ?>"
                                       <?= $this->safeInput['sorting_order'] === $value ? 'checked' : '' ?>>
                                <?= $title ?>
                            </label>
                        <?php endforeach ?>
                    </div>
                </div>
                <button class="mt-3 px-4 py-1 rounded-pill bg-dark text-white">Apply</button>
            </form>
            <div class="col mt-3 mt-md-0">
                <div class="d-flex justify-content-between">
                    <div>
                        <?php if (isset($_SESSION['user'])): ?>
                            <span><?= $_SESSION['user']['username'] ?></span>
                            <form class="d-inline-block" action="/logout" method="POST">
                                <button class="border-0 bg-white text-primary">Log Out</button>
                            </form>
                        <?php else: ?>
                            <a class="text-decoration-none" href="/login">Log In</a>
                        <?php endif; ?>
                    </div>
                    <a class="text-decoration-none" href="/add">+ Add new</a>
                </div>
                <?php if ($this->safeInput['success_message'] ?? null): ?>
                    <div class="mt-2 py-2 px-3 rounded-3 bg-success bg-opacity-25 text-success fw-bold">
                        <?= $this->safeInput['success_message'] ?>
                    </div>
                <?php elseif ($this->safeInput['error_message'] ?? null): ?>
                    <div class="mt-2 py-2 px-3 rounded-3 bg-danger bg-opacity-25 text-danger fw-bold">
                        <?= $this->safeInput['error_message'] ?>
                    </div>
                <?php endif; ?>
                <div class="mt-2">
                    <?php foreach ($tasks as $task): ?>
                        <div class="mb-4 p-3 rounded-3 bg-light">
                            <p><?= nl2br($task['text']) ?></p>
                            <?php if ($task['modified_text_at']): ?>
                                <p class="text-secondary">Modified by admin</p>
                            <?php endif; ?>
                            <div class="row pt-3 border-top">
                                <div class="col d-flex flex-column">
                                    <div>
                                        Status:
                                        <span class="<?= $task['status'] === Task::STATUS_COMPLETED
                                                        ? 'text-success' : 'text-secondary' ?>">
                                            <?= $task['status'] ?>
                                        </span>
                                    </div>
                                    <div class="mt-2">
                                        <?php if ($_SESSION['user']['is_admin'] ?? false): ?>
                                            <a class="text-decoration-none"
                                               href="/edit?id=<?= $task['id'] ?>">Edit</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col d-flex flex-column text-end">
                                    <div>User: <span class="text-secondary"><?= $task['username'] ?></span></div>
                                    <div>Email: <span class="text-secondary"><?= $task['email'] ?></span></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="d-flex justify-content-center">
                    <?php foreach (range(1, $totalPageCount) as $page): ?>
                        <div class="fs-5">
                            <?php if ($page == $this->safeInput['page']): ?>
                                <span class="p-3 w-100"><?= $page ?></span>
                            <?php else: ?>
                                <a class="p-3 w-100 text-decoration-none"
                                   href="<?= $this->getPageUrl($page) ?>">
                                    <?= $page ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </main>
    </div>
<?php $content = ob_get_clean() ?>

<?php $title = 'Tasks' ?>

<?php include 'layout.php' ?>
