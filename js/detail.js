
    (function() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "./api/v1/drinks/get_drink.php?DrinksID=14",true);
        xhr.responseType = "text";
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
              
                console.log(response);
               
                var detailSection = document.querySelector("section.details");

                var detailContainer = document.createElement("div");
                detailContainer.className = "detail-container";

                var imageDiv = document.createElement("div");
                imageDiv.className = "image";

                var image = document.createElement("img");
                image.src = response.Image;
                image.alt = "";
                imageDiv.appendChild(image);

                var contentDiv = document.createElement("div");
                contentDiv.className = "content";

                var drinkName = document.createElement("h3");
                drinkName.className = "drinkName";
                drinkName.textContent = response.DrinkName;

                var menuSpan = document.createElement("span");
                menuSpan.className = "menu";
                menuSpan.innerHTML = "Loại: <p>" + response.MenuID + "</p>";

                var priceSpan = document.createElement("span");
                priceSpan.className = "price";
                priceSpan.innerHTML = "Giá: <p>" + response.Price + "</p>";

                var description = document.createElement("p");
                description.className = "describle";
                description.textContent = response.Describe;

                var quantitySelector = document.createElement("div");
                quantitySelector.className = "quantity-selector";

                var decreaseBtn = document.createElement("button");
                decreaseBtn.className = "quantity-btn decrease-btn";
                decreaseBtn.textContent = "-";
                quantitySelector.appendChild(decreaseBtn);

                var quantityInput = document.createElement("input");
                quantityInput.type = "text";
                quantityInput.className = "quantity-input";
                quantityInput.value = "1";
                quantitySelector.appendChild(quantityInput);

                var increaseBtn = document.createElement("button");
                increaseBtn.className = "quantity-btn increase-btn";
                increaseBtn.textContent = "+";
                quantitySelector.appendChild(increaseBtn);

                var addToCartBtn = document.createElement("button");
                addToCartBtn.className = "btn-addToCart";
                addToCartBtn.textContent = "Thêm vào giỏ hàng";

                contentDiv.appendChild(drinkName);
                contentDiv.appendChild(menuSpan);
                contentDiv.appendChild(priceSpan);
                contentDiv.appendChild(description);
                contentDiv.appendChild(quantitySelector);
                contentDiv.appendChild(addToCartBtn);

                detailContainer.appendChild(imageDiv);
                detailContainer.appendChild(contentDiv);

                detailSection.appendChild(detailContainer);
            }
        };
        xhr.send();
    })();
