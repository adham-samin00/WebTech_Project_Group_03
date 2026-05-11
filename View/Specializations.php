<?php
    include "../Controller/SpecilizationController.php";
    $action= $_GET["action"] ?? "list";
    $edit_id = $_GET["id"]??"";
    $edit_data = $_GET["data"]??"";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Specializations</title>
</head>
<body>
    <nav class="navbar">
        <a href="AdminPanel.php" class = "navbar-logo">CareCraft</a>
        <ul>
            <li><a href="AdminPanel.php">Users</a></li>
            <li><a href="Specializations.php">Specialization</a></li>
            <li><a href="AdminDoctorDashboard.php">Doctors</a></li>
        </ul>
        <a href="../Controller/Logout.php" class = "logout-btn">Logout</a>
    </nav>
    <div class ="page-toprow">
        <div>
            <h1 class="title">Specializations</h1>
            <p class="subtitle">Manage medical specializations for doctor profiles</p>
        </div>
        <?php if($action != "add" && $action != "edit"){ ?>
            <a href="Specializations.php?action=add" class="btn-add">Add Specialization</a>
        <?php } ?>
    </div>
    <?php if(!empty($error)){ ?>
        <div class = "error-alert"><?php echo $error ?></div>
    <?php } ?>
    <?php if($action == "add"){?>
        <div class = "add_form">
            <p class ="form-title">Add New Specilization</p>
            <form method = "post" action="">
                <input type="hidden" name = "action" value = "create">
                <div class="form-group">
                    <label for="name">Specilization Name</label>
                    <input type="text" id = "name" name = "name" placeholder = "e.g. Cardiology" required>
                </div>
                <div class = "form-actions">
                    <input type="submit" class="btn-add" value ="Save">
                    <a href="Specializations.php" class="btn-cancel-link">Cancel</a>
                </div>
            </form>
        </div>
    <?php } ?>
    <?php if($action == "edit" && $edit_id){?>
        <div class = "add_form">
            <p class ="form-title">Edit Specilization</p>
            <form method = "post" action="">
                <input type="hidden" name = "action" value = "update">
                <input type="hidden" name = "id" value = "<?php echo $edit_id ?>">
                <div class="form-group">
                    <label for="name">Specilization Name</label>
                    <input type="text" id = "name" name = "name" value = "<?php echo $edit_data ?>" required>
                </div>
                <div class = "form-actions">
                    <input type="submit" class="btn-add" value ="Update">
                    <a href="Specilizations.php" class="btn-cancel-link">Cancel</a>
                </div>
            </form>
        </div>
    <?php } ?>

    <?php
        require_once("../Model/Specilizationdb.php");
        $specilizations = getAllSpecializations();
    ?>

    <div class = "table-wraper">
        <thead>
            <tr>
                <th>ID</th>
                <th>Specilization</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($specilizations as $Sp){ ?>
                <td><? $sp["id"] ?></td>
                <td><? $sp["specilization"] ?></td>
                <td>
                    <div class = "action-buttons">
                        <a href="Specializations.php?action=edit&id= <?php echo $sp["id"] ?>&data=<?php echo $sp["specilization"] ?>" class = "btn-edit">Edit</a>
                        <a href="../Controller/SpecilizationController.php?action=delete&id=<?php echo $Sp["id"] ?>&data=<?php echo $sp["specilization"] ?>" class = "btn-delete" onclick ="return confirm('Are you Sure?');" >Delete</a>
                    </div>
                </td>
            <?php } ?>
        </tbody>
    </div>
</body>
</html>