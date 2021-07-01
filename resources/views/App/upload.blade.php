<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <title>Document</title>
    <style>
        .upload-cont {
            background: rgb(240, 252, 255);
            width: 60%;
            height: 300px;
            margin: 100px auto 50px auto;
        }

        .upload-og-cont {
            background: #fff !important;
            width: 35%;
            margin: auto;
            height: 300px;
            position: absolute;
            top: 200px;
            z-index: 1;
            left: 50%;
            transform: translate(-50%, 0);
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
        }

        .send-btn {
            position: relative;
            top: 80px;
        }

        .reciever {
            position: relative;
            top: 30px;
            left: 30px;
            display: flex;
        }

        .to {
            color: rgba(0, 0, 0, 0.712);
        }

        .upload-holder-cont {
            width: 90%;
            height: 80%;
            border: 2px dashed rgb(178, 207, 178);
            margin: 30px auto;
            cursor: pointer;
            user-select: none;
        }

        .browse {
            position: relative;
            top: 45%;
        }

        .drag {
            position: relative;
            top: 60px;
        }

        .upload-zone{
            display: none;
        }

        .profile-cont3{
            width: 40px;
            height: 40px;
        }

        .drop-zone--over {
  border-style: solid;
}

        .drop-zone__thumb {
  width: 100%;
  height: 100%;
  border-radius: 5px;
  overflow: hidden;
  background-color: #cccccc;
  background-size: cover;
  position: relative;
}

.drop-zone__thumb::after {
  content: attr(data-label);
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 5px 0;
  color: #ffffff;
  background: rgba(0, 0, 0, 0.75);
  font-size: 14px;
  text-align: center;
}

.other-files{
    width: 50%;
    border: 1px solid rgb(116, 129, 116);
    margin: auto;
    background-position: center;
}
    </style>
</head>

<body>
    <div class="upload-zone">
        @include("App.navbar")

    <div class="upload-cont mx-auto shadow-sm rounded">
        <div class="reciever">
            <div class="profile-cont profile-cont3">
                <img src="" alt="user" id="clicked-profile-image" class="w-100 h-100">
            </div>&nbsp;&nbsp;<span class="fw-bold to" id="to"></span>
        </div>
    </div>

    <form action="" id="file-form" enctype="multipart/form-data" class="upload-og-cont shadow-lg rounded">
        @csrf
        <div class="upload-holder-cont rounded text-center drop-zone">
            <input type="file" capture style="display: none" name="file" class="drop-zone__input" id="file-input">

            <h6 class="text-info drag drop-zone__prompt">Drag & Drop files here to upload</h6>
            <button type="submit" id="sub" style="display: none;">Send</button>
            <button type="button" class="btn btn-light browse drop-zone__prompt2"><span class="text-info">Browse file</span></button>
        </div>
    </form>

    <div class="send-btn text-center">
        <button class="btn btn-primary shadow-sm" id="send-btn" onclick="sendMessage()" disabled>Send File</button>
    </div>
    </div>

    <script>

            if(!localStorage.getItem("mhXvrVTXkCKxSjcDPB")){
                window.location = "dash";
            }else{
            let userId = localStorage.getItem("mhXvrVTXkCKxSjcDPB");

    function getInfo(){
    $.ajax({
     type:'GET',
     url: `get-clicked-info/${userId}`,
     success: (data) => {
         if(data.info){
             document.getElementById("to").innerHTML = data.info.username;
             document.getElementById("clicked-profile-image").src = data.info.profile_pic;
             document.getElementsByClassName("upload-zone")[0].style.display ="block"
         }
     if(data.error){
         localStorage.removeItem("mhXvrVTXkCKxSjcDPB");
         window.history.back();
     }
     }
})}
getInfo();
}

            function toggleFile() {
            const fileInput = document.getElementById("file-input");
            fileInput.click();
            }

        function sendMessage(){
            document.getElementById("sub").click();
        }

    </script>

    {{--  script to upload  --}}

    <script>
    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
    const dropZoneElement = document.getElementsByClassName("upload-holder-cont")[0]

    dropZoneElement.addEventListener("click", (e) => {
      inputElement.click();
    });

    inputElement.addEventListener("change", (e) => {
      if (inputElement.files.length) {
        updateThumbnail(dropZoneElement, inputElement.files[0]);
      }
    });

    dropZoneElement.addEventListener("dragover", (e) => {
      e.preventDefault();
      dropZoneElement.classList.add("drop-zone--over");
    });

    ["dragleave", "dragend"].forEach((type) => {
      dropZoneElement.addEventListener(type, (e) => {
        dropZoneElement.classList.remove("drop-zone--over");
      });
    });

    dropZoneElement.addEventListener("drop", (e) => {
      e.preventDefault();

      if (e.dataTransfer.files.length) {
        inputElement.files = e.dataTransfer.files;
        updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
      }

      dropZoneElement.classList.remove("drop-zone--over");
    });
  });

  function updateThumbnail(dropZoneElement, file) {
    let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

    // First time - remove the prompt
    if (dropZoneElement.querySelector(".drop-zone__prompt")) {
      dropZoneElement.querySelector(".drop-zone__prompt").remove();
      dropZoneElement.querySelector(".drop-zone__prompt2").remove();
    }

    // First time - there is no thumbnail element, so lets create it
    if (!thumbnailElement) {
      thumbnailElement = document.createElement("div");
      thumbnailElement.classList.add("drop-zone__thumb");
      dropZoneElement.appendChild(thumbnailElement);
    }

    thumbnailElement.dataset.label = file.name;

    // Show thumbnail for image files
    if (file.type.startsWith("image/")) {
    if (file.type.startsWith("image/")) {
        thumbnailElement.classList.remove("other-files")
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = () => {
       document.getElementById("send-btn").disabled = false;
        thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
      };
    } else {
       let  extension = file.name.split('.').pop();
       thumbnailElement.classList.add("other-files")

       if(extension == "docx"){
           thumbnailElement.style.backgroundImage = `url('/images/docx.png')`;
       }
       if(extension == "pdf"){
           thumbnailElement.style.backgroundImage = `url('/images/pdf.png')`;
       }

       if(extension == "xd"){
           thumbnailElement.style.backgroundImage = `url('/images/xd.jpg')`;
       }

       if(extension == "xlsx"){
           thumbnailElement.style.backgroundImage = `url('/images/excel.jpg')`;
       }
       if(extension == "pptx"){
           thumbnailElement.style.backgroundImage = `url('/images/ppt.png')`;
       }else if(extension != "pptx" && extension!="xd" && extension!="docx" && extension!="xlsx" && extension!="pdf"){
        thumbnailElement.style.backgroundImage = `url('/images/other-file.png')`
       }

       document.getElementById("send-btn").disabled = false;


    }
  }

  $(document).ready(function (e) {

$('#file-form').submit(function(e) {

  e.preventDefault();

  var formData = new FormData(this);

  $.ajax({
     type:'POST',
     url: "{{ url('sent-msg')}}",
     data: formData,
     cache:false,
     contentType: false,
     processData: false,
     success: (data) => {
        this.reset();
        console.log(data)
     }
    });
});
});
    </script>

</body>

</html>
