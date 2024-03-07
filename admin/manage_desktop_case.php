<?php
include './partials/header.php';

// Fetch desktop_cases
$query = "SELECT * FROM desktop_case ORDER BY desktop_case_name";
$desktop_cases = mysqli_query($connection, $query);

$brand;
$brand_id;
?>

<main>
    <div class="bg-dark text-center d-flex flex-column justify-content-center" style="height: 25vh;">
        <h3 class="text-secondary fw-bold fs-1">Manage Desktop Case</h3>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-warning justify-content-center">
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>" class="text-warning">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>admin" class="text-warning">Admin</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">Manage Desktop Case</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5">
        <div class="row p-4 rounded shadow-lg">
            <div class="col-md-6 ">
                <h3>Desktop Cases</h3>
            </div>
            <a class="col-md-6 btn btn-dark px-4" href="./add_desktop_case.php">Add new Desktop Case</a>
        </div>

        <!-- alet message -->
        <?php if (isset($_SESSION['delete-desktop_case'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['delete-desktop_case'];
                    unset($_SESSION['delete-desktop_case']); ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['delete-desktop_case-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['delete-desktop_case-success'];
                    unset($_SESSION['delete-desktop_case-success']); ?>
                </p>
            </div>
        <?php endif ?>
        <!-- alet message -->
        <?php if (isset($_SESSION['add-desktop_case-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['add-desktop_case-success'];
                    unset($_SESSION['add-desktop_case-success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['edit-desktop_case-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['edit-desktop_case-success'];
                    unset($_SESSION['edit-desktop_case-success']); ?>
                </p>
            </div>
        <?php endif ?>
        <!-- alert message end -->
        <?php if (mysqli_num_rows($desktop_cases) > 0) : ?>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Name</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($desktop_case = mysqli_fetch_assoc($desktop_cases)) : ?>
                        <tr class="align-middle">
                            <!-- fetch brand with id -->
                            <?php
                            $brand_id = $desktop_case['brand'];
                            $query = "SELECT brand_name FROM brand WHERE id=$brand_id";
                            $brand = mysqli_fetch_assoc(mysqli_query($connection, $query));
                            ?>
                            <td><?= $brand['brand_name'] ?></td>
                            <td><?= $desktop_case['desktop_case_name'] ?></td>
                            <td>
                                <a class="btn btn-primary mb-1" style="width: 80px;" href="<?= ROOT_URL ?>details/desktop_case_details.php?id=<?= $desktop_case['id'] ?>">Details</a>
                                <a class="btn btn-secondary " style="width: 80px;" href="./edit_desktop_case.php?id=<?= $desktop_case['id'] ?>" class="btn sm">Edit</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <div class="alert__message error d-flex justify-content-center align-items-center py-5 my-5">
                <h4> "No desktop case found" </h4>
            </div>
        <?php endif ?>

    </div>
</main>


<?php
include './partials/footer.php';
?>