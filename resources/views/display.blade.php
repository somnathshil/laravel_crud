<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    @if(isset($allInfo))
    <div class="table table-responsive">
      <table class="table table-bordered table-hover">
        <tr>
          <th>Name</th>
          <th>Age</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Image</th>
          <th>Actions</th>
        </tr>
        @foreach($allInfo->all() as $details)
         <tr>
          <td>{{$details->name}}</td>
          <td>{{$details->age}}</td>
          <td><a href="mailto:{{$details->email}}">{{$details->email}}</a></td>
          <td><a href="tel:{{$details->phone}}">{{$details->phone}}</a></td>
          <td><img src="{{$details->image}}" alt="image" height="100" width="100"></td>
          <td>
            <a href="{{url('/edit')}}{{$details->user_id}}">Edit</a> |
            <a href="{{url('/delete')}}{{$details->user_id}}" onclick="return confirm('Are you sure?')">Delete</a>
          </td>
        </tr>
        @endforeach

      </table>
    </div> 
    @endif
    </div>
</body>
</html>