fetch('./../api/v1/dish/get_all_dish.php')
    .then(response => response.json())
    .then(data => {
        const tableBody = document.querySelector('#dataTable tbody');
        data.forEach(dish => {
            const row = document.createElement('tr');
            const truncatedDishID = `${dish.DishID.slice(0, 8)}...${dish.DishID.slice(-8)}`;
            row.innerHTML = `
                <td>${truncatedDishID}</td>
                <td>${dish.DishName}</td>
                <td>${dish.Price}</td>
                <td>${dish.Description}</td>
                <td>${dish.Amount}</td>
                <td><img src="${dish.Image}" alt="Image" class="dish-image"></td>
                <td>${dish.Status}</td>
                <td>
                    <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-danger" data-dishid="${dish.DishID}">Delete</button>
                </td>
            `;
            tableBody.appendChild(row);
        });

        // Xử lý sự kiện khi nhấn nút "Delete"
        const deleteButtons = document.querySelectorAll('.btn-danger');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const dishID = this.getAttribute('data-dishid');
                const cateName = this.parentNode.parentNode.querySelector('td:nth-child(2)').textContent;

                // Hiển thị cửa sổ xác nhận
                const confirmation = confirm(`Bạn có muốn xoá ${cateName} khỏi danh mục?`);
                if (confirmation) {
                    // Gọi API để xóa danh mục
                    fetch('./../api/v1/dish/delete_dish.php', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            DishID: dishID
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            // Refresh trang sau khi xóa thành công
                            if (data.status === 'success') {
                                location.reload();
                            } else {
                                alert('Xảy ra lỗi khi xóa sanr phaamr. Vui lòng thử lại.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            });
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });