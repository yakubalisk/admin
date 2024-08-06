@extends('master.master')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4">Employees</h1>
    <button class="btn btn-primary mb-4" id="addEmployeeBtn">Add Employee</button>

    <table id="employeesTable" class="display">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Position</th>
                <!-- <th>Email</th> -->
                <th>Mobile</th>
                <th>Address</th>
                <!-- <th>Status</th> -->
            </tr>
        </thead>
    </table>
</div>

<!-- Add Employee Modal -->
<div class="modal" id="addEmployeeModal">
    <div class="modal-box">
        <form id="addEmployeeForm" action="{{ url('/add-employee') }}" method="POST">
            @csrf
            <h3 class="font-bold text-lg">Add Employee</h3>
            <div class="py-4">
                <input type="text" name="first_name" placeholder="First Name" class="input input-bordered w-full mb-2" required>
                <input type="text" name="last_name" placeholder="Last Name" class="input input-bordered w-full mb-2" required>
                <input type="text" name="position" placeholder="Position" class="input input-bordered w-full mb-2" required>
                <input type="email" name="email" placeholder="Email" class="input input-bordered w-full mb-2" required>
                <input type="text" name="mobile" placeholder="Mobile" class="input input-bordered w-full mb-2" required>
                <input type="text" name="address" placeholder="Address" class="input input-bordered w-full mb-2" required>
                <!-- <input type="number" name="status" placeholder="Status" class="input input-bordered w-full mb-2" required> -->
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="#" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#employeesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url('/employee-list') }}',
                type: 'GET',
            },
            columns: [
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'position', name: 'position' },
                // { data: 'email', name: 'email' },
                { data: 'mobile', name: 'mobile' },
                { data: 'address', name: 'address' },
                // { data: 'status', name: 'status' },
            ],
            pageLength: 10,
        });

        $('#addEmployeeBtn').on('click', function () {
            $('#addEmployeeModal').addClass('modal-open');
        });

        $('#addEmployeeForm').on('submit', function () {
            $('#addEmployeeModal').removeClass('modal-open');
        });
    });
</script>
@endsection