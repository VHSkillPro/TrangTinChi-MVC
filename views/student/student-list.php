<?php require_once './views/header.php'; ?>

<style>
    thead th span{
        vertical-align: middle !important;
    }
</style>

<div class="container-fluid mt-3">
    <div class="row" style="padding: 0 5rem">
        <div class="col">
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
                                <div class="form-group row">
                                    <label for="student-name" class="col-3 col-form-label text-center">Họ và tên</label>
                                    <div class="col-9">
                                        <input type="text" name="student-name" class="form-control" id="student-name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="student-gender" class="col-3 col-form-label text-center">Giới tính</label>
                                    <div class="col-9">
                                        <select class="form-control" id="student-gender" name="student-gender">
                                            <option value="Nam">Nam</option>
                                            <option value="Nữ">Nữ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="student-birthday" class="col-3 col-form-label text-center">Ngày sinh</label>
                                    <div class="col-9">
                                        <input type="date" name="student-birthday" class="form-control" id="student-birthday" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="student-birthplace" class="col-3 col-form-label text-center">Nơi sinh</label>
                                    <div class="col-9">
                                        <input type="text" name="student-birthplace" class="form-control" id="student-birthplace" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="student-phone" class="col-3 col-form-label text-center">Số điện thoại</label>
                                    <div class="col-9">
                                        <input type="text" name="student-phone" class="form-control" id="student-phone" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="student-email" class="col-3 col-form-label text-center">Email</label>
                                    <div class="col-9">
                                        <input type="text" name="student-email" class="form-control" id="student-email" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="student-major" class="col-3 col-form-label text-center">Ngành học</label>
                                    <div class="col-9">
                                        <input type="text" name="student-major" class="form-control" id="student-major" required>
                                    </div>
                                </div>
                                
                                <?php if (isset($_COOKIE['error'])) { ?>
                                <p class="text-danger">*<?= $_COOKIE['error'] ?></p>
                                <?php } ?>

                                <div class="d-flex justify-content-center">
                                    <button 
                                        type="submit" 
                                        class="btn btn-primary" 
                                        name="btn-add-student" 
                                        onclick="return confirm('Bạn có muốn thêm ?');"
                                    >
                                        Thêm sinh viên
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
    <div class="row" style="padding: 0 5rem">
        <div class="col-9">
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col" style="vertical-align: middle;">STT</th>
                        <th scope="col">
                            Mã sinh viên
                            <span class="d-inline-flex flex-column">
                                <a href="<?= "/student/index?page=$page&order=id" . (empty($urlSort) ? "" : "&" . $urlSort) ?>"><i class="fa-solid fa-angle-up"></i></a>
                                <a href="<?= "/student/index?page=$page&order=id&desc" . (empty($urlSort) ? "" : "&" . $urlSort) ?>"><i class="fa-solid fa-angle-down"></i></a>
                            </span>
                        </th>
                        <th scope="col">
                            Họ và tên
                            <span class="d-inline-flex flex-column">
                                <a href="<?= "/student/index?page=$page&order=name" . (empty($urlSort) ? "" : "&" . $urlSort) ?>"><i class="fa-solid fa-angle-up"></i></a>
                                <a href="<?= "/student/index?page=$page&order=name&desc" . (empty($urlSort) ? "" : "&" . $urlSort) ?>"><i class="fa-solid fa-angle-down"></i></a>
                            </span>
                        </th>
                        <th scope="col">
                            Giới tính
                            <span class="d-inline-flex flex-column">
                                <a href="<?= "/student/index?page=$page&order=gender" . (empty($urlSort) ? "" : "&" . $urlSort) ?>"><i class="fa-solid fa-angle-up"></i></a>
                                <a href="<?= "/student/index?page=$page&order=gender&desc" . (empty($urlSort) ? "" : "&" . $urlSort) ?>"><i class="fa-solid fa-angle-down"></i></a>
                            </span>
                        </th>
                        <th scope="col">
                            Ngày sinh
                            <span class="d-inline-flex flex-column">
                                <a href="<?= "/student/index?page=$page&order=birthday" . (empty($urlSort) ? "" : "&" . $urlSort) ?>"><i class="fa-solid fa-angle-up"></i></a>
                                <a href="<?= "/student/index?page=$page&order=birthday&desc" . (empty($urlSort) ? "" : "&" . $urlSort) ?>"><i class="fa-solid fa-angle-down"></i></a>
                            </span>
                        </th>
                        <th scope="col">
                            Ngành học
                            <span class="d-inline-flex flex-column">
                                <a href="<?= "/student/index?page=$page&order=major" . (empty($urlSort) ? "" : "&" . $urlSort) ?>"><i class="fa-solid fa-angle-up"></i></a>
                                <a href="<?= "/student/index?page=$page&order=major&desc" . (empty($urlSort) ? "" : "&" . $urlSort) ?>"><i class="fa-solid fa-angle-down"></i></a>
                            </span>
                        </th>
                        <th scope="col" style="vertical-align: middle;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = ($page - 1) * 10; $i < min($page * 10, count($list_student)); $i++) { 
                        $student = $list_student[$i]; ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $student->id ?></td>
                        <td><?= $student->name ?></td>
                        <td><?= $student->gender ?></td>
                        <td><?= $student->birthday ?></td>
                        <td><?= $student->major ?></td>
                        <td>
                            <a class="btn btn-info" href=<?="/student/class?id=$student->id" ?> role="button">
                                <i class="fa-solid fa-calendar-plus"></i>
                            </a>
                            <a class="btn btn-primary" href=<?= "/student/detail?id=$student->id" ?> role="button">
                                <i class="fa-solid fa-circle-info"></i>
                            </a>
                            <form class="d-inline" action=<?= "/student/remove" ?> method="POST">
                                <input type="hidden" name="student-id" value=<?= $student->id ?>>
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

            <nav>
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= ceil(count($list_student) / 10); $i++) { ?>
                    <li class="page-item <?php if ($i === $page) echo "active"; ?>">
                        <a class="page-link" href=<?= "/student/index?page=$i&order=$order" . ($desc ? "&desc" : "")  . (empty($urlSort) ? "" : "&" . $urlSort)?>> <?= $i ?> </a>
                    </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
        <div class="col-3">
            <form action="/student/index" method="get" class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="student-id" class="font-weight-bold">Mã SV</label>
                        <input type="text" class="form-control" id="student-id" name="student-id">
                    </div>
                    <div class="form-group">
                        <label for="student-name" class="font-weight-bold">Họ và tên</label>
                        <input type="text" class="form-control" id="student-name" name="student-name">
                    </div>
                    <div class="form-group">
                        <label for="student-gender" class="font-weight-bold">Giới tính</label>
                        <select name="student-gender" id="student-gender" class="form-control">
                            <option value="null" selected>Please select gender</option>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="student-major" class="font-weight-bold">Ngành học</label>
                        <input type="text" class="form-control" id="student-major" name="student-major">
                    </div>
                    <button type="submit" class="btn btn-secondary" name="btn-search-student">Tìm kiếm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once './views/footer.php'; ?>