function update(){
  if(!document.getElementById("loginbox")){
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
      if(xml.readyState === 4 && xml.status === 200){
        document.getElementById('messages').innerHTML = xml.response;
      }
    }
    xml.open("GET", "get-message.php", );
    xml.send();
    setTimeout(function(){
      var objDiv = document.getElementById("messages");
      objDiv.scrollTop = objDiv.scrollHeight;
      console.log(objDiv.scrollHeight);
      console.log('done');
    }, 100);
  }
}
update();

if(document.getElementById("loginbox")){
  var usr  = document.getElementById("username"),
      csrf = document.getElementById("csrf"),
      alrt = document.getElementById("alert_msg");
  usr.addEventListener('keyup', function(event){
    event.preventDefault();
    if(event.keyCode === 13){
      //validate username value
      var patt = new RegExp(/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/);
      if(usr.value === "" || usr.value.replace(/\s/g, "") === "" || !patt.test(usr.value)){
        alrt.innerHTML = "Please enter a valid username";
      }else{
        alrt.innerHTML = "";
        //sending to php to process
        var xml = new XMLHttpRequest();
        var formData = new FormData();
        formData.append('username', usr.value);
        formData.append('csrf', csrf.value);

        xml.onreadystatechange = function(){
          if(xml.readyState === 4 && xml.status === 200){
            var response = JSON.parse(xml.response);
            console.log(response);
            if(response['state'] === 'success'){
              location.reload();
            }
          }
        }
        xml.open("POST", "update-message.php", );
        xml.send(formData);
      }
    }
  })
}

if(document.getElementById("new_messsage")){
  var csrf = document.getElementById("msg_csrf"),
      nMsg = document.getElementById("new_messsage");
      alrt = document.getElementById("alert_msg");
  nMsg.addEventListener('keyup', function(event){
    event.preventDefault();
    if(event.keyCode === 13){
      //validate Message value
      if(nMsg.value === "" || nMsg.value.replace(/\s/g, "") === ""){
        alrt.innerHTML = "Message can't sent empty";
      }else{
        alrt.innerHTML = "";
        //sending to php to process
        var xml = new XMLHttpRequest();
        var formData = new FormData();
        formData.append('message', nMsg.value);
        formData.append('msg_csrf', csrf.value);

        xml.onreadystatechange = function(){
          if(xml.readyState === 4 && xml.status === 200){
            var response = JSON.parse(xml.response);
            if(response['state'] === 'success'){
              nMsg.value = "";
              //update getting messages ajax
              update();
            }else{
              location.reload();
            }
          }
        }
        xml.open("POST", "update-message.php", );
        xml.send(formData);
      }
    }
  })
}

setInterval(function(){
  update();
}, 2000);
