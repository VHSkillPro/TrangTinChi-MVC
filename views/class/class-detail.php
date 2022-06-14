<?php require_once './views/header.php'; ?>

<style>
    thead th span{
        vertical-align: middle !important;
    }
</style>

<div class="container mt-5">
    <h1>Thông tin chi tiết</h1>
    <form action="<?= "/class/edit" ?>" method="POST" class="mt-5">

        <?php foreach ($formRow as $key => $value) { ?>
        <div class="form-group row">
            <label 
                for="<?= $key ?>" 
                class="col-2 col-form-label text-center"
            >
                <?= $value['label'] ?>
            </label>
            <div class="col-10">
                <input 
                    type="<?= $value['type'] ?>" 
                    name="<?= $key ?>" 
                    <?= isset($value['readonly']) ? "readonly" : "" ?> 
                    class="form-control" 
                    id="<?= $key ?>" 
                    value="<?= $class[$key] ?>"
                >
            </div>
        </div>
        <?php } ?>

        <div class="form-group row">
            <label class="col-2 col-form-label text-center">Trạng thái</label>
            <?php if (count($list_student_in_class) < $class['min_students']) { ?>
                <h5 class="col-10 text-danger">Thiếu sinh viên</h5>
            <?php } else { ?>
                <h5 class="col-10 text-success">Có thể mở lớp</h5>
            <?php } ?>
        </div>

        <div class="d-flex justify-content-center">
            <button 
                type="submit" 
                class="btn btn-lg btn-primary" 
                name="btn-edit-class" 
                onclick="return confirm('Bạn có muốn lưu ?');"
            >
                <i class="fa-solid fa-floppy-disk"></i>
                Cập nhật thông tin
            </button>
        </div>
    </form>

    <h3 class="mt-3">Các sinh viên thuộc lớp</h3>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th scope="col" style="vertical-align: middle;">STT</th>
                <?php foreach ($title as $key => $value) { ?>
                <th scope="col">
                    <?=$value?>
                    <span class="d-inline-flex flex-column">
                        <a href="<?= "/class/detail?id=$id&order=$key&page=$page" ?>">
                            <i class="fa-solid fa-angle-up"></i>
                        </a>
                        <a href="<?= "/class/detail?id=$id&order=$key&page=$page&desc" ?>">
                            <i class="fa-solid fa-angle-down"></i>
                        </a>
                    </span>
                </th>
                <?php } ?>
                <th scope="col" style="vertical-align: middle;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = ($page - 1) * 10; $i < min($page * 10, count($list_student_in_class)); $i++) { 
                $student = $list_student_in_class[$i]; ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <?php foreach ($title as $key => $value) { ?>
                    <td><?= $student[$key] ?></td>
                <?php } ?>
                <td>
                    <a class="btn btn-primary" href=<?= "/student/detail?id=$student[id]" ?> role="button">
                        <i class="fa-solid fa-circle-info"></i>
                    </a>
                    <form class="d-inline" action=<?= "/class/remove-student" ?> method="POST">
                        <input type="hidden" name="class-id" value=<?= $student['id'] ?>>
                        <button 
                            type="submit" 
                            name="btn-remove-student" 
                            class="btn btn-danger" 
                            onclick="return confirm('Bạn có chắc chắn muốn xoá ?');"
                        >
                            <i class="fa-solid fa-circle-minus"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once './views/footer.php'; ?>