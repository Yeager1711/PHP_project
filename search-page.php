<!DOCTYPE html>
<html>
<head>
    <title>Trang Tìm Kiếm</title>
</head>
<body>
    <h1>Tìm kiếm</h1>
    <form action="search.php" method="get">
        <input type="text" name="query" placeholder="Nhập từ khóa tìm kiếm...">
        <button type="submit">Tìm kiếm</button>
    </form>

    <div class="results">
    <h1>Kết quả tìm kiếm</h1>
    <?php
    // Kiểm tra xem đã nhập từ khóa tìm kiếm chưa
    if (isset($_GET['query'])) {
        $query = $_GET['query'];

        // Gọi API để lấy tất cả các món ăn
        $url = '/api/v1/dish/get_all_dish.php'; // Thay đổi đường dẫn API của bạn
        $data = array('query' => $query);
        echo "Data: ";
        print_r($data); // or var_dump($data);

        
        // Gửi yêu cầu GET đến API
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'GET',
                'content' => http_build_query($data),
            ),
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        // Xử lý kết quả trả về từ API
        $response = json_decode($result, true);

        // Hiển thị kết quả
        if (!empty($response)) {
            foreach ($response as $dish) {
                echo "<p>Tên món ăn: " . $dish['DishName'] . ", Loại sản phẩm: " . $dish['category'] . "</p>";
            }
        } else {
            echo "Không tìm thấy kết quả.";
        }
    } else {
        echo "Vui lòng nhập từ khóa tìm kiếm.";
    }
    ?>
    </div>
</body>
</html>
