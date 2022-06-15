<?php require_once './views/header.php'; ?>

<style>
    thead th span{
        vertical-align: middle !important;
    }
</style>

<div class="container mt-3">
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