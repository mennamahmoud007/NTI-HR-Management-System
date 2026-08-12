@extends('layouts.app')

@section('content')

<style>
    .salary-container {
        padding: 30px;
    }

    .salary-card {
        background-color: #1e293b;
        border-radius: 15px;
        padding: 20px;
        height: 100%;
    }

    .salary-label {
        color: #94a3b8;
        font-size: 14px;
    }

    .salary-value {
        color: white;
        font-size: 24px;
        font-weight: bold;
    }

    .salary-table-card {
        background-color: #1e293b;
        border-radius: 15px;
        padding: 20px;
    }

    .table {
        --bs-table-bg: transparent;
        --bs-table-color: white;
        --bs-table-border-color: #334155;
        margin-bottom: 0;
    }

    .table th,
    .table td {
        color: white;
        vertical-align: middle;
    }

    .table th {
        color: #94a3b8;
        font-size: 13px;
        text-transform: uppercase;
    }

    .search-card {
        background-color: #1e293b;
        border-radius: 15px;
        padding: 15px;
    }

    .search-box {
        background-color: #334155;
        color: white;
        border: 1px solid #475569;
    }

    .search-box::placeholder {
        color: #cbd5e1;
    }

    .search-box:focus {
        background-color: #334155;
        color: white;
        border-color: #7c3aed;
        box-shadow: none;
    }
</style>


<div class="salary-container">

    <!-- Header -->
    <div class="mb-4">
        <h2 class="text-white mb-1">Salaries</h2>
        <p class="text-secondary mb-0">July 2026 payroll</p>
    </div>


    <!-- Summary Cards -->
    <div class="row g-4 mb-4">

        <!-- Total Payroll -->
        <div class="col-md-4">
            <div class="salary-card">

                <div class="salary-label">
                    Total Payroll
                </div>

                <div class="salary-value">
                    ${{ number_format($salaries->sum('net_salary'), 2) }}
                </div>

            </div>
        </div>


        <!-- Total Bonuses -->
        <div class="col-md-4">
            <div class="salary-card">

                <div class="salary-label">
                    Total Bonuses
                </div>

                <div class="salary-value">
                    ${{ number_format($salaries->sum('bonus'), 2) }}
                </div>

            </div>
        </div>


        <!-- Total Deductions -->
        <div class="col-md-4">
            <div class="salary-card">

                <div class="salary-label">
                    Total Deductions
                </div>

                <div class="salary-value">
                    ${{ number_format($salaries->sum('deduction'), 2) }}
                </div>

            </div>
        </div>

    </div>


    <!-- Search -->
    <div class="search-card mb-4">

        <input
            type="text"
            id="salarySearch"
            class="form-control search-box"
            placeholder="Search employee..."
        >

    </div>


    <!-- Salaries Table -->
    <div class="salary-table-card">

        <div class="table-responsive">

            <table class="table">

                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Basic Salary</th>
                        <th>Bonus</th>
                        <th>Deduction</th>
                        <th>Net Salary</th>
                    </tr>
                </thead>

                <tbody id="salaryTable">

                    @forelse($salaries as $salary)

                        <tr>

                            <td>
                                {{ $salary->employee?->user?->name ?? 'Unknown Employee' }}
                            </td>

                            <td>
                                {{ $salary->employee?->department?->name ?? 'No Department' }}
                            </td>

                            <td>
                                ${{ number_format($salary->basic, 2) }}
                            </td>

                            <td>
                                ${{ number_format($salary->bonus, 2) }}
                            </td>

                            <td>
                                ${{ number_format($salary->deduction, 2) }}
                            </td>

                            <td>
                                <strong>
                                    ${{ number_format($salary->net_salary, 2) }}
                                </strong>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center">
                                No salaries found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- Search Script -->
<script>

    document.getElementById('salarySearch').addEventListener('keyup', function () {

        let searchValue = this.value.toLowerCase();

        let rows = document.querySelectorAll('#salaryTable tr');

        rows.forEach(function (row) {

            let employeeName = row.cells[0]?.textContent.toLowerCase();

            if (employeeName && employeeName.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }

        });

    });

</script>

@endsection