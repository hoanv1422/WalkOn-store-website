@extends('client.layouts.app')

@section('title', 'Giỏ Hàng')
@section('breadcrumb', 'Giỏ Hàng')

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.cart.shopping-cart')
@endsection

@section('script')


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize cart
            fetchCartItems();

            /**
             * Fetches cart items from the API and renders them
             */
            function fetchCartItems() {
                const tableBody = document.querySelector(".table-responsive tbody");
                if (tableBody) {
                    tableBody.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </td>
                </tr>`;
                }

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

                fetch("/api/cart", {
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                            Accept: "application/json",
                        },
                    })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then((data) => {
                        if (data.success) {
                            renderCartItems(data.data);



                        } else {
                            showError("Could not load cart items");
                        }
                    })
                    .catch((error) => {
                        console.error("Fetch cart error:", error);
                        showError("Failed to connect to server. Please try again later.");
                    });

            }

            /**
             * Shows error message to user
             * @param {string} message - Error message to display
             */
            function showError(message) {
                const tableBody = document.querySelector(".table-responsive tbody");
                if (tableBody) {
                    tableBody.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center text-danger">
                        ${message}
                    </td>
                </tr>`;
                }
            }

            /**
             * Renders cart items in the table
             * @param {Array} cartItems - The cart items from the API
             */
            function renderCartItems(cartItems) {
                const tableBody = document.querySelector(".table-responsive tbody");
                if (!tableBody) {
                    console.error("Table body not found");
                    return;
                }

                tableBody.innerHTML = "";

                if (cartItems.length === 0) {
                    tableBody.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center">
                        <h6>Giỏ hàng của bạn đang trống.</h6>
                    </td>
                </tr>`;
                    window.cartFunctions.updateTotalPrice();
                    return;
                }

                cartItems.forEach((cartItem) => {
                    const row = document.createElement("tr");

                    let priceDisplay = "";
                    const variant = cartItem.product_variant || {};
                    if (variant.price_sale && variant.price_sale < variant.price) {
                        priceDisplay = `
                    <span class="text-muted text-decoration-line-through small">
                        ${new Intl.NumberFormat("vi-VN").format(variant.price)} VND
                    </span>
                    <span class="text-danger fw-bold">
                        ${new Intl.NumberFormat("vi-VN").format(variant.price_sale)} VND
                    </span>`;
                    } else {
                        priceDisplay =
                            `<span>${new Intl.NumberFormat("vi-VN").format(variant.price || 0)} VND</span>`;
                    }

                    // Create image path
                    let imagePath = variant.image ? `/storage/${variant.image}` : "/img/default-image.jpg";

                    row.innerHTML = `
                <td class="align-middle">
                    <input type="checkbox" class="cartItemCheckbox" value="${cartItem.id}" 
                           data-price="${cartItem.formatted_price || 0}">
                </td>
                <td class="cart-item-img" style="width: 100px; height: 100px; overflow:hidden">
                    <a href="/product/${variant.product?.slug || "#"}">
                        <img src="${imagePath}" alt="${variant.product?.name || "Product"}"
                            style="height: 100%; width: 100%; object-fit: cover;">
                    </a>
                </td>
                <td class="cart-product-name">
                    <a href="/product/${variant.product?.slug || "#"}">
                        ${variant.product?.name || "Unknown Product"}
                    </a>
                </td>
                <td class="align-middle">
                    <a href="#">${variant.size?.size || "N/A"}</a>
                </td>
                <td class="align-middle">
                    <div style="width: 24px; height: 24px; border: 1px solid #ccc; 
                         background-color: ${variant.color?.code || "#fff"}; border-radius: 4px;">
                    </div>
                </td>
                <td class="unit-price">
                    ${priceDisplay}
                </td>
                <td class="quantity align-middle">
                    <div class="input-group mb-2" data-cart-item-id="${cartItem.id}">
                        <button type="button" class="btn btn-outline-secondary btn-minus">-</button>
                        <input style="width: 50px" type="text" class="form-control form-control-sm text-center qtyInput"
                               id="qtyInput-${cartItem.id}" value="${cartItem.quantity || 1}" readonly>
                        <button type="button" class="btn btn-outline-secondary btn-plus">+</button>
                    </div>
                </td>
                <td class="subtotal">
                    <span class="text-danger fw-bold displayPrice" data-cart-item-id="${cartItem.id}">
                        ${new Intl.NumberFormat("vi-VN").format(cartItem.formatted_price || 0)} VND
                    </span>
                </td>
                <td class="remove-icon align-middle">
                    <button type="button" class="btn btn-danger btn-delete-cart-item" 
                            data-cart-item-id="${cartItem.id}">
                        Xóa
                    </button>
                </td>
            `;

                    tableBody.appendChild(row);
                });

                initializeCartFunctionality();
                window.cartFunctions.updateTotalPrice();
            }

            /**
             * Safely parses a value to float, returns 0 if invalid
             * @param {*} value - The value to parse
             * @returns {number} - The parsed float or 0 if invalid
             */
            function safeParseFloat(value) {
                const parsed = parseFloat(value);
                return isNaN(parsed) ? 0 : parsed;
            }

            /**
             * Initializes cart functionality (checkboxes, quantity controls, delete buttons)
             */
            function initializeCartFunctionality() {
                const selectAll = document.getElementById("selectAll");
                const checkboxes = document.querySelectorAll(".cartItemCheckbox");
                const cartItemsInput = document.getElementById("cartItems");
                const displayTotalPrice = document.getElementById("displayTotalPrice");
                const checkoutButton = document.getElementById("checkoutButton");

                // Initialize select all checkbox
                if (selectAll) {
                    selectAll.checked = true;
                    checkboxes.forEach((checkbox) => (checkbox.checked = true));
                }

                // Define updateTotalPrice in outer scope
                window.cartFunctions.updateTotalPrice = function() {
                    let totalPrice = 0;
                    let selectedCount = 0;
                    const checkboxes = document.querySelectorAll(
                    ".cartItemCheckbox"); // Lấy lại danh sách checkbox

                    if (checkboxes.length === 0) {
                        // Nếu không có checkbox (giỏ hàng trống), đặt tổng giá về 0
                        if (displayTotalPrice) {
                            displayTotalPrice.textContent = "0 VND";
                        }
                        if (checkoutButton) {
                            checkoutButton.disabled = true;
                        }
                        return;
                    }

                    checkboxes.forEach((checkbox) => {
                        if (checkbox.checked) {
                            const price = safeParseFloat(checkbox.dataset.price);
                            totalPrice += price;
                            selectedCount++;
                        }
                    });


                    if (displayTotalPrice) {
                        displayTotalPrice.textContent = new Intl.NumberFormat("vi-VN", {
                                style: "currency",
                                currency: "VND",
                                maximumFractionDigits: 0,
                            })
                            .format(totalPrice)
                            .replace("₫", "VND");
                    }


                    if (checkoutButton) {
                        checkoutButton.disabled = selectedCount === 0;
                    }
                };

                /**
                 * Updates the hidden input with selected cart item IDs
                 */
                function updateSelectedIds() {
                    if (!cartItemsInput) return;

                    const selectedIds = Array.from(checkboxes)
                        .filter((checkbox) => checkbox.checked)
                        .map((checkbox) => checkbox.value);

                    cartItemsInput.value = selectedIds.join(",");
                    window.cartFunctions.updateTotalPrice();
                }

                // Event listeners for select all checkbox
                if (selectAll) {
                    selectAll.addEventListener("change", () => {
                        checkboxes.forEach((checkbox) => (checkbox.checked = selectAll.checked));
                        updateSelectedIds();
                    });
                }

                // Event listeners for individual checkboxes
                checkboxes.forEach((checkbox) => {
                    checkbox.addEventListener("change", () => {
                        if (selectAll) {
                            selectAll.checked = Array.from(checkboxes).every((cb) => cb.checked);
                        }
                        updateSelectedIds();
                    });
                });

                // Setup quantity controls
                document.querySelectorAll(".input-group").forEach((group) => {
                    const cartItemId = group.dataset.cartItemId;
                    if (!cartItemId) return;

                    const input = group.querySelector(".qtyInput");
                    const minusBtn = group.querySelector(".btn-minus");
                    const plusBtn = group.querySelector(".btn-plus");

                    if (!input) return;

                    input.dataset.oldValue = input.value;

                    if (minusBtn) {
                        minusBtn.addEventListener("click", () => {
                            updateQuantity(cartItemId, input, -1);
                        });
                    }

                    if (plusBtn) {
                        plusBtn.addEventListener("click", () => {
                            updateQuantity(cartItemId, input, 1);
                        });
                    }
                });

                // Setup delete buttons
                document.querySelectorAll(".btn-delete-cart-item").forEach((button) => {
                    button.addEventListener("click", () => {
                        const cartItemId = button.dataset.cartItemId;
                        if (cartItemId) {
                            deleteCartItem(cartItemId);
                        }
                    });
                });

                // Initial update
                updateSelectedIds();
            }

            /**
             * Updates the quantity of a cart item
             * @param {string} cartItemId - The ID of the cart item
             * @param {HTMLInputElement} input - The quantity input element
             * @param {number} change - The change in quantity (+1, -1)
             */
            function updateQuantity(cartItemId, input, change) {
                let currentQuantity = parseInt(input.value) || 1;
                let updatedQuantity = currentQuantity + change;

                if (updatedQuantity < 1) {
                    updatedQuantity = 1;
                    if (currentQuantity === 1) return;
                }

                input.value = updatedQuantity;
                const parentRow = input.closest("tr");
                if (parentRow) {
                    parentRow.classList.add("updating");
                }

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                if (!csrfToken) {
                    input.value = currentQuantity;
                    alert("CSRF token not found. Please refresh the page.");
                    if (parentRow) parentRow.classList.remove("updating");
                    return;
                }

                fetch("/api/cart/update", {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                            Accept: "application/json",
                        },
                        body: JSON.stringify({
                            cart_item_id: cartItemId,
                            quantity: updatedQuantity,
                        }),
                    })
                    .then((response) => {
                        if (!response.ok) {
                            return response.json().then((errorData) => {
                                throw new Error(errorData.message ||
                                    `HTTP error! status: ${response.status}`);
                            });
                        }
                        return response.json();
                    })
                    .then((data) => {
                        if (data.success) {

                            input.value = data.cart_item.quantity;
                            input.dataset.oldValue = data.cart_item.quantity;

                            const priceElement = document.querySelector(
                                `span.displayPrice[data-cart-item-id="${cartItemId}"]`
                            );
                            if (priceElement) {
                                priceElement.textContent =
                                    new Intl.NumberFormat("vi-VN").format(data.item_total_price_raw || 0) +
                                    " VND";
                            }

                            const checkbox = document.querySelector(`.cartItemCheckbox[value="${cartItemId}"]`);
                            if (checkbox) {
                                const newPrice = safeParseFloat(data.item_total_price_raw || 0);
                                checkbox.dataset.price = newPrice;
                            }

                            // Call updateTotalPrice via window.cartFunctions
                            window.cartFunctions.updateTotalPrice();
                        } else {
                            input.value = currentQuantity;
                            alert(data.message || "Unable to update quantity.");
                        }
                    })
                    .catch((error) => {
                        console.error("Update quantity error:", error.message);
                        input.value = currentQuantity;
                        alert(error.message || "Could not connect to server. Please try again later.");
                    })
                    .finally(() => {
                        if (parentRow) {
                            parentRow.classList.remove("updating");
                        }
                    });
            }

            /**
             * Deletes a cart item
             * @param {string} cartItemId - The ID of the cart item to delete
             */
            function deleteCartItem(cartItemId) {
                if (!confirm("Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?")) return;

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

                fetch(`/api/cart/delete/${cartItemId}`, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                            Accept: "application/json",
                        },
                    })
                    .then((response) => {
                        if (!response.ok) {
                            return response.json().then((errorData) => {
                                throw new Error(errorData.message ||
                                    `HTTP error! status: ${response.status}`);
                            });
                        }
                        return response.json();
                    })
                    .then((data) => {
                        if (data.success) {
                            fetchCartItems();
                        } else {
                            console.error("Delete error:", data.message);
                            alert(data.message || "Unable to delete item.");
                        }
                    })
                    .catch((error) => {
                        console.error("Delete error:", error.message);
                        alert(error.message || "Could not connect to server. Please try again later.");
                    });
            }


            const clearCartButton = document.getElementById('clearCartButton');
            if (clearCartButton) {
                clearCartButton.addEventListener('click', function() {
                    if (confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm khỏi giỏ hàng?')) {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                        if (!csrfToken) {
                            alert('CSRF token not found. Please refresh the page.');
                            return;
                        }

                        fetch('/api/cart/clear', {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    return response.json().then(errorData => {
                                        throw new Error(errorData.message ||
                                            `HTTP error! status: ${response.status}`);
                                    });
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    fetchCartItems();
                                } else {
                                    alert(data.message || 'Could not clear cart.');
                                }
                            })
                            .catch(error => {
                                console.error('Clear cart error:', error.message);
                                alert(error.message ||
                                    'Could not connect to server. Please try again later.');
                            });
                    }
                });
            }

            // Expose functions for debugging
            window.cartFunctions = {
                fetchCartItems,
                renderCartItems,
                updateTotalPrice: function() {}, // Placeholder, will be overwritten
                updateSelectedIds: function() {}, // Placeholder, will be overwritten
                safeParseFloat,
                updateQuantity,
                deleteCartItem,
            };
        });
    </script>


@endsection
