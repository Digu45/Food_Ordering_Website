function addToCart(button) {
        // Get the menu details when the ADD button is clicked
        let card = button.closest('.card');
        let quantity = 1;  // Initial quantity when added to cart
        let menuId = card.querySelector('.menuId').innerText;
        let menuName = card.querySelector('.card-title').innerText;
        let description = card.querySelector('.card-text').innerText.split('₹')[0].trim(); // Correct extraction
        let rate = card.querySelector('.card-text').innerText.split('₹')[1].trim(); // Correct extraction
        let amount = quantity * parseFloat(rate);
        let menuTypeId = card.querySelector('img').src.includes('veg_icon.png') ? 1 : 2;

        // Immediately insert the record into the database using submit_order.php
        fetch('submit_order.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                MenuId: menuId,
                MenuName: menuName,
                Description: description,
                Rate: rate,
                Quantity: quantity,
                Amount: amount,
                MenuTypeID: menuTypeId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Item added to cart!');
                currentMenuId = data.menuID; // Store the menu ID for future updates
                
                // Increase cart count and update DOM
                cartCount += 1;
                updateCartCount(cartCount);

                // Update the card with menuId and menuTypeId
                card.querySelector('.menuId').innerText = menuId;
                card.querySelector('.menuTypeId').innerText = menuTypeId;
            } else {
                console.error('Failed to add item.');
            }
        })
        .catch(error => console.error('Error:', error));

        // Replace the "ADD" button with quantity controls
        button.outerHTML = `
            <div class="quantity-controls">
                <button class="btn btn-primary" onclick="decreaseQuantity(this)">-</button>
                <input type="text" value="1" readonly>
                <button class="btn btn-primary" onclick="increaseQuantity(this)">+</button>
            </div>
        `;
    }


    function updateOrder(button) {
        let card = button.closest('.card');
        let menuId = card.querySelector('.menuId').innerText;
        
        let menuName = card.querySelector('.card-title').innerText;
        let description = card.querySelector('.card-text').innerText.split('₹')[0].trim();
        let quantity = card.querySelector('input').value;
        let rate = card.querySelector('.card-text').innerText.split('₹')[1].trim();
        let amount = quantity * parseFloat(rate);
        let menuTypeId = card.querySelector('img').src.includes('veg_icon.png') ? 1 : 2;

        if (currentMenuId) {
            // Update the existing record in the database using update_order.php
            fetch('update_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    MenuId: menuId,
                    MenuName: menuName,
                    Description: description,
                    Quantity: quantity,
                    Amount: amount,
                    Rate: rate, // Ensure rate is sent
                    MenuTypeID: menuTypeId


                    MenuId: menuId,
                MenuName: menuName,
                Description: description,
                Rate: rate,
                Quantity: quantity,
                Amount: amount,
                MenuTypeID: menuTypeId
               
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Item updated in cart!');
                    
                    // Update the card with menuId and menuTypeId
                    card.querySelector('.menuId').innerText = menuId;
                    card.querySelector('.menuTypeId').innerText = menuTypeId;
                } else {
                    console.error('Failed to update item.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    function updateCartCount(count) {
        document.querySelector('.cart-count').innerText = count;
    }
