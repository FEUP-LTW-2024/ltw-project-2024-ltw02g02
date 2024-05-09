const heartIcon = document.getElementById('heart');

function isAdded(user_id, item_id) {
    return new Promise((resolve, reject) => {
        const request = new XMLHttpRequest();
        request.open('POST', '../php/wishlist_check.php');
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const response = JSON.parse(this.responseText);
                resolve(response.exists);
            }
        };
        request.send(JSON.stringify({ user_id: user_id, item_id: item_id }));
    });
}

function wishlistAction(user_id, item_id) {
    isAdded(user_id, item_id)
        .then(isInWishlist => {
            console.log(isInWishlist);
            if (isInWishlist) {
                removeFromWishlist(user_id, item_id);
            } else {
                addToWishlist(user_id, item_id);
            }
            console.log('Action complete');
        })
        .catch(error => {
            console.error('Error:', error);
        });
}


function addToWishlist(user_id, item_id) {
    const request = new XMLHttpRequest();
    request.open('post','../php/action_wishlist.php');
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(JSON.stringify({user_id: user_id, item_id: item_id, action: 'add'}));

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const response = JSON.parse(this.responseText);
            if (response.success) {
                if (heartIcon != null) {
                    heartIcon.classList.add('bi-heart-fill');
                    heartIcon.classList.remove('bi-heart');
                }
                console.log("Item added to wishlist");
            } else {
                console.log("Failed to add item to wishlist");
            }
        }
    };
}

function removeFromWishlist(user_id, item_id) {
    const request = new XMLHttpRequest();
    request.open('post','../php/action_wishlist.php');
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(JSON.stringify({user_id: user_id, item_id: item_id, action: 'remove'}));

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const response = JSON.parse(this.responseText);
            if (response.success) {
                if (heartIcon != null) {
                    heartIcon.classList.remove('bi-heart-fill');
                    heartIcon.classList.add('bi-heart');
                }
                const wishlistItem = document.getElementById(item_id);
                if (wishlistItem != null) {
                    wishlistItem.remove();
                }
                console.log("Item removed from wishlist");
            } else {
                console.log("Failed to remove item from wishlist");
            }
        }
    };
}