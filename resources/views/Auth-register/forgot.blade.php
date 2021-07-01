<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>FS-Register</title>
    <style>
    *{
        margin:0px;
        padding: 0px;
        box-sizing: border-box;
    }

    body{
        background-color: #5393ff;
    }

    .form-container{
        margin: 150px auto 50px auto;
        width: 30%;
        padding: 40px 30px 40px 30px;
    }

    .inp-cont>input,.inp-cont>button{
        height: 45px;
    }

    .acc-title{
        position: relative;
        top: 80px;
        user-select: none;
    }

    .error{
        font-weight: 600;
        font-size: 14px;
    }

     /* responsive */

     @media screen and (max-width: 1200px){
        .form-container{
            width: 40%;
        }
    }


    @media screen and (max-width: 1000px){
        .form-container{
            width: 50%;
        }
    }


    @media screen and (max-width: 750px){
        .form-container{
            width: 60%;
        }
    }

    @media screen and (max-width: 700px){
        .form-container{
            width: 70%;
        }
    }

    @media screen and (max-width: 580px){
        .form-container{
            width: 80%;
        }
    }

    @media screen and (max-width: 400px){
        .form-container{
            width: 93%;
        }
    }
    </style>
</head>
<body>
    <h4 class="fw-bold text-center text-light acc-title">Forgot password</h4>


   <div class="form-container bg-light rounded shadow-sm mx-auto">

   <form action="">
    <div class="alert alert-danger">
        <span class="text-danger error">Email address not found</span>
    </div>

       <div class="inp-cont">
        <label for="email">Write your email</label>
        <input type="email" name="email" class="form-control shadow-sm mt-2" id="email" placeholder="Email address">
    </div>

    <div class="inp-cont mt-4">
        <button class="btn btn-primary w-100 shadow-sm">Continue</button>
    </div>
   </form>
   </div>

   <div class="back mx-auto text-center">
       <a class="text-light text-decoration-none" href="/">&laquo; Goto to login</a>
   </div>
</body>
</html>
