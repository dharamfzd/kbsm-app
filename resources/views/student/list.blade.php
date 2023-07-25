<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student list</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" /> -->
  <!-- <script src = "https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
  <script src = "https://cdn.datatables.net/scroller/2.0.6/js/dataTables.scroller.min.js"></script> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="container">
  <h2>Student List</h2>
  <table class="table" id="students">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Class</th>
        <th>Father Name</th>
        <th>Mother Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @php $c=1; @endphp
        @forelse($students as $val)
        <tr>
            <td>{{  $c++ }}</td>
            <td>{{  $val->name ?? '--' }}</td>
            <td>{{  $val->email ?? '--' }}</td>
            <td>{{  $val->mobile ?? '--' }}</td>
            <td>{{  $val->class ?? '--' }}</td>
            <td>{{  $val->father_name ?? '--' }}</td>
            <td>{{  $val->mother_name ?? '--' }}</td>
            <td>
                <form class="d-inline" method="POST" action="">
                    @csrf
                    <button type="submit" class="btn btn-xs btn-danger user-delete" data-toggle="tooltip" title='Delete'><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <p>No students</p>
        @endforelse
    </tbody>
  </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
// $('#students').DataTable({
//     deferRender: true,
//     scrollCollapse: true,
//     ordering : false
// });

$(document).ready(function() {
    $('#students').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('student.create') }}",
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'mobile', name: 'mobile' },
            { data: 'class', name: 'class' },
            { data: 'father_name', name: 'father_name' }
        ]
    });
});

$('.user-delete').click(function(event) {
    var form =  $(this).closest("form");
    event.preventDefault();
    swal({
        title: `Are you sure you want to delete this user?`,
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });
});
</script>
</body>
</html>
