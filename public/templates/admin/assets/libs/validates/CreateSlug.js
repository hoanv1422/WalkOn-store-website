function removeVietnameseTones(str) {
    var map = {
        à: "a",
        á: "a",
        ả: "a",
        ã: "a",
        ạ: "a",
        ă: "a",
        ằ: "a",
        ắ: "a",
        ẳ: "a",
        ẵ: "a",
        ặ: "a",
        â: "a",
        ầ: "a",
        ấ: "a",
        ẩ: "a",
        ẫ: "a",
        ậ: "a",
        è: "e",
        é: "e",
        ẻ: "e",
        ẽ: "e",
        ẹ: "e",
        ê: "e",
        ề: "e",
        ế: "e",
        ể: "e",
        ễ: "e",
        ệ: "e",
        ì: "i",
        í: "i",
        ỉ: "i",
        ĩ: "i",
        ị: "i",
        ò: "o",
        ó: "o",
        ỏ: "o",
        õ: "o",
        ọ: "o",
        ô: "o",
        ồ: "o",
        ố: "o",
        ổ: "o",
        ỗ: "o",
        ộ: "o",
        ơ: "o",
        ờ: "o",
        ớ: "o",
        ở: "o",
        ỡ: "o",
        ợ: "o",
        ù: "u",
        ú: "u",
        ủ: "u",
        ũ: "u",
        ụ: "u",
        ư: "u",
        ừ: "u",
        ứ: "u",
        ử: "u",
        ữ: "u",
        ự: "u",
        ỳ: "y",
        ý: "y",
        ỷ: "y",
        ỹ: "y",
        ỵ: "y",
        đ: "d",
    };

    return str.replace(
        /[àáảãạăắằẳẵặâấầẩẫậèéẻẽẹêếềểễệìíỉĩịòóỏõọôốồổỗộơớờởỡợùúủũụưứừửữựỳýỷỹỵđ]/g,
        function (match) {
            return map[match];
        }
    );
}

function createSlug(str) {
    str = removeVietnameseTones(str); // Loại bỏ dấu tiếng Việt
    return str
        .toLowerCase() // Chuyển thành chữ thường
        .trim() // Loại bỏ khoảng trắng thừa đầu và cuối
        .replace(/[^\w\s-]/g, "") // Xóa ký tự đặc biệt
        .replace(/[\s_-]+/g, "-") // Thay thế khoảng trắng hoặc dấu gạch dưới bằng dấu gạch ngang
        .replace(/^-+|-+$/g, ""); // Loại bỏ dấu gạch ngang thừa ở đầu và cuối
}
