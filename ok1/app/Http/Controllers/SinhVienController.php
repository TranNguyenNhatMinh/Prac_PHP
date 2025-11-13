<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SinhVienController extends Controller
{
    // Dữ liệu giả định (mảng sinh viên)
    private $students = [
        [
            'hoten' => 'Nguyễn Văn A',
            'masv' => 'SV001',
            'tuoi' => 20,
            'lop' => 'CNTT1',
            'diem' => 8.5,
        ],
        [
            'hoten' => 'Trần Thị B',
            'masv' => 'SV002',
            'tuoi' => 21,
            'lop' => 'CNTT2',
            'diem' => 7.8,
        ],
        [
            'hoten' => 'Lê Văn C',
            'masv' => 'SV003',
            'tuoi' => 19,
            'lop' => 'CNTT1',
            'diem' => 9.2,
        ],
    ];

    // Trang danh sách sinh viên
    public function index()
    {
        $students = $this->students;
        return view('students.index', compact('students'));
    }

    // Trang thêm sinh viên
    public function create()
    {
        return view('students.create');
    }

    // Nhận dữ liệu POST từ form thêm sinh viên
    public function store(Request $request)
    {
        $data = $request->all();
        return view('students.result', ['student' => $data]);
    }

    // Tìm kiếm sinh viên theo tên
    public function search(Request $request)
    {
        $keyword = strtolower($request->get('keyword'));
        $students = array_filter($this->students, function ($sv) use ($keyword) {
            return str_contains(strtolower($sv['hoten']), $keyword);
        });

        return view('students.index', ['students' => $students, 'keyword' => $request->keyword]);
    }
}
