<?php require_once './views/header.php'; ?>

<style>
    thead th span{
        vertical-align: middle !important;
    }
</style>

<div class="container">
    <div class="row mt-4">
        <div class="col-3">
            <!-- information student -->
            <div class="card">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">
                        <i class="fa-solid fa-angle-right h6"></i>
                        Mã SV : <?= $student->id ?>
                    </h6>
                    <h5 class="card-title">
                        <i class="fa-solid fa-angle-right h6"></i>
                        <?= $student->name ?>
                    </h5>
                    <p class="card-text">
                        <i class="fa-solid fa-angle-right  h6"></i>
                        Giới tính: <?= $student->gender ?>
                    </p>
                    <p class="card-text">
                        <i class="fa-solid fa-angle-right  h6"></i>
                        Ngày sinh: <?= $student->birthday ?>
                    </p>
                    <p class="card-text">
                        <i class="fa-solid fa-angle-right  h6"></i>
                        Ngành học: <?= $student->major ?>
                    </p>
                    <a href=<?= "/student/detail?id=$id" ?> class="btn btn-info">Xem thông tin</a>
                </div>
            </div>
        </div>
        <div class="col-9">
            <!-- form add / remove class -->
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col" style="vertical-align: middle;">STT</th>
                        <th scope="col">
                            Mã lớp
                            <span class="d-inline-flex flex-column">
                                <a href="<?= "/student/class?id=$id&page=$page&order=id" ?>"><i class="fa-solid fa-angle-up"></i></a>
                                <a href="<?= "/student/class?id=$id&page=$page&order=id&desc" ?>"><i class="fa-solid fa-angle-down"></i></a>
                            </span>
                        </th>
                        <th scope="col">
                            Tên lớp
                            <span class="d-inline-flex flex-column">
                                <a href="<?= "/student/class?id=$id&page=$page&order=name" ?>"><i class="fa-solid fa-angle-up"></i></a>
                                <a href="<?= "/student/class?id=$id&page=$page&order=name&desc" ?>"><i class="fa-solid fa-angle-down"></i></a>
                            </span>
                        </th>
                        <th scope="col">
                            Số tín chỉ
                            <span class="d-inline-flex flex-column">
                                <a href="<?= "/student/class?id=$id&page=$page&order=credit" ?>"><i class="fa-solid fa-angle-up"></i></a>
                                <a href="<?= "/student/class?id=$id&page=$page&order=credit&desc" ?>"><i class="fa-solid fa-angle-down"></i></a>
                            </span>
                        </th>
                        <th scope="col">
                            Trạng thái
                            <span class="d-inline-flex flex-column">
                                <a href="<?= "/student/class?id=$id&page=$page&order=direc" ?>"><i class="fa-solid fa-angle-up"></i></a>
                                <a href="<?= "/student/class?id=$id&page=$page&order=direc&desc" ?>"><i class="fa-solid fa-angle-down"></i></a>
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
                        <?php if(in_array($class, $list_class_registed)) {?>
                            <td class="text-success font-weight-bold">Đã đăng ký</td>
                        <?php } else { ?>
                            <td class="text-danger font-weight-bold">Chưa đăng ký</td>
                        <?php }?>
                        <td>
                            <a class="btn btn-primary" href=<?= "/class/detail?id=".$class->id ?> role="button"><i class="fa-solid fa-circle-info"></i></a>
                            
                            <?php if(in_array($class, $list_class_registed)) { ?>
                                <form class="d-inline" action=<?= "/student/removeClass" ?> method="POST">
                                    <input type="hidden" name="class-id" value=<?= $class->id ?>>
                                    <input type="hidden" name="student-id" value=<?= $id ?>>
                                    <button 
                                        type="submit" 
                                        name="btn-remove-class" 
                                        class="btn btn-danger" 
                                        onclick="return confirm('Bạn có chắc chắn muốn xoá ?');"
                                    >
                                        <i class="fa-solid fa-circle-minus"></i>
                                    </button>
                                </form>
                            <?php } else { ?>
                                <form class="d-inline" action=<?= "/student/addClass" ?> method="POST">
                                    <input type="hidden" name="class-id" value=<?= $class->id ?>>
                                    <input type="hidden" name="student-id" value=<?= $id ?>>
                                    <button 
                                        type="submit" 
                                        name="btn-add-class" 
                                        class="btn btn-success" 
                                        onclick="return confirm('Bạn có chắc chắn muốn thêm ?');"
                                    >
                                        <i class="fa-solid fa-circle-plus"></i>
                                    </button>
                                </form>
                            <?php } ?>
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
    </div>
</div>

<?php require_once './views/footer.php'; ?>