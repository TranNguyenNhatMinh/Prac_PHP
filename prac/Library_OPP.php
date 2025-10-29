<?php
// Lớp Book (Sách in)
class Book {
    private $title;
    private $author;
    private $year;

    public function __construct($title, $author, $year) {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }

    public function getBookInfo() {
        return "Tên sách: $this->title<br>Tác giả: $this->author<br>Năm xuất bản: $this->year<br>";
    }
}

// Lớp EBook (Sách điện tử) kế thừa Book
class EBook extends Book {
    private $fileSize;
    private $format;

    public function __construct($title, $author, $year, $fileSize, $format) {
        parent::__construct($title, $author, $year); // gọi lại hàm cha
        $this->fileSize = $fileSize;
        $this->format = $format;
    }

    // Ghi đè phương thức hiển thị thông tin
    public function getBookInfo() {
        return parent::getBookInfo() .
               "Dung lượng: $this->fileSize MB<br>Định dạng: $this->format<br>";
    }
}

// Tạo đối tượng
$book1 = new Book("Lập trình PHP", "Nguyễn Văn A", 2022);
$ebook1 = new EBook("PHP Nâng Cao", "Trần Thị B", 2024, 5.2, "PDF");

// Hiển thị
echo "<h3>Sách in:</h3>" . $book1->getBookInfo();
echo "<h3>Sách điện tử:</h3>" . $ebook1->getBookInfo();
?>
