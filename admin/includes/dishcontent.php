<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản Lý Sản Phẩm</h1>
    <p class="mb-4">Chào mừng chủ nhân đến với trang quản lý sản phẩm ^-^!</p>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thêm Mới Sản Phẩm</h6>
                </div>
                <div class="card-body">
                   
                    <div class="form-group">
                        <label for="dishName">Dish Name:</label>
                        <input type="text" class="form-control" id="dishName">
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" id="price">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" id="description">
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="text" class="form-control" id="amount">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                   
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="text" class="form-control" id="image">
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <input type="text" class="form-control" id="status">
                    </div>
                    <div class="form-group">
                    <label for="cateID">CateID:</label>
                    <select class="form-control" id="cateID">
                       
                        <!-- Thêm các tùy chọn khác nếu cần -->
                    </select>
                </div>
                    <button class="btn btn-success" id="addButton">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTales Example 1 -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh Sách Món</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>DishID</th>
                            <th>DishName</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="js/dish/loadDish.js"></script>
<script src="js/dish/addDish.js"></script>
