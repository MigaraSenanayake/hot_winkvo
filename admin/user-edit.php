<?php include('includes/header.php'); ?>

<div class="container-fluid px-3">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit User
                <a href="users.php" class="btn btn-outline-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card_body px-3 mt-2">
            <?php alertMessage(); ?>

            <form action="code.php" method="POST">

                <?php
                if (isset($_GET['id'])) {
                    $userId = trim($_GET['id']);
                    if (!empty($userId)) {
                        $userData = getById('users', $userId);

                        if ($userData && $userData['status'] == 200) {
                            $user = $userData['data'];
                        } else {
                            echo '<h5>' . htmlspecialchars($userData['message']) . '</h5>';
                            return false;
                        }
                    } else {
                        echo '<h5>Id Not Found</h5>';
                        return false;
                    }
                } else {
                    echo '<h5>Id Not given in parameters</h5>';
                    return false;
                }
                ?>

                <!-- Hidden input to store user ID -->
                <input type="hidden" name="userId" value="<?= htmlspecialchars($user['id']); ?>">

                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label for="name">Name *</label>
                        <input type="text" name="name" required value="<?= htmlspecialchars($user['name']); ?>" class="form-control" />
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required value="<?= htmlspecialchars($user['email']); ?>" class="form-control" />
                        <span id="email-message" class="validation-message"></span> 
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="phone">Phone Number *</label>
                        <input type="number" name="phone" required value="<?= htmlspecialchars($user['phone']); ?>" class="form-control" />
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Leave blank if not changing" />
                        <div id="password-message" class="validation-message"></div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="conf_password">Conf. Password</label>
                        <input type="password" id="confirm-password" name="conf_password" class="form-control" placeholder="Leave blank if not changing" />
                        <div id="confirm-password-message" class="validation-message"></div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="user_section">User Section *</label>
                        <select name="user_section" class="form-select" required>                            
                            <option <?= (isset($user['user_section']) && $user['user_section'] == 'Front Office') ? 'selected' : ''; ?>>Front Office</option>
                            <!-- <option <?= (isset($user['user_section']) && $user['user_section'] == 'Restaurant') ? 'selected' : ''; ?>>Restaurant</option> -->
                            <option <?= (isset($user['user_section']) && $user['user_section'] == 'Finance') ? 'selected' : ''; ?>>Finance</option>
                            <!-- <option <?= (isset($user['user_section']) && $user['user_section'] == 'Kitchen') ? 'selected' : ''; ?>>Kitchen</option> -->
                        </select>
                    </div>

                    <div class="col-md-12 mb-4 text-end">
                        <button type="submit" name="updateUser" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="form_validation.js"></script>
<link rel="stylesheet" href="styles.css">

<?php include('includes/footer.php'); ?>
