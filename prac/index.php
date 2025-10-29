<?php
session_start();

/**
 * Class Category (Danh mục)
 * - thuộc tính: id, name
 * - phương thức: __construct, getId, getName, display()
 */
class Category {
    private $id;
    private $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    // Trả về HTML hiển thị thông tin danh mục
    public function display() {
        return htmlspecialchars($this->id) . " — " . htmlspecialchars($this->name);
    }
}

/**
 * Class Product (Sản phẩm)
 * - thuộc tính: id, cat_id, title, thumbnail, price
 * - phương thức: __construct, getters, display()
 */
class Product {
    private $id;
    private $cat_id;
    private $title;
    private $thumbnail;
    private $price;

    public function __construct($id, $cat_id, $title, $thumbnail, $price) {
        $this->id = $id;
        $this->cat_id = $cat_id;
        $this->title = $title;
        $this->thumbnail = $thumbnail;
        $this->price = $price;
    }

    public function getId() {
        return $this->id;
    }

    public function getCatId() {
        return $this->cat_id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getThumbnail() {
        return $this->thumbnail;
    }

    public function getPrice() {
        return $this->price;
    }

    // Trả về HTML hiển thị thông tin sản phẩm (dùng tên danh mục nếu truyền vào)
    public function display($categoryName = null) {
        $id = htmlspecialchars($this->id);
        $title = htmlspecialchars($this->title);
        $thumb = htmlspecialchars($this->thumbnail);
        $price = number_format($this->price, 0, ',', '.');
        $cat = $categoryName ? htmlspecialchars($categoryName) : htmlspecialchars($this->cat_id);

        $html = "<div style='border:1px solid #ccc;padding:8px;margin:6px 0;border-radius:6px;'>";
        $html .= "<strong>$title</strong><br>";
        $html .= "ID: $id <br>";
        $html .= "Danh mục: $cat <br>";
        if ($thumb) {
            $html .= "<img src='$thumb' alt='$title' style='max-width:120px;display:block;margin-top:6px;'><br>";
        }
        $html .= "Giá: $price VND";
        $html .= "</div>";
        return $html;
    }
}

/* ===== Khởi tạo dữ liệu mẫu (2 category, 2 product) lưu trong session ===== */
if (!isset($_SESSION['categories']) || !isset($_SESSION['products'])) {
    // Tạo 2 danh mục
    $c1 = new Category('c1', 'Điện thoại');
    $c2 = new Category('c2', 'Laptop');

    // Tạo 2 sản phẩm
    $p1 = new Product('p1', 'c1', 'iPhone 14', 'https://via.placeholder.com/150?text=iPhone+14', 20000000);
    $p2 = new Product('p2', 'c2', 'MacBook Air', 'https://via.placeholder.com/150?text=MacBook+Air', 30000000);

    $_SESSION['categories'] = [$c1, $c2];
    $_SESSION['products'] = [$p1, $p2];
}

/* ===== Xử lý form submit ===== */
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Thêm danh mục
    if (isset($_POST['add_category'])) {
        $name = trim($_POST['category_name'] ?? '');
        if ($name === '') {
            $errors[] = "Tên danh mục không được để trống.";
        } else {
            // tạo id đơn giản: 'c' + timestamp + random
            $newId = 'c' . time() . rand(10,99);
            $newCat = new Category($newId, $name);
            $_SESSION['categories'][] = $newCat;
            // redirect để tránh resubmit (tùy chọn) — ở đây ta làm redirect nhẹ
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }

    // Thêm sản phẩm
    if (isset($_POST['add_product'])) {
        $title = trim($_POST['product_title'] ?? '');
        $cat_id = trim($_POST['product_cat'] ?? '');
        $thumbnail = trim($_POST['product_thumb'] ?? '');
        $price_raw = trim($_POST['product_price'] ?? '');

        if ($title === '') $errors[] = "Tên sản phẩm không được để trống.";
        if ($cat_id === '') $errors[] = "Phải chọn danh mục cho sản phẩm.";
        if ($price_raw === '') $errors[] = "Giá sản phẩm không được để trống.";

        // thử chuyển price sang số
        $price = 0;
        if ($price_raw !== '') {
            // loại bỏ dấu phẩy/dấu chấm nếu có
            $price_clean = str_replace([',', '.'], '', $price_raw);
            if (!ctype_digit($price_clean)) {
                $errors[] = "Giá phải là số (ví dụ: 15000000).";
            } else {
                $price = (int)$price_clean;
            }
        }

        // nếu ko lỗi -> tạo đối tượng và lưu
        if (empty($errors)) {
            $newId = 'p' . time() . rand(10,99);
            $newProd = new Product($newId, $cat_id, $title, $thumbnail, $price);
            $_SESSION['products'][] = $newProd;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }
}

/* ===== Hàm trợ giúp ===== */
// Lấy tên danh mục theo id (hoặc trả null)
function getCategoryNameById($id) {
    foreach ($_SESSION['categories'] as $c) {
        if ($c->getId() === $id) return $c->getName();
    }
    return null;
}
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Bài tập OOP PHP - Danh mục & Sản phẩm</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; max-width:900px;margin:20px auto;padding:0 12px; }
        .column { float:left; width:48%; margin-right:2%; }
        .column + .column { margin-right:0; }
        .clearfix::after { content:"";display:block;clear:both; }
        form { border:1px solid #eee;padding:12px;border-radius:8px;background:#fafafa; }
        label { display:block;margin-top:8px; }
        input[type=text], select { width:100%; padding:6px;border:1px solid #ccc;border-radius:4px; }
        input[type=submit] { margin-top:10px;padding:8px 12px;border-radius:6px;border:none;background:#007bff;color:white;cursor:pointer; }
        .error { color: #b00020; }
        h2 { margin-top:0; }
    </style>
</head>
<body>
    <h1>Bài tập OOP PHP — Danh mục & Sản phẩm</h1>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $e): ?>
                    <li><?=htmlspecialchars($e)?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="clearfix">
        <div class="column">
            <h2>Form: Thêm danh mục</h2>
            <form method="post">
                <label for="category_name">Tên danh mục:</label>
                <input id="category_name" name="category_name" type="text" placeholder="Ví dụ: Máy ảnh">

                <input type="submit" name="add_category" value="Tạo danh mục">
            </form>

            <h3>Danh sách danh mục (hiện có)</h3>
            <?php foreach ($_SESSION['categories'] as $cat): ?>
                <div><?= $cat->display(); ?></div>
            <?php endforeach; ?>
        </div>

        <div class="column">
            <h2>Form: Thêm sản phẩm</h2>
            <form method="post">
                <label for="product_title">Tên sản phẩm:</label>
                <input id="product_title" name="product_title" type="text" placeholder="Ví dụ: Samsung Galaxy S22">

                <label for="product_cat">Chọn danh mục:</label>
                <select id="product_cat" name="product_cat">
                    <option value="">-- Chọn --</option>
                    <?php foreach ($_SESSION['categories'] as $cat): ?>
                        <option value="<?=htmlspecialchars($cat->getId())?>"><?=htmlspecialchars($cat->getName())?></option>
                    <?php endforeach; ?>
                </select>

                <label for="product_thumb">Thumbnail (URL):</label>
                <input id="product_thumb" name="product_thumb" type="text" placeholder="https://...">

                <label for="product_price">Giá (chỉ nhập số, không nhập chữ):</label>
                <input id="product_price" name="product_price" type="text" placeholder="Ví dụ: 15000000">

                <input type="submit" name="add_product" value="Tạo sản phẩm">
            </form>

            <h3>Danh sách sản phẩm (hiện có)</h3>
            <?php foreach ($_SESSION['products'] as $prod): 
                $catName = getCategoryNameById($prod->getCatId());
            ?>
                <?= $prod->display($catName); ?>
            <?php endforeach; ?>
        </div>
    </div>

    <hr>
    <small>Ghi chú: mã này lưu tạm trong session nên sẽ mất khi xóa session / restart server. ID ở đây đơn giản để demo.</small>
</body>
</html>

<!-- Giải thích (dễ hiểu, từng bước)

Hai lớp (class):

Category: có id và name. display() trả về chuỗi HTML ngắn để in thông tin.

Product: có id, cat_id (id danh mục), title, thumbnail, price. display($categoryName) in chi tiết, kèm ảnh (nếu có).

Lưu trữ tạm:

Dùng $_SESSION để giữ danh sách đối tượng giữa các lần tải trang. PHP sẽ serialize object vào session — thuận tiện cho bài tập nhỏ này.

Khởi tạo ban đầu:

Nếu chưa có giá trị trong session thì tạo 2 Category và 2 Product mẫu (để bạn thấy kết quả ngay).

Form:

Form danh mục: nhập name => gửi add_category.

Form sản phẩm: nhập title, chọn cat_id (select), nhập thumbnail (URL), price => gửi add_product.

Xử lý submit:

Kiểm tra dữ liệu hợp lệ, tạo đối tượng new Category(...) hoặc new Product(...), push vào $_SESSION[...] và redirect để tránh submit lại khi reload.

Hiển thị:

Duyệt $_SESSION['categories'] và $_SESSION['products'] để in ra. Với sản phẩm, ta tìm tên danh mục tương ứng để hiển thị thay vì chỉ hiện cat_id.

Gợi ý mở rộng (nếu bạn muốn nâng cấp)

Thay $_SESSION bằng lưu vào file JSON hoặc database (MySQL) để lưu lâu dài.

Thêm chức năng sửa / xóa (edit / delete).

Thêm kiểm tra URL ảnh tồn tại hoặc resize thumbnail.

Thêm validation chi tiết cho giá, tên. -->