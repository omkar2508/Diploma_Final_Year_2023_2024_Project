const form = document.querySelector(".signup form"),
    continueBtn = form.querySelector(".button input"),
    errorText = form.querySelector(".error-text");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    var fnameInput = document.querySelector('input[name="fname"]');
    var lnameInput = document.querySelector('input[name="lname"]');

    // Regular expression patterns
    const namePattern = /^[A-Za-z ]+$/;
    const usernamePattern = /^[a-zA-Z][a-zA-Z0-9]{0,11}$/;
    
    // Check if name input is valid
    if (!namePattern.test(fnameInput.value.trim())) {
        errorText.style.display = "block";
        errorText.textContent = "Name must contain only letters.";
        return; // Stop further execution
    }
    
    // Check if username input is valid
    if (!usernamePattern.test(lnameInput.value.trim())) {
        errorText.style.display = "block";
        errorText.textContent = "Username must start with a letter and can only contain letters and numbers, maximum 12 characters.";
        return; // Stop further execution
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "success"){
                    location.href="copy.php";
                }else{
                    errorText.style.display = "block";
                    errorText.textContent = data;
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
