<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <title>FS-Register</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        body {
            background-color: #fff;
        }

        .navbar {
            width: 80%;
            height: 60px;
            background: #fff !important;
            z-index: 200;
            position: fixed;
            left: 50%;
            transform: translate(-50%, 0);
            top: 0px;
        }

        .profile-cont {
            width: 50px;
            height: 50px;
            cursor: pointer;
            border-radius: 50%;
            margin: -12px 0px;
        }

        .profile-cont>img {
            object-fit: cover;
            object-position: top;
            border-radius: 50%;
        }

        .cont {
            display: flex;
            margin: 8px;
            position: absolute;
            right: 40px;
            top: 8px;
        }

        .cont>p>i {
            cursor: pointer;
        }

        .username {
            position: relative;
            left: 40px;
            cursor: pointer;
        }

        .search-field-cont {
            background: #fff;
            width: 300px;
            height: 40px;
            padding-right: 10px !important;
            position: relative;
            top: -7px;
        }

        .search-field {
            width: 90%;
            height: 100%;
            border: none;
            outline: none;
            font-size: 15px;
            float: right;
        }

        .search-field-cont>i {
            font-size: 14px;
            widows: 10%;
            position: relative;
            left: 7px;
            top: 2px;
        }

        .menu-bar {
            background-color: #fff;
            padding: 20px 20px 10px 20px;
            border-radius: 5px;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.2), -1px -1px 8px rgba(0, 0, 0, 0.2);
            width: 10%;
            float: right;
            position: absolute;
            right: 140px;
            top: 55px;
            z-index: 500;
            display: none;
        }

        .menu-bar>p {
            cursor: pointer;
            user-select: none;
        }

        .menu-bar>p:hover {
            color: #5393ff;
        }

        .search-bar {
            height: 400px;
            width: 25%;
            margin: -40px auto;
            position: relative;
            left: 64px;
            overflow: auto;
            border: 1px solid rgb(223, 219, 219);
            border-top: none;
        }

        .search-bar::-webkit-scrollbar{
            width: 12px;
        }

        .search-bar::-webkit-scrollbar-track{
            background: whitesmoke;
        }

        .search-bar::-webkit-scrollbar-thumb{
            background: rgb(194, 192, 192);
            border-radius: 50px;
        }

        .search-bar-cont {
            display: none;
            position: fixed;
            z-index: 100;
            padding-top: 100px;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
        }

        .search-people {
            width: 100%;
            padding: 7px 10px 0px 8px;
            display: flex;
            user-select: none;
            height: 50px;
        }

        .search-people:hover{
           background: lavender;
           cursor: pointer;
        }

        .username-searched {
            position: relative;
            top: 2px;
            left: 3px;
        }

        .searched-profile{
            width: 40px;
            height: 40px;
            position: relative;
            top: 9px;
        }

        #search-sub-btn{
            display: none;
        }

    </style>
</head>

<body>
    <nav class="shadow-sm bg-light navbar mx-auto border-bottom">

        <p class="fw-bold mt-2 username">{{ $username }}</p>

        <div class="cont">
            <form id="search-form" autocomplete="off" class="icons-cont me-5 search-field-cont shadow-sm border p-1 rounded">
                @csrf
                <i class="fa fa-search"></i>
                <input onfocus="toggleSearchBar()" id="search-field" name="searchKey" type="text" placeholder="Search people" class="search-field">
                <button type="submit" id="search-sub-btn" >Search</button>
            </form>
            <p class="icons-cont me-5" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Files"><a class="text-decoration-none text-dark" href="{{asset("/dash")}}"><i
                class="fa fa-file"></i></a></p>
            <p class="icons-cont me-5" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Settings"><i
                    class="fa fa-cog"></i></p>
            <p class="icons-cont me-5" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Notifications"><i
                    class="fa fa-bell"></i></p>

            <div class="user-select-none user-picture" onclick="displayMenu()">
                <div class="profile-cont">
                    <img src="" alt="user" id="profile-image" class="w-100 h-100">
                </div>
            </div>
        </div>
    </nav>

    <div class="menu-bar bg-white rounded">
        <p><a href="{{ asset("/profile") }}" class="text-decoration-none text-dark">Profiles</a></p>
        <hr class="dropdown-divider">
        <p><a href="{{ asset("/logout") }}" class="text-decoration-none text-dark"> <i class="fa fa-sign-out"></i> Log out</a></p>
    </div>

    <div class="search-bar-cont" id='search-bar-cont'>
        <div class="search-bar bg-white shadow-sm rounded" id="search-bar">

        </div>
    </div>

    <script>
        let searchField = document.getElementById("search-field");
        let form = document.getElementById("search-form");

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        function displayMenu() {

            const menu = document.getElementsByClassName("menu-bar")[0];

            if (menu.style.display != "block")
                menu.style.display = "block"
            else
                menu.style.display = "none";
        }

        let searchBar = document.getElementById("search-bar-cont");

        function toggleSearchBar() {
            searchBar.style.display = "block"
        }

        window.onclick = (e) => {
            if (e.target == searchBar) {
                searchBar.style.display = "none";
                form.reset()
                document.getElementById("search-bar").innerHTML = "";
            }
        }

        function getsearchedPeople(info){
            let username = info.getAttributeNode("data-person-name").value;
            let userId = info.getAttributeNode("data-person-id").value;
            localStorage.setItem("mhXvrVTXkCKxSjcDPB", userId);
        }

    </script>

    <script>
        $(document).mouseup(function(e) {

            let container = $("#menu-bar");
            const menu = document.getElementsByClassName("menu-bar")[0];
            const profile = document.getElementsByClassName("user-picture")[0];

            if (!container.is(e.target) && container.has(e.target).length === 0 &&
                !profile.is(e.target) && profile.has(e.target).length &&
                !menu.is(e.target) && menu.has(e.target).length) {
                menu.style.display = "none"
            }
        });

function getProfile(){
    $.ajax({
     type:'GET',
     url: "{{ url('get-profile')}}",
     success: (data) => {
     let image_name = data.info.profile_pic;
     if(document.getElementById("profile-image"))
     document.getElementById("profile-image").src = image_name;
     if(document.getElementById("profile-image2"))
     document.getElementById("profile-image2").src = image_name;

     if(image_name != "/images/user.png" && document.getElementById("del-btn"))
     document.getElementById("del-btn").style.display = "initial"
     else if(document.getElementById("del-btn") && image_name == "/images/user.png")
     document.getElementById("del-btn").style.display = "none"
     }
})}
getProfile();

// search people

searchField.addEventListener("keyup", (e)=>{
  document.getElementById("search-bar").innerHTML = `<div class="spinners text-center">
            <span class="spinner-border text-primary mt-5"></span>
        </div>`;
  if(searchField.value.trim().length>0)
  document.getElementById("search-sub-btn").click();
  else
  document.getElementById("search-bar").innerHTML = ""
})

$(document).ready(function (e) {
$('#search-form').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        type:'POST',
     url: "{{ url('search')}}",
     data: formData,
     cache:false,
     contentType: false,
     processData: false,
     success: (data) => {
        document.getElementById("search-bar").innerHTML = "";
        if(data.results.length>0){
            document.getElementById("search-bar").innerHTML+= `<h6 class='p-3 border-bottom fw-bold'>People</h6>`;
            for(let i=0; i<data.results.length; i++){
            document.getElementById("search-bar").innerHTML+= `
            <a href='{{ asset('/chat') }}' class='text-decoration-none text-dark'><div class="search-people border-bottom" data-person-id = '${data.results[i]._id}'
             data-person-name='${data.results[i].username}' data-person-profile='${data.results[i].profile_pic}' onclick="getsearchedPeople(this)">
                <div class="profile-cont searched-profile">
                <img src="${data.results[i].profile_pic}" alt="user" class="w-100 h-100">
                </div>
                <p class="username-searched">${data.results[i].username}</p>
            </div></a>`;
            }
        }else{
            document.getElementById("search-bar").innerHTML = "<h6 class='text-center mt-4 fw-bold'>No results found</h6>"
        }
     }
    })
})})

    </script>

</body>

</html>
