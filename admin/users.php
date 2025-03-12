<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Users
                <a href="user-create.php" class="btn btn-outline-success float-end">Add User</a>                
            </h4>
        </div>
        <div class="card-body px-3 mt-3"> <!-- Corrected class name -->
            <?php alertMessage(); ?>

            <?php
            $user = getAll('users');
            if ($user === false) { // Check if fetching users failed
                echo '<h4>Something Went Wrong!</h4>';
            } elseif (mysqli_num_rows($user) > 0) {
            ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Section</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user as $userItem) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($userItem['id']); ?></td>
                                    <td><?= htmlspecialchars($userItem['name']); ?></td>
                                    <td><?= htmlspecialchars($userItem['email']); ?></td>
                                    <td><?= htmlspecialchars($userItem['user_section']); ?></td>
                                    <td>
                                        <a href="user-edit.php?id=<?= htmlspecialchars($userItem['id']); ?>" class="btn btn-outline-primary btn-sm">Update</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php
            } else {
                echo '<h4 class="mb-0">Record Not Found</h4>';
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
