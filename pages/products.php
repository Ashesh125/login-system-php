<?php
require("../components/dashboard_nav.php");
?>
<div class="mt-5 d-flex flex-column container-fluid main-body">
    <h2 class="topic">Products</h2>
    <div>
        <!-- Button trigger modal -->
        <button type="button" id="btn-1" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
            New
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">Add<div class="topic"></div>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-product" class="row g-3 d-flex flex-wrap needs-validation" method="POST" action="<?= HOST ?>/controller/productController.php" enctype="multipart/form-data" novalidate>
                        <div class="col-md-4">
                            <label for="name" class="form-label fw-bold">
                                Name
                            </label>
                            <input type="hidden" class="form-control" name="id" id="id" value="0" required>
                            <input type="text" class="form-control" name="name" id="name" value="" required>
                            <div class="invalid-feedback">
                                Cannot be Empty!
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="price" class="form-label fw-bold">
                                Price
                            </label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">Rs</span>
                                <input type="number" class="form-control" id="price" name="price" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback  invalid-price">
                                    Invalid Price.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="discount" class="form-label fw-bold">
                                Discount
                            </label>
                            <div class="input-group has-validation">
                                <input type="number" class="form-control" id="discount" name="discount" aria-describedby="percentage" required>
                                <span class="input-group-text" id="percentage">%</span>
                                <div class="invalid-feedback invalid-discount">
                                    Invalid Discount.
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <label for="item" class="form-label fw-bold">
                                Item Id
                            </label>
                            <input type="text" class="form-control" name="item" id="item" value="" required>
                            <div class="invalid-feedback">
                                Invalid Item Id!
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="qty" class="form-label fw-bold">
                                Stock
                            </label>
                            <input type="number" class="form-control" name="qty" id="qty" value="" required>
                            <div class="invalid-feedback">
                                Invalid Stock Amount!
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="image" class="form-label fw-bold">Image</label>
                            <input class="form-control" type="file" name="image" id="image">
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" id="submit" type="submit">Submit</button>
                            <button class="btn btn-danger" id="deleteBtn" style="display:none;">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table id="data-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Item ID</th>
                <th>Price (Rs)</th>
                <th>Discount (%)</th>
                <th>Qty</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<div></div>
<script>
    $(document).ready(function() {
        $('#product').addClass("active");

        var table = $('#data-table').DataTable({
            dom: 'frtipB',
            buttons: [
                'print'
            ],
            ajax: {
                url: host + "/controller/productController.php?type=fetchAll",
                dataSrc: 'datas'
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'item'
                },
                {
                    data: 'price'
                },
                {
                    data: 'discount'
                },
                {
                    data: 'qty'
                },
                {
                    data: 'image'
                }

            ],
            "columnDefs": [{
                "targets": [0],
                "visible": false,
                "searchable": false
            }],
            order: [
                [0, 'desc']
            ],
        });


        $('#form-product').on('submit', function() {
            let chk = true;
            chk = chk && checkName($('#name').val()) ? $('#name').addClass("is-valid") : $('#name').addClass("is-invalid");
            chk = chk && checkPrice($('#price').val()) ? $('#price').addClass("is-valid") : $('#price').addClass("is-invalid");
            chk = chk && checkSizes($('#sizes').val()) ? $('#sizes').addClass("is-valid") : $('#sizes').addClass("is-invalid");


            if (chk) {
                return true;
            } else {
                return false;
            }
        });

        $('#deleteBtn').on('click', function() {
            if (confirm("Confirm Delete")) {
                let del = $('#id').val();
                $.ajax({
                    method: "POST",
                    url: host + "/controller/productController.php",
                    data: {
                        id: del,
                        name: ""
                    }
                }).done(function(msg) {
                    table.row($(this).parents('tr')).remove().draw(false);
                    $('#myModal').modal('hide');
                    alert("Data Deleted!!");
                    window.location.reload();
                });
            }
        });

        $('#data-table tbody').on('click', 'tr', function() {
            var data = table.row(this).data();
            $('#deleteBtn').show();

            $('#id').val(data['id']);
            $('#name').val(data['name']);
            $('#price').val(data['price']);
            $('#item').val(data['item']);
            $('#discount').val(data['discount']);
            $('#qty').val(data['qty']);


            $('#myModal').modal('show');
        });
    });
</script>
<script src="<?= HOST ?>/script/data_table_extra.js"></script>
</body>

</html>