<?php require_once './views/header.php'; ?>

<style>
    thead th span{
        vertical-align: middle !important;
    }
</style>

<div class="container mt-5">
    <h1>Thông tin chi tiết</h1>
    <form action="<?= "/class/edit" ?>" method="POST" class="mt-5">
        <div class="form-group row">
            <label for="class-id" class="col-2 col-form-label text-center">Mã lớp</label>
            <div class="col-10">
                <input type="text" name="class-id" id="class-id" class="form-control" value="<?= $class->id ?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="class-name" class="col-2 col-form-label text-center">Tên lớp</label>
            <div class="col-10">
                <input type="text" name="class-name" id="class-name" class="form-control" value="<?= $class->name ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="class-credit" class="col-2 col-form-label text-center">Số tín chỉ</label>
            <div class="col-10">
                <input type="number" name="class-credit" id="class-credit" class="form-control" value="<?= $class->credit ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="class-min_student" class="col-2 col-form-label text-center">Số SV tối thiểu</label>
            <div class="col-10">
                <input type="number" name="class-min_student" id="class-min_student" class="form-control" value="<?= $class->min_student ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="class-max_student" class="col-2 col-form-label text-center">Số SV tối đa</label>
            <div class="col-10">
                <input type="number" name="class-max_student" id="class-max_student" class="form-control" value="<?= $class->max_student ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="class-time_start" class="col-2 col-form-label text-center">Ngày bắt đầu học</label>
            <div class="col-10">
                <input type="date" name="class-time_start" id="class-time_start" class="form-control" value="<?= $class->time_start ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="class-time_open" class="col-2 col-form-label text-center">Ngày mở lớp</label>
            <div class="col-10">
                <input type="date" name="class-time_open" id="class-time_open" class="form-control" value="<?= $class->time_open ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-2 col-form-label text-center">Trạng thái</label>
            <?php if (count($list_student_in_class) < $class->min_student) { ?>
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
                <th scope="col">
                    Mã sinh viên
                    <span class="d-inline-flex flex-column">
                        <a href="<?= "/class/detail?id=$id&page=$page&order=id" ?>"><i class="fa-solid fa-angle-up"></i></a>
                        <a href="<?= "/class/detail?id=$id&page=$page&order=id&desc" ?>"><i class="fa-solid fa-angle-down"></i></a>
                    </span>
                </th>
                <th scope="col">
                    Họ và tên
                    <span class="d-inline-flex flex-column">
                        <a href="<?= "/class/detail?id=$id&page=$page&order=name" ?>"><i class="fa-solid fa-angle-up"></i></a>
                        <a href="<?= "/class/detail?id=$id&page=$page&order=name&desc" ?>"><i class="fa-solid fa-angle-down"></i></a>
                    </span>
                </th>
                <th scope="col">
                    Giới tính
                    <span class="d-inline-flex flex-column">
                        <a href="<?= "/class/detail?id=$id&page=$page&order=gender" ?>"><i class="fa-solid fa-angle-up"></i></a>
                        <a href="<?= "/class/detail?id=$id&page=$page&order=gender&desc" ?>"><i class="fa-solid fa-angle-down"></i></a>
                    </span>
                </th>
                <th scope="col">
                    Ngày sinh
                    <span class="d-inline-flex flex-column">
                        <a href="<?= "/class/detail?id=$id&page=$page&order=birthday" ?>"><i class="fa-solid fa-angle-up"></i></a>
                        <a href="<?= "/class/detail?id=$id&page=$page&order=birthday&desc" ?>"><i class="fa-solid fa-angle-down"></i></a>
                    </span>
                </th>
                <th scope="col">
                    Ngành học
                    <span class="d-inline-flex flex-column">
                        <a href="<?= "/class/detail?id=$id&page=$page&order=major" ?>"><i class="fa-solid fa-angle-up"></i></a>
                        <a href="<?= "/class/detail?id=$id&page=$page&order=major&desc" ?>"><i class="fa-solid fa-angle-down"></i></a>
                    </span>
                </th>
                <th scope="col" style="vertical-align: middle;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = ($page - 1) * 10; $i < min($page * 10, count($list_student_in_class)); $i++) { 
                $student = $list_student_in_class[$i]; ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $student->id ?></td>
                <td><?= $student->name ?></td>
                <td><?= $student->gender ?></td>
                <td><?= $student->birthday ?></td>
                <td><?= $student->major ?></td>
                <td>
                    <a class="btn btn-primary" href=<?= "/student/detail?id=".$student->id ?> role="button">
                        <i class="fa-solid fa-circle-info"></i>
                    </a>
                    <form class="d-inline" action=<?= "/class/remove-student" ?> method="POST">
                        <input type="hidden" name="class-id" value=<?= $student->id ?>>
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