var pat;
function validContact() {
    var contact=document.forms['signup']['mobile'].value;
      pat = /^\d{10}$/;
        if (contact.match(pat)) {
              document.getElementById('mobile').style.visibility = "hidden";
                  return true;
                    }
        
          else if (contact == ""){
                return false;
                  }
          
            else {
                  document.getElementById('mobile').innerText = "*Please Enter a valid 10 digit Mobile No.";
                      document.getElementById('mobile').style.visibility = "visible";
                          return false;
                            }
}

function validEmail() {
    var email=document.forms['signup']['email'].value;
      pat = /[a-z0-9_\.]+[a-z]+[0-9]*@[a-z]+.(com|in|co\.in|org.in|iitr\.ac\.in)/;
        if (email.match(pat)){
              document.getElementById('email').style.visibility = "hidden";
                  return true;
                    }
        
          else if (email == ""){
                    return false;
                      }
          
            else {
                  document.getElementById('email').innerText = "*Please Enter a valid e-mail address.";
                      document.getElementById('email').style.visibility = "visible";
                          return false;
                            } 
}

function validName() {
    var name=document.forms['signup']['name'].value;
      pat=/^[a-zA-Z]*$/;
        if (name.match(pat)) {
              document.getElementById('name').style.visibility = "hidden";
                  return true;
                    }
        
          else if (name == ""){
                return false;
                  }
          
            else {
                  document.getElementById('name').innerText = "*Name contains only alphabets.";
                      document.getElementById('name').style.visibility = "visible";
                          return false;
                              }
}

function validPassword() {
    var pwd=document.forms['signup']['password'].value;
      var cnfpwd=document.forms['signup']['cnfpass'].value;
        pat = /.{8,}/;
          if (pwd.match(pat)) {
                document.getElementById('pass').style.visibility = "hidden";
                    if (pwd == cnfpwd) {
                            document.getElementById('pass').style.visibility = "hidden";
                                  document.getElementById('cnfpass').style.visibility = "hidden";
                                        return true;
                                            }
                    
                        else if (cnfpwd == ""){
                                return false;
                                    }
                        
                            else {
                                    document.getElementById('cnfpass').innerText = "*Passwords don't match";
                                          document.getElementById('cnfpass').style.visibility = "visible";
                                                return false;
                                                    }
                              }
          
            else if (pwd == ""){
                  return false;
                    } 
            
              else {
                    document.getElementById('pass').innerText = "*8 or more characters";
                        document.getElementById('pass')[0].style.visibility = "visible";
                            return false;
                              }
}
