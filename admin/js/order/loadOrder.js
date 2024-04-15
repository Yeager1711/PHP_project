fetch('./../api/v1/account/orders/get_all_orders.php')
    .then(response => response.json())
    .then(data => {
        const tableBody = document.querySelector('#ordersTable tbody');
        
        // Kiểm tra xem data có thuộc tính 'data' không
        if (!data.hasOwnProperty('data')) {
            console.error('Error: Data does not have "data" property');
            return;
        }

        const orders = data.data;

        // Kiểm tra xem orders có phải là mảng không
        if (!Array.isArray(orders)) {
            console.error('Error: Data is not an array');
            return;
        }

        // Nếu orders là mảng, tiếp tục xử lý
        orders.forEach(order => {
            const row = document.createElement('tr');
            const truncatedOrderID = `${order.OrderID.slice(0, 8)}...${order.OrderID.slice(-8)}`;
            row.innerHTML = `
                <td>${truncatedOrderID}</td>
                <td>${order.CreatedAt}</td>
                <td>${order.AccountID}</td>
                <td>${order.TotalAmount}</td>
               
            `;
            tableBody.appendChild(row);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
