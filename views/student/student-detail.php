<?php require_once './views/header.php'; ?>

<div class="container mt-5">
    <h1>Thông tin chi tiết</h1>
    <form action="<?= "/student/edit" ?>" method="POST" class="mt-5">
        <div class="form-group row">
            <label for="student-id" class="col-2 col-form-label text-center">Mã sinh viên</label>
            <div class="col-10">
                <input type="text" name="student-id" class="form-control" id="student-id" value="<?= $student->id ?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="student-name" class="col-2 col-form-label text-center">Họ và tên</label>
            <div class="col-10">
                <input type="text" name="student-name" class="form-control" id="student-name" value="<?= $student->name ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="student-gender" class="col-2 col-form-label text-center">Giới tính</label>
            <div class="col-10">
                <select class="form-control" id="student-gender" name="student-gender">
                    <option <?php if ($student->gender === "Nam") echo "selected"; ?> value="Nam">Nam</option>
                    <option <?php if ($student->gender === "Nữ") echo "selected"; ?> value="Nữ">Nữ</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="student-birthday" class="col-2 col-form-label text-center">Ngày sinh</label>
            <div class="col-10">
                <input type="date" name="student-birthday" class="form-control" id="student-birthday" value="<?= $student->birthday ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="student-birthplace" class="col-2 col-form-label text-center">Nơi sinh</label>
            <div class="col-10">
                <input type="text" name="student-birthplace" class="form-control" id="student-birthplace" value="<?= $student->birthplace ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="student-phone" class="col-2 col-form-label text-center">Số điện thoại</label>
            <div class="col-10">
                <input type="text" name="student-phone" class="form-control" id="student-phone" value="<?= $student->phone ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="student-email" class="col-2 col-form-label text-center">Email</label>
            <div class="col-10">
                <input type="text" name="student-email" class="form-control" id="student-email" value="<?= $student->email ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="student-major" class="col-2 col-form-label text-center">Ngành học</label>
            <div class="col-10">
                <input type="text" name="student-major" class="form-control" id="student-major" value="<?= $student->major ?>">
            </div>
        </div>

        <input type="hidden" name="student-token" class="form-control" id="student-token" value="<?= $student->token ?>">

        <div class="d-flex justify-content-center">
            <button 
                type="submit" 
                class="btn btn-lg btn-primary" 
                name="btn-edit-student" 
                onclick="return confirm('Bạn có muốn lưu ?');"
            >
                <i class="fa-solid fa-floppy-disk"></i>
                Cập nhật thông tin
            </button>
        </div>
    </form>
</div>

<?php require_once './views/footer.php'; ?>