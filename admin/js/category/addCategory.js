const addButton = document.getElementById('addButton');
addButton.addEventListener('click', () => {
    const categoryName = document.getElementById('categoryName').value;
    const imagePath = document.getElementById('imagePath').value;

    // Call API to create a new category
    fetch('./../api/v1/category/create_category.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            CateName: categoryName,
            Image: imagePath
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload();
            } else {
                // Display error message
                alert('Xảy ra lỗi khi tạo danh mục. Vui lòng thử lại.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});