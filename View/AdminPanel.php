<?php
include "../Controller/AdminController.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - MediBook</title>
    <script src="../Controller/JS/ToggleActive.js"></script>
</head>

<body>

    <div class="topnav">
        <a href="AdminPanel.php" class="sitename">+<span>Medi</span>Book</a>
        <div class="nav-right">
            <p>Admin: <?php echo htmlspecialchars($_SESSION["name"]); ?></p>
            <a href="../Controller/Logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <div class="main-area">

        <h2>User Management</h2>
        <p class="page-desc">View all users and manage their account status</p>

        <table class="user-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Registered</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = $users->fetch_assoc()) {
                    $is_active  = $row["is_active"];
                    $btn_label  = $is_active ? "Deactivate" : "Activate";
                    $btn_class  = $is_active ? "btn-off" : "btn-on";
                    $badge_text = $is_active ? "Active" : "Inactive";
                    $badge_cls  = $is_active ? "badge-active" : "badge-inactive";
                    $created    = date("d M Y", strtotime($row["created_at"]));
                    $user_id    = $row["id"];
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo htmlspecialchars($row["name"]); ?></td>
                        <td><?php echo htmlspecialchars($row["email"]); ?></td>
                        <td><span class="badge-role"><?php echo htmlspecialchars($row["role"]); ?></span></td>
                        <td><span class="<?php echo $badge_cls; ?>"><?php echo $badge_text; ?></span></td>
                        <td><?php echo $created; ?></td>
                        <td>
                            <button class="<?php echo $btn_class; ?>" onclick="toggleActive(<?php echo $user_id; ?>, this)">
                                <?php echo $btn_label; ?>
                            </button>
                        </td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>

    </div>

</body>

</html>