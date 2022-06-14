<?php require_once './views/header.php'; ?>

<style>
    thead th span{
        vertical-align: middle !important;
    }
</style>

<div class="container mt-3">
    <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#modelAddStudent">
        <i class="fa-solid fa-plus"></i>
        Thêm sinh viên
    </button>

    <div class="modal fade" id="modelAddStudent" tabindex="-1" role="dialog" aria-labelledby="modelAddStudent" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm sinh viên</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= "/student/add" ?>" method="POST">
                        <?php foreach ($formRowTitles as $key => $value) { ?>
                        <div class="form-group row">
                            <label for="<?= $key ?>" class="col-3 col-form-label text-center"><?= $value ?></label>
                            <div class="col-9">
                                <?php if ($key === "gender") { ?>
                                <select class="form-control" id="<?= $key ?>" name="<?= $key ?>">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                                <?php } else { ?>
                                <input type="<?= ($key === "birthday") ? "date" : "text" ?>" name="<?= $key ?>" class="form-control" id="<?= $key ?>" required>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if (isset($_COOKIE['error'])) { ?>
                        <p class="text-danger">*<?= $_COOKIE['error'] ?></p>
                        <?php } ?>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" name="btn-add-student" onclick="return confirm('Bạn có muốn thêm ?');">Thêm sinh viên</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th scope="col" style="vertical-align: middle;">STT</th>
                <?php foreach ($title as $key => $value) { ?>
                <th scope="col">
                    <?=$value?>
                    <span class="d-inline-flex flex-column">
                        <a href="<?= "/student/index?order=$key&page=$page" ?>"><i class="fa-solid fa-angle-up"></i></a>
                        <a href="<?= "/student/index?order=$key&page=$page&desc" ?>"><i class="fa-solid fa-angle-down"></i></a>
                    </span>
                </th>
                <?php } ?>
                <th scope="col" style="vertical-align: middle;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = ($page - 1) * 10; $i < min($page * 10, count($list_student)); $i++) { 
                $student = $list_student[$i]; ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <?php foreach ($title as $key => $value) { ?>
                    <td><?= $student[$key] ?></td>
                <?php } ?>
                <td>
                    <a class="btn btn-info" href="#" role="button">
                        <i class="fa-solid fa-calendar-plus"></i>
                    </a>
                    <a class="btn btn-primary" href=<?= "/student/detail?id=$student[id]" ?> role="button">
                        <i class="fa-solid fa-circle-info"></i>
                    </a>
                    <form class="d-inline" action=<?= "/student/remove" ?> method="POST">
                        <input type="hidden" name="student-id" value=<?= $student['id'] ?>>
                        <button type="submit" name="btn-remove-student" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xoá ?');">
                            <i class="fa-solid fa-circle-minus"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= ceil(count($list_student) / 10); $i++) { ?>
            <li class="page-item <?php if ($i === $page) echo "active"; ?>">
                <a class="page-link" href=<?= "/student/index?page=$i&order=$order" . ($desc ? "&desc" : "") ?>> <?= $i ?> </a>
            </li>
            <?php } ?>
        </ul>
    </nav>
</div>

<?php require_once './views/footer.php'; ?>