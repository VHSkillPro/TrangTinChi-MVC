<?php require_once './views/header.php'; ?>

<div class="container mt-5">
    <h1>Thông tin chi tiết</h1>
    <form action="<?= "/student/edit" ?>" method="POST" class="mt-5">

        <?php foreach ($title as $key => $value) { ?>
        <div class="form-group row">
            <label for="<?= $key ?>" class="col-2 col-form-label text-center"><?= $value ?></label>
            <div class="col-10">
                <?php if ($key === "gender") { ?>
                <select class="form-control" id="gender" name="gender">
                    <option <?php if ($student['gender'] === "Nam") echo "selected"; ?> value="Nam">Nam</option>
                    <option <?php if ($student['gender'] === "Nữ") echo "selected"; ?> value="Nữ">Nữ</option>
                </select>
                <?php } else { ?>
                <input type="<?= ($key === "birthday") ? "date" : "text" ?>" name="<?= $key ?>" <?php if ($key === 'id') echo "readonly" ?> class="form-control" id="<?= $key ?>" value="<?= $student[$key] ?>">
                <?php } ?>
            </div>
        </div>
        <?php } ?>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-lg btn-primary" name="btn-edit-student" onclick="return confirm('Bạn có muốn lưu ?');">
                <i class="fa-solid fa-floppy-disk"></i>
                Cập nhật thông tin
            </button>
        </div>
    </form>
</div>

<?php require_once './views/footer.php'; ?>