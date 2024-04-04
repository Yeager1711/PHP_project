const addButton = document.getElementById('addButton');
addButton.addEventListener('click', () => {
    const toppingName = document.getElementById('toppingName').value;
    const description = document.getElementById('description').value;
    const toppingPrice = document.getElementById('toppingPrice').value;
    // Call API to create a new category
    fetch('./../api/v1/topping/create_topping.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            Name: toppingName,
            Description: description,
            Price: toppingPrice
        })
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
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