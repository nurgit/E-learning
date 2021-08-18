<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('users/css/bootstrap.min.css')}}" />
    <title>Student Dashboard</title>

</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h4> Renter Dashboard</h4><hr>
                <div class="">
                    <table class="table table-hober">
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$LoggedUserInfo['name']}}</td>
                                <td>{{$LoggedUserInfo['email']}}</td>
                                <td><a href="{{route('logout')}}">Logout</a></td>
                                
                            </tr>
                        </tbody>
                    </table>

                    <form action="/post" method="post">
                        @csrf
                    <input type="submit">
                    </form>
                </div>
               
            </div>
        </div>
    </div>
 
</body>
</html>