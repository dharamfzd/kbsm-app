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
  <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" /> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>  
  <script src = "https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
  <script src = "https://cdn.datatables.net/scroller/2.0.6/js/dataTables.scroller.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
        @forelse($students as $val)
        <tr>
            <td>{{  $val->id }}</td>
            <td>{{  $val->name ?? '--' }}</td>
            <td>{{  $val->email ?? '--' }}</td>
            <td>{{  $val->mobile ?? '--' }}</td>
            <td>{{  $val->class ?? '--' }}</td>
            <td>{{  $val->father_name ?? '--' }}</td>
            <td>{{  $val->mother_name ?? '--' }}</td>
            <td><a href="javascript:void(0)" data-url="{{ route('student.destroy', $val->id) }}" class="btn btn-xs btn-danger user-delete" data-toggle="tooltip" title='Delete'><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
        </tr>
        @empty
        <p>No students</p>
        @endforelse
    </tbody>
  </table>
</div>
<script type="text/javascript">

$('#students').DataTable({
    deferRender: true,
    scrollCollapse: true,
    ordering : true
});

$(document).on('click', '.btn', function (e) {
    e.preventDefault();
    let url = $(this).data('url');
    let removeRow = this;
    swal({
        title: `Are you sure you want to delete this user?`,
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
          $.ajax({
            url: url,
            method: "DELETE",
            data:{
              "_token": "{{ csrf_token() }}",
            },
            success: function (response) {
              swal('Deleted!', response.message, 'success');
              $(removeRow).closest('tr').remove();
            },
            error: function (error) {
              swal('Error!', error.responseJSON.message, 'error');
            }
          });
        }    
    });
});
</script>
</body>
</html>
