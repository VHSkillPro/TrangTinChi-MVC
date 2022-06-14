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
                <?php foreach ($title as $key => $value) { ?>
                <th scope="col">
                    <?=$value?>
                    <span class="d-inline-flex flex-column">
                        <a href="<?= "/class/index?order=$key&page=$page" ?>"><i class="fa-solid fa-angle-up"></i></a>
                        <a href="<?= "/class/index?order=$key&page=$page&desc" ?>"><i class="fa-solid fa-angle-down"></i></a>
                    </span>
                </th>
                <?php } ?>
                <th scope="col" style="vertical-align: middle;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = ($page - 1) * 10; $i < min($page * 10, count($list_class)); $i++) { 
                $class = $list_class[$i]; ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <?php foreach ($title as $key => $value) { ?>
                    <td><?= $class[$key] ?></td>
                <?php } ?>
                <td>
                    <a class="btn btn-primary" href=<?= "/class/detail?id=$class[id]" ?> role="button">
                        <i class="fa-solid fa-circle-info"></i>
                    </a>
                    <form class="d-inline" action=<?= "/class/remove" ?> method="POST">
                        <input type="hidden" name="class-id" value=<?= $class['id'] ?>>
                        <button type="submit" name="btn-remove-class" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xoá ?');">
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