<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('images/logo.png') }}">
    <title>FS-Register</title>
    <style>
    *{
        margin:0px;
        padding: 0px;
        box-sizing: border-box;
    }

    body{
        background-color: #5393ff;
        height: 100%;
    }

    .form-container{
        margin: 100px auto 50px auto;
        width: 30%;
        padding: 40px 30px 40px 30px;
    }

    .inp-cont>input,.inp-cont>button,.inp-cont>a>button{
        height: 45px;
    }

    .row-link{
        width: 30%;
    }

    .row-link>.cols>a,.cols>p>a{
      font-size: 14px;
      text-decoration: none;
      color: white;
    }

    .cols>p{
        font-size: 14px;
        color: rgb(209, 209, 209);
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
        .row-link{
            width: 50%;
        }
    }


    @media screen and (max-width: 1000px){
        .form-container{
            width: 50%;
        }
        .row-link{
            width: 60%;
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
        .row-link{
            width: 75%;
        }
    }

    @media screen and (max-width: 580px){
        .form-container{
            width: 80%;
        }
        .row-link{
            width: 90%;
        }
    }

    @media screen and (max-width: 400px){
        .form-container{
            width: 93%;
        }
        .row-link{
            width: 90%;
        }
    }

    .error-border{
        border: 1px solid crimson !important;
    }

    .error-container,.loader{
        display: none;
    }

    label{
        font-weight: 600;
    }

    .sep-or{
        display: flex;
    }

    .sep-or>span{
        width: 10%;
        position: relative;
        top: -0.8em;
        font-size: 14px;
        text-align: center
    }

    .left-sep,.right-sep{
        height: 0.1px;
        width: 45%;
        background: rgb(187, 186, 186);
    }
    </style>
</head>
<body>
   <div class="form-container bg-light rounded shadow-sm mx-auto">
    <h4 class="mb-4">Sign In</h4>
   <form action="" onsubmit="handleLogin(event)">
       @csrf
       @if(Session::get("fail"))
       <div class="alert alert-danger">
        <span class="text-danger error">{{ Session::get("fail") }}</span>
    </div>
       @endif
       <div class="alert alert-danger error-container" id="error-container">
           <span class="text-danger error" id="error-txt">Invalid login, please try again</span>
       </div>
       <div class="inp-cont">
           <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control mt-1">
    </div>

    <div class="inp-cont my-3">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control mt-1 mb-2">
        <a href="/forgot" class="text-decoration-none my-3">Forgot Password?</a>
    </div>

    <div class="inp-cont">
        <div class="loader text-center mb-3" id="loader">
            <span class="spinner-border spinner-border-lg text-primary" id="loader"></span>
        </div>
        <button type="submit" class="btn btn-primary mt-1 w-100 sub-btn">Login</button>
    </div>

   <div class="sep-or mt-4">
       <div class="left-sep"></div><span>OR</span><div class="right-sep"></div>
   </div>

    <div class="inp-cont mt-2">
        <a href="/register" class="text-decoration-none"><button type="button" class="btn btn-success border w-100">Register</button></a>
    </div>
   </form>
   </div>
</div>

<script>

let errorCont = document.getElementById("error-container");
let error = document.getElementById("error-txt");
let loader = document.getElementById("loader");

const handleLogin = (e)=>{
    errorCont.style.display = "none";
    loader.style.display = "none"
    e.preventDefault();
    var email = e.target.email;
    var password = e.target.password;

    if(email.value.trim().length == 0)
    Colorize(email);
    else
    Decolorize(email);

    if(password.value.length == 0)
    Colorize(password);
    else
    Decolorize(password)

    if(!email.classList.contains("error-border") && !password.classList.contains("error-border")){
        authUser(email, password)
    }else{
        errorCont.style.display = "none"
    }
}

const Colorize = (input)=>{
        input.classList.add("error-border");
}

const Decolorize = (input)=>{
        input.classList.remove("error-border");
}

const authUser = (email, password)=>{
var _token = $("input[name='_token']").val();
loader.style.display = "block"

$.ajax({
    url: "{{ route('auth.user') }}",
    type: "POST",
    data: {_token: _token, email: email.value, password: password.value},
    success: function(data){
        loader.style.display = "none"
        if(data.error){
                errorCont.style.display = "block";
                error.innerHTML = data.error;
            }else if(data.success){
                errorCont.style.display = "none";
                window.location = "/dash"
            }
    }
})
}
</script>
</body>
</html>
