<?php require_once './views/header.php'; ?>

<style>
    thead th span{
        vertical-align: middle !important;
    }
</style>

<div class="container mt-3">
    <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#modelAddClass">
        <i class="fa-solid fa-plus"></i>
        Thêm lớp
    </button>

    <div class="modal fade" id="modelAddClass" tabindex="-1" role="dialog" aria-labelledby="modelAddClass" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm lớp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= "/class/add" ?>" method="POST">
                        <div class="form-group row">
                            <label for="class-name" class="col-3 col-form-label text-center">Tên lớp</label>
                            <div class="col-9">
                                <input type="text" name="class-name" class="form-control" id="class-name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="class-credit" class="col-3 col-form-label text-center">Số tín chỉ</label>
                            <div class="col-9">
                                <input type="number" name="class-credit" class="form-control" id="class-credit" require>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="class-min_student" class="col-3 col-form-label text-center">Số SV tối thiểu</label>
                            <div class="col-9">
                                <input type="number" name="class-min_student" class="form-control" id="class-min_student" require>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="class-max_student" class="col-3 col-form-label text-center">Số SV tối đa</label>
                            <div class="col-9">
                                <input type="number" name="class-max_student" class="form-control" id="class-max_student" require>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="class-time_start" class="col-3 col-form-label text-center">Ngày bắt đầu học</label>
                            <div class="col-9">
                                <input type="date" name="class-time_start" class="form-control" id="class-time_start" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="class-time_open" class="col-3 col-form-label text-center">Ngày mở lớp</label>
                            <div class="col-9">
                                <input type="date" name="class-time_open" class="form-control" id="class-time_open" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button 
                                type="submit" 
                                class="btn btn-primary" 
                                name="btn-add-class" 
                                onclick="return confirm('Bạn có muốn thêm ?');"
                            >
                                Thêm lớp
                            </button>
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
                <th scope="col">
                    Mã lớp
                    <span class="d-inline-flex flex-column">
                        <a href="<?= "/class/index?page=$page&order=id" ?>"><i class="fa-solid fa-angle-up"></i></a>
                        <a href="<?= "/class/index?page=$page&order=id&desc" ?>"><i class="fa-solid fa-angle-down"></i></a>
                    </span>
                </th>
                <th scope="col">
                    Tên lớp
                    <span class="d-inline-flex flex-column">
                        <a href="<?= "/class/index?page=$page&order=name" ?>"><i class="fa-solid fa-angle-up"></i></a>
                        <a href="<?= "/class/index?page=$page&order=name&desc" ?>"><i class="fa-solid fa-angle-down"></i></a>
                    </span>
                </th>
                <th scope="col">
                    Số tín chỉ
                    <span class="d-inline-flex flex-column">
                        <a href="<?= "/class/index?page=$page&order=credit" ?>"><i class="fa-solid fa-angle-up"></i></a>
                        <a href="<?= "/class/index?page=$page&order=credit&desc" ?>"><i class="fa-solid fa-angle-down"></i></a>
                    </span>
                </th>
                <th scope="col" style="vertical-align: middle;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = ($page - 1) * 10; $i < min($page * 10, count($list_class)); $i++) { 
                $class = $list_class[$i]; ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $class->id ?></td>
                <td><?= $class->name ?></td>
                <td><?= $class->credit ?></td>
                <td>
                    <a class="btn btn-primary" href=<?= "/class/detail?id=".$class->id ?> role="button"><i class="fa-solid fa-circle-info"></i></a>
                    <form class="d-inline" action=<?= "/class/remove" ?> method="POST">
                        <input type="hidden" name="class-id" value=<?= $class->id ?>>
                        <button 
                            type="submit" 
                            name="btn-remove-class" 
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
            <?php for ($i = 1; $i <= ceil(count($list_class) / 10); $i++) { ?>
            <li class="page-item <?php if ($i === $page) echo "active"; ?>">
                <a class="page-link" href=<?= "/class/index?page=$i&order=$order" . ($desc ? "&desc" : "") ?>> <?= $i ?> </a>
            </li>
            <?php } ?>
        </ul>
    </nav>
</div>

<?php require_once './views/footer.php'; ?>