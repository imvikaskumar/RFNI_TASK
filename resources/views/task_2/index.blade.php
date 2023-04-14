@extends('layouts.app')
@section('title', 'Dynamic Table')
@section('content')
<h3>Dynamic Table</h3>
<table id="my-table" class="table table-bordered w-10">
  <thead>
    @if(count($slots))
    @foreach($slots as $key => $slot)
    {{-- <th>Slot {{ $slot['slot'] }}</th> --}}
    <th>Slot {{ $loop->iteration }}</th>
    @endforeach
    @else
    <th>Slot  1 </th>
    @endif 
  </thead>
  <tbody>
    <tr>
      @if(count($slots))
      @foreach($slots as $key => $slot)
      <td>
        <input type="text" class="form-control my-2" value="{{ $slot['input_1'] }}" onkeyup="saveIndb(this,{{ $slot['slot'] }},'input_1')">
        <input type="text" class="form-control my-2" value="{{ $slot['input_2'] }}" onkeyup="saveIndb(this,{{ $slot['slot'] }},'input_2')">
        <input type="text" class="form-control my-2" value="{{ $slot['input_3'] }}" onkeyup="saveIndb(this,{{ $slot['slot'] }},'input_3')">
      </td>
      @endforeach
      @else            
      <td>
        <input type="text" class="form-control my-2" value="" onkeyup="saveIndb(this,1,'input_1')">
        <input type="text" class="form-control my-2" value="" onkeyup="saveIndb(this,1,'input_2')">
        <input type="text" class="form-control my-2" value="" onkeyup="saveIndb(this,1,'input_3')">
      </td>
      @endif
    </tr>
  </tbody>
</table>
<button id="add-more-btn" type="button" class="btn btn-primary">Add More</button>
@endsection
@push('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#add-more-btn').click(function() {
        // Clone the header cell and change its text
      var headerCell = $('#my-table thead tr th').first().clone();
      var countTh = $('#my-table thead tr th').length +1;

      headerCell.text(`Slot ${countTh}`);
      $('#my-table thead tr').append(headerCell);

        // Clone the body cell and its content
        // var bodyCell = $('#my-table tbody tr td').first().clone();

      bodyCell = `<td>
      <input type="text" class="form-control my-2" value="" onkeyup="saveIndb(this,${countTh},'input_1')">
      <input type="text" class="form-control my-2" value="" onkeyup="saveIndb(this,${countTh},'input_2')">
      <input type="text" class="form-control my-2" value="" onkeyup="saveIndb(this,${countTh},'input_3')">
      </td>`;

      $('#my-table tbody tr').append(bodyCell);
    });

  });

  // Listen for change events on the input elements
  function saveIndb(ds,slot,inputColumn) {
      // Get the value of the changed input field
    var changedValue = $(ds).val();
    var data = {
      slot : slot,
      inputColumn:inputColumn,
      inputvalue : changedValue
    }
    console.log(data);
    // Make the AJAX request with the changed value
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
     url: '{{ url('/dynamic_table_create') }}',
     method: 'POST',
     data: data,
     success: function(response) {
       // Handle the successful response from the server
       console.log('Server response:', response);
     },
     error: function(xhr, status, error) {
       // Handle the error response from the server
        alert(error);
        location.reload(true);
       // console.error('AJAX error:', error);
     }
    });
  }
</script>
@endpush
