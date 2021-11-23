<?php
if (isset($_GET['room_id'])){
    $get_room_id = $_GET['room_id'];
    $get_room_sql = "SELECT * FROM room NATURAL JOIN room_type WHERE room_id = '$get_room_id'";
    $get_room_result = mysqli_query($connection,$get_room_sql);
    $get_room = mysqli_fetch_assoc($get_room_result);

    $get_room_type_id = $get_room['room_type_id'];
    $get_room_type = $get_room['room_type'];
    $get_room_no = $get_room['room_no'];
    $get_room_price = $get_room['price'];
}

?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Đặt phòng</li>
        </ol>
    </div><!--/.row-->

    <!-- <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Reservation</h1>
        </div>
    </div>/.row -->

    

    <div class="row">
        <div class="col-lg-12">
            <form role="form" id="booking" data-toggle="validator">
                <div class="response"></div>
                <div class="col-lg-12">
                    <?php
                    if (isset($_GET['room_id'])){?>

                        <div class="panel panel-default">
                            <div class="panel-heading">Thông tin phòng:
                                <a class="btn btn-secondary pull-right" href="index.php?room_mang">Lập kế hoạch đặt chỗ</a>
                            </div>
                            <div class="panel-body">
                                <div class="form-group col-lg-6">
                                    <label>Kiểu phòng</label>
                                    <select class="form-control" id="room_type" data-error="Chọn kiểu phòng" required>
                                        <option selected disabled>Chọn kiểu phòng</option>
                                        <option selected value="<?php echo $get_room_type_id; ?>"><?php echo $get_room_type; ?></option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Phòng số</label>
                                    <select class="form-control" id="room_no" onchange="fetch_price(this.value)" required data-error="Chọn phòng số">
                                        <option selected disabled>Chọn phòng số</option>
                                        <option selected value="<?php echo $get_room_id; ?>"><?php echo $get_room_no; ?></option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Ngày nhận phòng</label>
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_in_date" data-error="Vui lòng chọn ngày nhận phòng" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Ngày trả phòng</label>
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_out_date" data-error="Vui lòng chọn ngày trả phòng" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-lg-12">
                                    <h4 style="font-weight: bold">Tổng số ngày : <span id="staying_day">0</span> ngày</h4>
                                    <h4 style="font-weight: bold">Giá: <span id="price"><?php echo $get_room_price; ?></span> /-</h4>
                                    <h4 style="font-weight: bold">Tổng số tiền cần thanh toán : <span id="total_price">0</span> /-</h4>
                                </div>
                            </div>
                        </div>
                    <?php } else{?>
                        <div class="panel panel-default">
                            <div class="panel-heading">Thông tin phòng:
                                <a class="btn btn-secondary pull-right" style="border-radius:0%" href="index.php?reservation">Kế hoạch đặt phòng</a>
                            </div>
                            <div class="panel-body">
                                <div class="form-group col-lg-6">
                                    <label>Loại phòng</label>
                                    <select class="form-control" id="room_type" onchange="fetch_room(this.value);" required data-error="Vui lòng chọn kiểu phòng">
                                        <option selected disabled>Chọn loại phòng</option>
                                        <?php
                                        $query  = "SELECT * FROM room_type";
                                        $result = mysqli_query($connection,$query);
                                        if (mysqli_num_rows($result) > 0){
                                            while ($room_type = mysqli_fetch_assoc($result)){
                                                echo '<option value="'.$room_type['room_type_id'].'">'.$room_type['room_type'].'</option>';
                                            }}
                                        ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Phòng số</label>
                                    <select class="form-control" id="room_no" onchange="fetch_price(this.value)" required data-error="Vui lòng chọn phòng số">

                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Ngày nhận phòng</label>
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_in_date" data-error="Vui lòng chọn ngày nhận phòng" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Ngày trả phòng</label>
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_out_date" data-error="Vui lòng chọn ngày trả phòng" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-lg-12">
                                    <h4 style="font-weight: bold">Tổng số ngày : <span id="staying_day">0</span> Ngày</h4>
                                    <h4 style="font-weight: bold">Giá: <span id="price">0</span> /-</h4>
                                    <h4 style="font-weight: bold">Tổng số tiền : <span id="total_price">0</span> /-</h4>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">Thông tin khách hàng:</div>
                        <div class="panel-body">
                            <div class="form-group col-lg-6">
                                <label>Tên khách hàng:</label>
                                <input class="form-control" placeholder="Tên khách hàng" id="first_name" data-error="Vui lòng nhập tên của khách hàng" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Số điện thoại liên lạc</label>
                                <input type="number" class="form-control" data-error="Nhập tối thiểu 10 kí tự số" data-minlength="10" placeholder="Số điện thoại liên lạc" id="contact_no" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Họ khách hàng:</label>
                                <input class="form-control" placeholder="Họ khách hàng" id="last_name">
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label>Địa chỉ Email</label>
                                <input type="email" class="form-control" placeholder="Địa chỉ Email" id="email" data-error="Vui lòng nhập đúng kiểu email" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Loại thẻ ID</label>
                                <select class="form-control" id="id_card_id" data-error="Vui lòng chọn loại thẻ ID" required onchange="validId(this.value);">
                                    <option selected disabled>Chọn loại thẻ ID</option>
                                    <?php
                                    $query  = "SELECT * FROM id_card_type";
                                    $result = mysqli_query($connection,$query);
                                    if (mysqli_num_rows($result) > 0){
                                        while ($id_card_type = mysqli_fetch_assoc($result)){
                                            echo '<option value="'.$id_card_type['id_card_type_id'].'">'.$id_card_type['id_card_type'].'</option>';
                                        }}
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Mã số thẻ ID đã chọn</label>
                                <input type="text" class="form-control" placeholder="Mã số thẻ ID" id="id_card_no" data-error="Vui lòng nhập mã ID có tồn tại" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-12">
                                <label>Địa chỉ cư trú</label>
                                <input type="text" class="form-control" placeholder="Địa chỉ" id="address" data-error="Vui lòng nhập địa chỉ cư trú" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-success pull-right" style="border-radius:0%">Gửi</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <p class="back-link">Phát triển bởi HMHT</p>
        </div>
    </div>

</div>    <!--/.main-->


<!-- Booking Confirmation-->
<div id="bookingConfirm" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><b>Đặt phòng</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert bg-success alert-dismissable" role="alert"><em class="fa fa-lg fa-check-circle">&nbsp;</em>Phòng đặt thành công</div>
                        <table class="table table-striped table-bordered table-responsive">
                            <!-- <thead>
                            <tr>
                                <th>Name</th>
                                <th>Detail</th>
                            </tr>
                            </thead> -->
                            <tbody>
                            <tr>
                                <td><b>Tên Khách Hàng</b></td>
                                <td id="getCustomerName"></td>
                            </tr>
                            <tr>
                                <td><b>Kiểu Phòng</b></td>
                                <td id="getRoomType"></td>
                            </tr>
                            <tr>
                                <td><b>Số Phòng</b></td>
                                <td id="getRoomNo"></td>
                            </tr>
                            <tr>
                                <td><b>Nhận Phòng</b></td>
                                <td id="getCheckIn"></td>
                            </tr>
                            <tr>
                                <td><b>Ngày Trả Phòng</b></td>
                                <td id="getCheckOut"></td>
                            </tr>
                            <tr>
                                <td><b>Tổng số tiền</b></td>
                                <td id="getTotalPrice"></td>
                            </tr>
                            <tr>
                                <td><b>Tình trạng thanh toán</b></td>
                                <td id="getPaymentStaus"></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" style="border-radius:60px;" href="index.php?reservation"><i class="fa fa-check-circle"></i></a>
            </div>
        </div>

    </div>
</div>


