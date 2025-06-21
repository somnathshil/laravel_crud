<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <div class="container" style="width:45%;">
        @if(session('message'))
           <div class="alert alert-danger">
           {{session('message')}}
           </div>
        @endif
    <div class="header modal-header">
        <h3 style="margin:auto;">Sign In</h3>
        </div>
        <form method="post" action="{{url('/changepass')}}">
            @csrf
            <div class="form-group">
                <label for="oldPass">Old Password :</label>
                <input type="password" name="oldPass" class="form-control" >
            </div>
       <div class="form-group">
                <label for="newPass">New Password :</label>
                <input type="text" name="newPass" class="form-control" >
            </div>
                   <div class="form-group">
                <label for="conPass">Confirm Password :</label>
                <input type="password" name="conPass" class="form-control" >
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary mt-4">Submit</button>
            </div>
        </form>
</div>   
</body>

</html>