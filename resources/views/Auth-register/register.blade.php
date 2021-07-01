<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        margin: 100px auto 50px auto;
        width: 30%;
        padding: 40px 30px 40px 30px;
    }

    .inp-cont>input,.inp-cont>button{
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
        top: 60px;
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
    </style>
</head>
<body>
    {{-- <h4 class="fw-bold text-center text-light acc-title">Create account</h4> --}}
   <div class="form-container bg-light rounded shadow-sm mx-auto">
    <h4 class="mb-4">Register</h4>
   <form action="" onsubmit="handleSignup(event)">
    @csrf
    <div class="alert alert-danger error-container" id="error-container">
        <span class="text-danger error" id="error-txt"></span>
    </div>

       <div class="inp-cont">
        <label for="username">Username</label>
           <input type="text" name="username" id="username" class="form-control shadow-sm">
       </div>

       <div class="inp-cont my-4">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control shadow-sm">
    </div>

    <div class="inp-cont my-4">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control shadow-sm">
    </div>

    <div class="inp-cont">
        <div class="loader text-center mb-3" id="loader">
            <span class="spinner-border spinner-border-lg text-primary" id="loader"></span>
        </div>
        <button class="btn btn-primary w-100 shadow-sm">Register</button>
    </div>
   </form>
   </div>

   <div class="row-link mx-auto">
       <div class="cols float-start "><p><span>Already have an account? </span> <a href="/">Login</a></p></div>
       <div class="cols float-end"><a href="/forgot">Forgot password?</a></div>
</div>

<script>

let errorCont = document.getElementById("error-container");
let error = document.getElementById("error-txt");
let loader = document.getElementById("loader");

const handleSignup = (e)=>{
    errorCont.style.display = "none";
    loader.style.display = "none"
    e.preventDefault();

    let email = e.target.email;
    let password = e.target.password;
    let username = e.target.username;

    if(email.value.trim().length == 0)
    Colorize(email);
    else
    Decolorize(email);

    if(password.value.length == 0)
    Colorize(password);
    else
    Decolorize(password)

    if(username.value.trim().length == 0)
    Colorize(username);
    else
    Decolorize(username);

    if(!username.classList.contains("error-border") && !email.classList.contains("error-border") && !password.classList.contains("error-border")){
        signUpUser(username, email, password)
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

function signUpUser(username, email, password){
    loader.style.display = "block"
    var _token = $("input[name='_token']").val();
    var added = new Date().toLocaleDateString() + "-" + new Date().toLocaleTimeString();

    $.ajax({
        url: "{{ route('register.user') }}",
        type: "POST",
        data: {_token: _token,username: username.value, password: password.value, email: email.value, added: added},
        success: function(data){
            loader.style.display = "none"
            if(data.error){
                errorCont.style.display = "block";
                error.innerHTML = data.error[0];
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
