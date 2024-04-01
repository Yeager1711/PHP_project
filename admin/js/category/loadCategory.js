fetch('./../api/v1/category/get_all_category.php')
    .then(response => response.json())
    .then(data => {
        const tableBody = document.querySelector('#dataTable tbody');
        data.forEach(category => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${category.CateID}</td>
                <td>${category.CateName}</td>
                <td><img src="${category.Image}" alt="Image"></td>
                <td>
                    <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-danger" data-cateid="${category.CateID}">Delete</button>
                </td>
            `;
            tableBody.appendChild(row);
        });

        // Xử lý sự kiện khi nhấn nút "Delete"
        const deleteButtons = document.querySelectorAll('.btn-danger');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const cateID = this.getAttribute('data-cateid');
                const cateName = this.parentNode.parentNode.querySelector('td:nth-child(2)').textContent;

                // Hiển thị cửa sổ xác nhận
                const confirmation = confirm(`Bạn có muốn xoá ${cateName} khỏi danh mục?`);
                if (confirmation) {
                    // Gọi API để xóa danh mục
                    fetch('./../api/v1/category/delete_category.php', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            CateID: cateID
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