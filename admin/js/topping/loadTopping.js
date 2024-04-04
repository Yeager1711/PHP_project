fetch('./../api/v1/topping/get_all_topping.php')
    .then(response => response.json())
    .then(data => {
        const tableBody = document.querySelector('#dataTable tbody');
        data.forEach(topping => {
            const row = document.createElement('tr');
            const truncatedToppingID = `${topping.ToppingID.slice(0, 8)}...${topping.ToppingID.slice(-8)}`;
            row.innerHTML = `
                <td>${truncatedToppingID}</td>
                <td>${topping.Name}</td>
                <td>${topping.Description}</td>
                <td>${topping.Price}</td>
                <td>
                    <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-danger" data-toppingid="${topping.ToppingID}">Delete</button>
                </td>
            `;
            tableBody.appendChild(row);
        });

        // Xử lý sự kiện khi nhấn nút "Delete"
        const deleteButtons = document.querySelectorAll('.btn-danger');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const toppingID = this.getAttribute('data-toppingid');
                const toppingName = this.parentNode.parentNode.querySelector('td:nth-child(2)').textContent;

                // Hiển thị cửa sổ xác nhận 
                const confirmation = confirm(`Bạn có muốn xoá ${toppingName} ?`);
                if (confirmation) {
                    // Gọi API để xóa danh mục
                    fetch('./../api/v1/topping/delete_topping.php?ToppingID=${toppingID}', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            ToppingID: toppingID
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            // Refresh trang sau khi xóa thành công
                            if (data.status === 'success') {
                                location.reload();
                            } else {
                                alert('Xảy ra lỗi khi xóa danh mục. Vui lòng thử lại.');
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