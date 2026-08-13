<?php

namespace App\Http\Controllers;

use App\Models\Salary;

class SalaryController extends Controller
{
    public function mySalary()
{
    // جلب بيانات الموظف الحالي مع سجل رواتبه
    $employee = auth()->user()->employee;
    $salaries = $employee ? $employee->salaries()->latest()->get() : collect();

    return view('employees.salary', compact('employee', 'salaries'));
}
    public function index()
    {
        $salaries = Salary::with([
            'employee.user',
            'employee.department',
            'employee.position',
        ])->get();

        return view('salaries.index', compact('salaries'));
    }
}