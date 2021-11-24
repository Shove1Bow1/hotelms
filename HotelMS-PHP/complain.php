<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Phản hồi</li>
        </ol>
    </div><!--/.row-->

    

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Tạo Danh Mục Phản Hồi</div>
                <div class="panel-body">
                    <?php
                    if (isset($_GET['error'])) {
                        echo "<div class='alert alert-danger'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Không tạo được mục phản hồi !
                            </div>";
                    }
                    if (isset($_GET['success'])) {
                        echo "<div class='alert alert-success'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Tạo thành công mục phản hồi !
                            </div>";
                    }
                    ?>
                    <form role="form"  data-toggle="validator" method="post" action="ajax.php">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Tên người phản hồi</label>
                                <input type="text" class="form-control" placeholder="Tên người phản hồi" name="complainant_name" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Vấn đề cần được phản hồi</label>
                                <input type="text" class="form-control" placeholder="Vấn đề cần được phản hồi" name="complaint_type" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-12">
                                <label>Mô tả phản hồi</label>
                                <textarea class="form-control" name="complaint" placeholder="Mô tả phản hồi" required></textarea>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-lg btn-success" name="createComplaint" style="border-radius:0%">Gửi</button>
                        <button type="reset" class="btn btn-lg btn-danger" style="border-radius:0%">Thiết lập lại</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Quản lý các lời phản hồi</div>
                <div class="panel-body">
                    <?php
                    if (isset($_GET['resolveError'])) {
                        echo "<div class='alert alert-danger'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Vấn đề còn đang được giải quyết !
                            </div>";
                    }
                    if (isset($_GET['resolveSuccess'])) {
                        echo "<div class='alert alert-success'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Phản hồi đã được giải quyết !
                            </div>";
                    }
                    ?>
                    <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%" id="rooms">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên người phản hồi</th>
                            <th>Vấn đề phản hồi</th>
                            <th>Mô tả</th>
                            <th>Ngày được tạo</th>
                            <th>Giải quyết</th>
                            <th>Số tiền giải quyết</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $complaint_query = "SELECT * FROM complaint";
                        $complaint_result = mysqli_query($connection, $complaint_query);
                        if (mysqli_num_rows($complaint_result) > 0) {
                            $num = 0;
                            while ($complaint = mysqli_fetch_assoc($complaint_result)) {
                                $num++
                                ?>
                                <tr>
                                    <td><?php echo $num ?></td>
                                    <td><?php echo $complaint['complainant_name'] ?></td>
                                    <td><?php echo $complaint['complaint_type'] ?></td>
                                    <td><?php echo $complaint['complaint'] ?></td>
                                    <td><?php echo date('M j, Y',strtotime($complaint['created_at'])) ?></td>
                                    <td>
                                        <?php if(!$complaint['resolve_status']){
                                            echo '<button class="btn btn-info" data-toggle="modal" style="border-radius:0%" data-target="#complaintModal" data-id="' . $complaint['id'] . '" id="complaint">Giải quyết</a>';
                                        } else{
                                            echo date('M j, Y',strtotime($complaint['resolve_date']));
                                        }
                                        ?>
                                    </td>
                                    <th><?php echo $complaint['budget'] ?></th>


                                </tr>
                            <?php }
                        } else {
                            echo "Hết chỗ";
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Add Room Modal -->
    <div id="complaintModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Phàn nàn đã được giải quyết/h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form data-toggle="validator" role="form" method="post" action="ajax.php">
                                <div class="form-group">
                                    <label>Số tiền giải quyết</label>
                                    <input class="form-control" placeholder="Budget" name="budget" data-error="Nhập số tiền" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <input type="hidden" id="complaint_id" name="complaint_id" value="">
                                <button class="btn btn-success pull-right" name="resolve_complaint">Giải quyết phàn hồi</button>
                            </form>
                        </div>
                    </div>
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
