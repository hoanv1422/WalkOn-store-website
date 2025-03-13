// public/js/rating.js
const starFilled = '/img/comment/star-filled.png';  // Đường dẫn của hình ảnh đã đầy
const starEmpty = '/img/comment/star-empty.png';    // Đường dẫn của hình ảnh rỗng
document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating-input');
    const ratingResult = document.getElementById('rating-result');

    stars.forEach(star => {
        star.addEventListener('mouseover', function () {
            const value = this.getAttribute('data-value');
            updateStars(value);
        });

        star.addEventListener('mouseout', function () {
            updateStars(ratingInput.value);
        });

        star.addEventListener('click', function () {
            const value = this.getAttribute('data-value');
            ratingInput.value = value;
            ratingResult.textContent = value;
            updateStars(value);
        });
    });

    function updateStars(value) {
        stars.forEach(star => {
            if (parseInt(star.getAttribute('data-value')) <= value) {
                star.src = starFilled;  // Sử dụng biến chứa đường dẫn của hình ảnh đã đầy
            } else {
                star.src = starEmpty;   // Sử dụng biến chứa đường dẫn của hình ảnh rỗng
            }
        });
    }
    
});
