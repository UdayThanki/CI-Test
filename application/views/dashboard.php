<div class="container">
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add New
        Product</button>
    <a class="btn btn-danger" href="<?php echo base_url(); ?>logout">Logout</a>
    <div>
        <?php echo $this->session->flashdata('success'); ?>
        <h2>
            <center>Product details</center>
        </h2>
    </div>
    <table id='empTable' class='display dataTable'>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Color</th>
                <th>Product type</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>


    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Product</h4>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" type="POST" id="submit_data" name='submit_data'>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Name *:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="product_name" id="product_name"
                                    placeholder="Enter Product Name">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Description *:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="product_desc" id="product_desc"
                                    placeholder="Enter Product Description"></textarea>
                            </div>
                        </div>

                        <div class="form-group imagedata">
                            <label class="control-label col-sm-2 " for="image">Image *:</label>
                            <div class="col-sm-10 setimage setimg">
                                <input type="file" class="form-control reimg ria" name="file" id="file"
                                    placeholder="select Product image">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="color">Color *:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="color" id="color">
                                    <option selected value="0">-Select-</option>
                                    <option value="1"> black </option>
                                    <option value="2"> white </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="type">Type *:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="product_type" id="product_type">
                                    <option selected value="0">-Select-</option>
                                    <option value="1"> Home & Furniture </option>
                                    <option value="2"> Electronics </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="color">Quantity *:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="qty" id="qty">
                                    <option selected value="0">-Select-</option>
                                    <option value="1"> 1 </option>
                                    <option value="2"> 2 </option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" value="" name="rec_id" id="rec_id">
                        <button class="btn btn-primary" id="sdas">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
    $(document).ready(function() {


        $('#myModal').on('hidden.bs.modal', function(e) {

            var $alertas = $('#submit_data');
            $alertas.validate().resetForm();
            $alertas.find('.error').removeClass('error');

            $alertas.find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();

        });


        $('#empTable').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': '<?php echo base_url();?>dashboard/ajexfile'
            },
            'columns': [{
                    data: 'name'
                },
                {
                    data: 'description'
                },
                {
                    data: 'image'
                },
                {
                    data: 'color'
                },
                {
                    data: 'p_type'
                },
                {
                    data: 'qty'
                },
                {
                    data: 'action'
                },
            ]
        });
    });

    $('#submit_data').submit(function(e) {
        e.preventDefault();
        e.stopPropagation();
        if ($("#submit_data").valid()) {
            $.ajax({
                url: '<?php echo base_url();?>pstore',
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    $('#empTable').DataTable().ajax.reload();
                    $('#myModal').modal('hide');

                }
            });
        } else {
            return false;
        }
        return false;
    });
    </script>

</div>