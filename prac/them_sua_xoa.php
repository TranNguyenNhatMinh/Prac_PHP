<?php
$actionList = ['add', 'edit', 'list', 'remove'];

$studentList = [
    ['id' => 1, 'name' => 'Nguyen Van A', 'age' => 19, 'major' => 'CNTT'],
    ['id' => 2, 'name' => 'Tran Thi B', 'age' => 20, 'major' => 'Kinh tế'],
    ['id' => 3, 'name' => 'Le Van C', 'age' => 21, 'major' => 'Cơ khí'],
    ['id' => 4, 'name' => 'Pham Thi D', 'age' => 19, 'major' => 'Điện tử'],
    ['id' => 5, 'name' => 'Do Van E', 'age' => 22, 'major' => 'Toán ứng dụng'],
    ['id' => 6, 'name' => 'Hoang Thi F', 'age' => 20, 'major' => 'Sinh học'],
    ['id' => 7, 'name' => 'Nguyen Van G', 'age' => 18, 'major' => 'CNTT'],
    ['id' => 8, 'name' => 'Pham Thi H', 'age' => 19, 'major' => 'Kinh tế'],
    ['id' => 9, 'name' => 'Le Van I', 'age' => 21, 'major' => 'Cơ điện tử'],
    ['id' => 10, 'name' => 'Tran Thi K', 'age' => 22, 'major' => 'CNTT'],
];

$randomAction = $actionList[rand(0, count($actionList) - 1)];

switch ($randomAction) {
    case 'add':
        $newStudent = [
            'id' => count($studentList) + 1,
            'name' => 'New Student ' . rand(100, 999),
            'age' => rand(18, 25),
            'major' => 'Ngành ' . rand(1, 5)
        ];
        $studentList[] = $newStudent;
        echo "<h3>Hành động: Thêm sinh viên mới ({$newStudent['name']})</h3>";
        break;

    case 'edit':
        if (count($studentList) > 0) {
            $index = rand(0, count($studentList) - 1);
            $oldName = $studentList[$index]['name'];
            $studentList[$index]['name'] = 'Edited Student ' . rand(100, 999);
            $studentList[$index]['age'] = rand(18, 25);
            echo "<h3>Hành động: Sửa sinh viên ($oldName)</h3>";
        } else {
            echo "<h3>Không có sinh viên nào để sửa!</h3>";
        }
        break;

    case 'remove':
        if (count($studentList) > 0) {
            $index = rand(0, count($studentList) - 1);
            $removedName = $studentList[$index]['name'];
            unset($studentList[$index]);
            $studentList = array_values($studentList);
            echo "<h3>Hành động: Xoá sinh viên ($removedName)</h3>";
        } else {
            echo "<h3>Không có sinh viên nào để xoá!</h3>";
        }
        break;

    default:
        echo "<h3>Hành động: Hiển thị danh sách sinh viên</h3>";
        break;
}

echo "<h3>Danh sách sinh viên hiện tại:</h3>";
echo "<table border='1' cellpadding='6' cellspacing='0'>";
echo "<tr><th>ID</th><th>Tên</th><th>Tuổi</th><th>Ngành học</th></tr>";

foreach ($studentList as $sv) {
    echo "<tr>
            <td>{$sv['id']}</td>
            <td>{$sv['name']}</td>
            <td>{$sv['age']}</td>
            <td>{$sv['major']}</td>
          </tr>";
}
echo "</table>";
?>
