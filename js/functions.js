   const $form = $("#login_form");
   const $postform = $("#post_form");
   const $loginButton = $("#loginBut");
   const $postButton = $("#postBut");
   const $postImg = $('#postImg');
   const $commentBut = $('#commentBut');
   const $commentForm = $("#commentForm");
   const $donationForm = $('#donation_form');
   const $donateBut = $('#donateBut');

   function DisplayDeleteBut(){
       if(localStorage.username === 'admin'){
            $(".button2").removeClass('nobutton');
            $(".open-button").removeClass('nobutton');
       }
   }

    function signUp(data){
        $.ajax({
            method:"POST",
            data:data,
            url:'api/Actions.php'
        })
        .then(data=>{
            console.log(data);
        })

        .catch(error=>{
            console.log(error);
        })
    }

    function addComment(data){
        $.ajax({
            method:"POST",
            data:data,
            url:'api/Actions.php'
        })
        .then(data=>{
            console.log(data);
        })

        .catch(error=>{
            console.log(error);
        })
    }

    $loginButton.on("click", function(e){
        e.preventDefault();
        const data = $form.serialize();
        console.log(data);
        $.ajax({
            method:"POST",
            data:data,
            url:'api/Actions.php'
        })
        .then(result=>{
            if(result === 'login'){
                localStorage.setItem("username",'admin');
                location.reload();
            }else{
                alert(result);
            }
        })
        .catch(error=>{
            console.log(error);
        })        
    })

    $commentBut.on("click", function(e){
        const data = $commentForm.serialize();
        console.log(data);
        addComment(data);
        location.reload();       
    })

    $postButton.on("click", function(e){
        e.preventDefault();
        var img_name = $postImg.val();
        if(img_name === ''){
            alert('Please Select Image');
            return false;
        }else{
            var ext = $postImg.val().split('.').pop().toLowerCase();
            if(jQuery.inArray(ext, ['gif','png','jpg','jpeg'])== -1){
                alert('Inavalid Image File');
            }
        }
    })

    $donateBut.on("click", function(e){
        const data = $donationForm.serialize();
        console.log(data);
        $.ajax({
            method:"POST",
            data:data,
            url:'api/Actions.php'
        })
        .then(data=>{
            console.log(data);
        })

        .catch(error=>{
            console.log(error);
        })
    })

    function deletePost(title,created){
        var data = '&delete=delete&title='+title+'&created='+created;
        console.log(data);
        $.ajax({
            method:"POST",
            data:data,
            url:'api/Actions.php'
        })
        .then(data=>{
            console.log(data);
        })

        .catch(error=>{
            console.log(error);
        })

        location.reload();
    }

    



