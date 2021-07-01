<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <title>Document</title>
    <style>
   .buttons-cont{
       /* position: relative; */
   }

   .profile-cont-part{
       width: 350px;
       height: 350px;
   }

   .profile-cont-part>img{
       object-fit: cover;
       object-position: top;
   }

   .profile-page{
       top: 10em;
       left: 50%;
       position: absolute;
        transform: translate(-50%, 0);
   }

   .hide,#del-btn{
       display: none;
   }
    </style>
</head>
<body>
    @extends("App.navbar")
    <form action="" id="profile-upload-form" class="hide" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" id="image-field" accept=".jpeg,.png,.jpg,.gif,.svg"><br><br>
        <button id="sub" type="submit">Upload</button>
    </form>
   <div class="profile-page">
    <div class="alert alert-danger hide upload-error">
        <p class="text-danger" id="errors-upload"></p>
    </div>
    <div class="profile-cont-part">
        <img src="" alt="user" id="profile-image2" class="w-100 h-100 rounded">
    </div>

    <div class="buttons-cont mt-5">
        <button class="btn btn-light shadow-none text-info border" onclick="toggleProfile()">Edit profile</button>
        <button class="btn btn-danger shadow ms-4" id="del-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Remove profile</button>
    </div>
   </div>

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="staticBackdropLabel">Remove profile</h5>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Are you sure you want to remove your profile? This cannot be undone.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light shadow-none text-info" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger shadow-none" data-bs-dismiss="modal" onclick="deleteProfile()">Delete</button>
        </div>
      </div>
    </div>
  </div>

   <script>
  let imageField = document.getElementById("image-field");
  let forms = document.getElementById("profile-upload-form");
  let error = document.getElementsByClassName("upload-error")[0];

   const toggleProfile = ()=>{
       imageField.click();
   }

  imageField.addEventListener("change", (e)=>{
    document.getElementById("sub").click()
  })

$(document).ready(function (e) {

$('#profile-upload-form').submit(function(e) {

  e.preventDefault();

  var formData = new FormData(this);

  $.ajax({
     type:'POST',
     url: "{{ url('profile-upload')}}",
     data: formData,
     cache:false,
     contentType: false,
     processData: false,
     success: (data) => {
        this.reset();
        if(data.error && !data.exists){
        error.style.display = "block"
        document.getElementById("errors-upload").innerHTML = data.error[1];
        }else if(data.error && data.exists){
        error.style.display = "block"
        document.getElementById("errors-upload").innerHTML = data.error;
        }
        else if(data.uploaded){
        error.style.display = "none";
        getProfile();
        }
     }
    });
});
});

const deleteProfile = ()=>{
    $.ajax({
     type:'GET',
     url: "{{ url('delete-profile')}}",
     success: (data) => {
     getProfile();
     }
})
}
   </script>

</body>
</html>
