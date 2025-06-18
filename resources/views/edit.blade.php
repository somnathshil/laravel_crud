<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    @if(isset($editInfo))
    <div class="container">
      @if($errors->any())
      <div class="alert alert-danger">
        @foreach($errors->all() as $err)
        <li>{{$err}}</li>
        @endforeach
      </div>
      @endif
        <div class="header modal-header">
            <h3 style="margin:auto;">Update Page</h3>
        </div>
        <form method="post" action="{{url('/update')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="updateId" value="{{$editInfo->user_id}}">
            <div class="form-group">
    <label for="name">Name :</label>
    <input type="text" name="name" class="form-control" value="{{$editInfo->name}}">
  </div>
   <div class="form-group">
    <label for="age">Age :</label>
    <input type="number" name="age" class="form-control" value="{{$editInfo->age}}">
  </div>
  <div class="form-group">
    <label for="email">Email Id :</label>
    <input type="email" name="email" class="form-control" value="{{$editInfo->email}}">
  </div>

  <div class="form-group">
    <label for="phone">Phone :</label>
    <input type="number" name="phone" class="form-control" value="{{$editInfo->phone}}">
  </div>

   <div class="form-group">
    <label for="image">Image :</label>
    <input type="file" name="image" class="form-control" >
    <img src="{{$editInfo->image}}" alt="image" width="100" height="100">
  </div>

 <div class="form-group">
  <button type="submit" class="btn btn-primary mt-4">Submit</button>
  </div>
</form>
    </div>
    @endif
</body>
</html>


