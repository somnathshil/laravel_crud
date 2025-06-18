<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    <div class="container">
      @if($errors->any())
      <div class="alert alert-danger">
        @foreach($errors->all() as $err)
        <li>{{$err}}</li>
        @endforeach
      </div>
      @endif
        <div class="header modal-header">
            <h3 style="margin:auto;">Signup Page</h3>
        </div>
        <form method="post" action="{{url('/submit')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
    <label for="name">Name :</label>
    <input type="text" name="name" class="form-control">
  </div>
   <div class="form-group">
    <label for="age">Age :</label>
    <input type="number" name="age" class="form-control">
  </div>
  <div class="form-group">
    <label for="email">Email Id :</label>
    <input type="email" name="email" class="form-control">
  </div>

  <div class="form-group">
    <label for="phone">Phone :</label>
    <input type="number" name="phone" class="form-control">
  </div>

  <div class="form-group">
    <label for="password">Password :</label>
    <input type="password" name="password" class="form-control">
  </div>

   <div class="form-group">
    <label for="image">Image :</label>
    <input type="file" name="image" class="form-control">
  </div>

 <div class="form-group">
  <button type="submit" class="btn btn-primary mt-4">Submit</button>
  </div>
</form>
 @if(isset($userInfo))
    <div class="table tab">
      <table class="table table-border table-hover">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Image</th>
        </tr>
        <tr>
          <td>{{$userInfo['name']}}</td>
          <td><a href="mailto:{{$userInfo['email']}}">{{$userInfo['email']}}</a></td>
          <td><a href="tel:{{$userInfo['phone']}}">{{$userInfo['phone']}}</a></td>
          <td><img src="{{$userInfo['image']}}" alt="image" height="100" width="100"></td>
        </tr>

      </table>
    </div> 
    @endif
    </div>
   
</body>
</html>


