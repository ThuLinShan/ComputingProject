<?php
include './partials/header.php';

// Fetch gpus
$query = "SELECT * FROM gpu ORDER BY gpu_name";
$gpus = mysqli_query($connection, $query);

$brand;
$brand_id;
?>

<main>
    <div class="bg-dark text-center d-flex flex-column justify-content-center" style="height: 25vh;">
        <h3 class="text-secondary fw-bold fs-1">Manage GPU</h3>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-warning justify-content-center">
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>" class="text-warning">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>admin" class="text-warning">Admin Dashboard</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">Manage GPU</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5">
        <div class="row p-4 rounded shadow-lg">
            <div class="col-md-6 ">
                <h3>GPUs</h3>
            </div>
            <a class="col-md-6 btn btn-dark px-4" href="./add_gpu.php">Add new GPU</a>
        </div>

        <!-- alet message -->
        <?php if (isset($_SESSION['delete-gpu'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['delete-gpu'];
                    unset($_SESSION['delete-gpu']); ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['delete-gpu-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['delete-gpu-success'];
                    unset($_SESSION['delete-gpu-success']); ?>
                </p>
            </div>
        <?php endif ?>
        <!-- alet message -->
        <?php if (isset($_SESSION['add-gpu-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['add-gpu-success'];
                    unset($_SESSION['add-gpu-success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['edit-gpu-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['edit-gpu-success'];
                    unset($_SESSION['edit-gpu-success']); ?>
                </p>
            </div>
        <?php endif ?>
        <!-- alert message end -->
        <?php if (mysqli_num_rows($gpus) > 0) : ?>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Name</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($gpu = mysqli_fetch_assoc($gpus)) : ?>
                        <tr class="align-middle">
                            <!-- fetch brand with id -->
                            <?php
                            $brand_id = $gpu['brand'];
                            $query = "SELECT brand_name FROM brand WHERE id=$brand_id";
                            $brand = mysqli_fetch_assoc(mysqli_query($connection, $query));
                            ?>
                            <td><?= $brand['brand_name'] ?></td>
                            <td><?= $gpu['gpu_name'] ?></td>
                            <td>
                                <a class="btn btn-primary mb-1" style="width: 80px;" href="<?= ROOT_URL ?>details/gpu_details.php?id=<?= $gpu['id'] ?>">Details</a>
                                <a class="btn btn-secondary " style="width: 80px;" href="./edit_gpu.php?id=<?= $gpu['id'] ?>" class="btn sm">Edit</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <div class="alert__message error d-flex justify-content-center align-items-center py-5 my-5">
                <h4> "No GPUs found" </h4>
            </div>
        <?php endif ?>

    </div>
</main>


<?php
include './partials/footer.php';
?>