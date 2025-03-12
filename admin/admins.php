<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Admins
                <a href="admins-create.php" class="btn btn-outline-success float-end">Add Admin</a>
                <a href="index.php" class="btn btn-outline-danger float-end" style="margin-right:15px;">Back</a>               
            </h4>
        </div>
        <div class="card-body px-3 mt-3"> <!-- Corrected class name -->
            <?php alertMessage(); ?>

            <?php
            $admins = getAll('admins');
            if ($admins === false) { // Check if fetching admins failed
                echo '<h4>Something Went Wrong!</h4>';
            } elseif (mysqli_num_rows($admins) > 0) {
            ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($admins as $adminItem) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($adminItem['id']); ?></td>
                                    <td><?= htmlspecialchars($adminItem['name']); ?></td>
                                    <td><?= htmlspecialchars($adminItem['email']); ?></td>
                                    <td>
                                        <a href="admins-edit.php?id=<?= htmlspecialchars($adminItem['id']); ?>" class="btn btn-outline-primary btn-sm">Update</a>
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
