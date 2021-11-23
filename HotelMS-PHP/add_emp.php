<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Thêm nhân viên</li>
        </ol>
    </div><!--/.row-->

    <!-- <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Employee</h1>
        </div>
    </div> -->
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Thông tin chi tiết nhân viên:</div>
                <div class="panel-body">
                    <div class="emp-response"></div>
                    <form role="form" id="addEmployee" data-toggle="validator">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Nhân viên</label>
                                <select class="form-control" id="staff_type" required data-error="Chọn kiểu nhân viên">
                                    <option selected disabled>Chọn loại nhân viên:</option>
                                    <?php
                                    $query = "SELECT * FROM staff_type";
                                    $result = mysqli_query($connection, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($staff = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $staff['staff_type_id'] . '">' . $staff['staff_type'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Ca làm việc</label>
                                <select class="form-control" id="shift" required data-error="Chọn ca làm">
                                    <option selected disabled>Lựa chọn loại nhân viên:</option>
                                    <?php
                                    $query = "SELECT * FROM shift";
                                    $result = mysqli_query($connection, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($shift = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $shift['shift_id'] . '">' . $shift['shift'] . ' - ' . $shift['shift_timing'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Họ nhân viên:</label>
                                <input type="text" class="form-control" placeholder="Họ nhân viên" id="last_name">
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Tên nhân viên:</label>
                                <input type="text" class="form-control" placeholder="Tên nhân viên" id="first_name" required data-error="Vui lòng điền tên nhân viên">
                                <div class="help-block with-errors"></div>
                            </div>

                         
                            <div class="form-group col-lg-6">
                                <label>Loại thẻ ID:</label>
                                <select class="form-control" id="id_card_id" required onchange="validId(this.value);">
                                    <option selected disabled>Chọn loại thẻ ID:</option>
                                    <?php
                                    $query = "SELECT * FROM id_card_type";
                                    $result = mysqli_query($connection, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($id_card_type = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $id_card_type['id_card_type_id'] . '">' . $id_card_type['id_card_type'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Mã số thẻ ID:</label>
                                <input type="text" class="form-control" placeholder="Số thẻ ID" id="id_card_no" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Số điện thoại liên lạc:</label>
                                <input type="number" class="form-control" placeholder="Số điện thoại liên lạc" id="contact_no" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            
                            <div class="form-group col-lg-6">
                                <label>Mức lương</label>
                                <input type="number" class="form-control" placeholder="Mức lương" id="salary" data-error="Nhập mức lương" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Địa chỉ cư trú:</label>
                                <input type="text" class="form-control" placeholder="Địa chỉ cư chú" id="address" required>
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-lg btn-success" style="border-radius:0%">Gửi</button>
                        <button type="reset" class="btn btn-lg btn-danger" style="border-radius:0%">Thiết lập lại</button>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-sm-12">
        <p class="back-link">Phát triển bởi HMHT</p>
        </div>
    </div>

</div>    <!--/.main-->




