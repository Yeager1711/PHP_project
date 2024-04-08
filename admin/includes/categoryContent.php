<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản Lý Danh Mục</h1>
    <p class="mb-4">Chào mừng chủ nhân đến với trang quản lý danh mục ^-^!</p>

    <!-- DataTales Example 2 -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm Mới Danh Mục</h6>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="categoryName">Category Name:</label>
            <input type="text" class="form-control" id="categoryName">
        </div>
        <div class="form-group">
            <label for="imagePath">Image Path:</label>
            <input type="text" class="form-control" id="imagePath">
        </div>
        <button class="btn btn-success" id="addButton">Add</button>
    </div>
</div>

    <!-- DataTales Example 1 -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh Sách Danh Mục</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Category ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            </div>
        </div>
    </div>

</div>
<script src="js/category/addCategory.js"></script>
<script src="js/category/loadCategory.js"></script>
