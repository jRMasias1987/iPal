function clearPost() {
     document.getElementById('entry').value = "";
}

// Scroll parallax effect handler
window.addEventListener("scroll", reveal);
function reveal() {
    var reveals = document.querySelectorAll(".reveal");

    for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var revealTop = reveals[i].getBoundingClientRect().top;
        var revealPoint = 150;

        if (revealTop < windowHeight - revealPoint) {
            reveals[i].classList.add("active");
        } else {
            reveals[i].classList.remove("active");
        }
    }
}

// comments div opener
function openComment(){
     var commentBox = document.getElementById('comment-box');
     commentBox.classList.add('active');
}

// delete user warning
function deleteUserWarning(){
     var result = confirm('Are you sure you want to delete your account?');
     if (result) {
          window.location.href = "/delete-account";
     } else {
          window.location.href = "/profile";
     }
}