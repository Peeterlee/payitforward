<?php
  include_once('api/Post.php');
  include_once('api/Donation.php');

  if(isset($_POST['title'])){
      $check = getimagesize($_FILES["img"]["tmp_name"]);
      if($check !== false){
          $image = $_FILES['img']['tmp_name'];
          $imgContent = addslashes((file_get_contents($image)));
          $title = $_POST['title'];
          $desc = $_POST['desc'];

          $post = new Posts();
          $upload = $post->Upload($imgContent, $title, $desc);
          header("Refresh:0");
      }
  }
?>

<!doctype html>
<html>
  <head>
    <title>Pay It Forward</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="popstyle.css">
    

    <script>
    var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };

  </script>
  </head>

  <body onload="DisplayDeleteBut()">
		<header>
        <img class="logo" src="imgs/logo.png" width="300px">  
    </header>
   <section class="hero">
      <div class="container">
        <div class="main-massage">
          <div class="desc">"<b>Pay it Forward<b> is your one-stop shop for donating used clothing to less fortunate people. 
            Simply post your clothing item below and be contacted by someone who wishes to pick up your clothes."
          </div>
          <button class="login" onclick="loginForm()">LOGIN</button>
        </div>
        <?php 
          $post = new Database();
          $getPosts = $post->runQuery("SELECT * FROM posts");
          $num = $getPosts->num_rows;
          echo '
            <div id="total" style="font-size:26px">Total clothes donations: <span font-size:30px>'.$num.'</span></div>
            '
        ?>
        <div id="donation_msg" style="color:white;font-size:26px">Total money donations: <span style="font-size:30px">$ 
        <?php
          $donation = new Donation();
          $total = $donation->Total();
          
          echo $total;
         ?>
        </span></div>

        
        <div class="form-popuplogin" id="myLogin">
          <form class="form-container" id="login_form">
          <img src="imgs/payitforwardlogo.png" width="100px" class="pop-img">
          <h1>Login</h1>
      
          <label for="email"><b></b></label>
          <input type="text" placeholder="Username" name="username" id="username" required>
      
          <label for="psw"><b></b></label>
          <input type="password" placeholder="Password" name="password" id="password" required>
      
          <input type="submit" value="LOGIN" class="loginbtn button1" id="loginBut">
      
          <button type="button" class="btn cancel" onclick="closeLogin()">CLOSE</button>
        </form>
        </div>
    </section>
   


<!--Donation Post Form -->
    
<button class="open-button nobutton" onclick="openForm()">ADD ITEMS</button>
<div class="form-popupComment" id="PostComent">
  <form id="commentForm" class="form-container">
    <img src="imgs/payitforwardlogo.png" width="100px" class="pop-img">
    <h1>Comments</h1>
    <div class="ShowMsg" id="comment_content"></div> 
    <input type="text" id="c_name" placeholder="Username" name="user_name" required>
    <input type="text" id="c_content" name="comment" placeholder="Enter Comment here...">
    <input type="hidden" name="post_id" id="post_id">
    <button type="submit" id="commentBut" class="loginbtn button1">ADD COMMENT</button>
    <button type="button" class="btn cancel" onclick="closeComments()">CLOSE</button>
  </form>
</div>

<div class="form-popup" id="myForm">
  <form class="form-container" method="post" enctype="multipart/form-data">
    <h1>Clothes Donation</h1>

    <input type="file" name="img"  onchange="loadFile(event)">

<div id="previewImg">

  <img id="output"/>
</div>

  <input type="text" placeholder="Title" name="title" >  
  <input type="text" placeholder="Description" name="desc" required>

    <input type="submit" value="Post" id="post" class="btn">
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<div id="donation_container" style="display:flex;justify-content:center;align-items:center">
  <form id="donation_form">
  <h1>Make a donation</h1>
  <input type="password" name="card_number" placeholder="Please enter your card number: no spaces" style="width:300px"><br>
  Month: <select name="expire_month" id="expire_month">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
  </select>
  Year: <select name="expire_year" id="expire_year">
    <option value="2020">2020</option>
    <option value="2021">2021</option>
    <option value="2022">2022</option>
    <option value="2023">2023</option>
    <option value="2024">2024</option>
    <option value="2025">2025</option>
    <option value="2026">2026</option>
    <option value="2027">2027</option>
    <option value="2028">2028</option>
    <option value="2029">2029</option>
  </select>
  <br>
  Security Code: <input type="password" name="digit" placeholder="3 or 4 digits"><br>
  $<input type="number" name="amount" placeholder="Enter amount of money"><br>
  <button id="donateBut">Donate</button>
  </form>
</div>

  <!--Login Form -->
  
  <main class="content">
    <section class="blog-posts">
    <?php
            
            $post = new Database();
            $getPosts = $post->runQuery("SELECT * FROM posts ORDER BY created");

            while($row = mysqli_fetch_array($getPosts)){
                echo '
                    <div class="post">
                        <figure class="post-image">
                            <img style="width:40%;height:auto" src="data:image/jpeg;base64,'.base64_encode($row['image']).'" alt="clothes" />
                        </figure>    
                    <ul class="post-details">
                        <li>Added by <span>Admin</span> </li>
                        <li>'.$row['created'].'</li>
                    </ul>
                    <h2>'.$row['title'].'</h2>
                    <div class="post-content">
                        <p>'.$row['description'].'</p>
                    </div>
                    <a class="button" onclick="openComment('.$row['id'].')">View Comments</a>
                    <a style="cursor:pointer" class="button2 nobutton" onclick="deletePost(\''.$row['title'].'\',\''.$row['created'].'\')">Delete</a>
                    </div> 
                ';
            }
        ?>	
		</section>	
	</main>

    
    <script>

/*Post Donation*/

      function openForm() {
        document.getElementById("myForm").style.display = "block";
      }
      
      function closeForm() {
        document.getElementById("myForm").style.display = "none";
      }


/*Login Form*/
      function loginForm() {
        document.getElementById("myLogin").style.display = "flex";
      }
      
      function closeLogin() {
        document.getElementById("myLogin").style.display = "none";
      }

/*Post Comment*/
      function openComment(post_id) {
        document.getElementById("PostComent").style.display = "block";
        document.getElementById('post_id').value = post_id;

        var data = 'post_id='+post_id+'&getcomment=true';
        $.ajax({
            method:"POST",
            data:data,
            url:'api/Actions.php'
        })
        .then(result=>{
          console.log(result);
            if(result == 'no'){
                document.querySelector('.ShowMsg').innerHTML = 'No Comment';
                $('#commentBut').removeClass('nobutton');
                $('#c_name').removeClass('nobutton');
                $('#c_content').removeClass('nobutton');
            }else{
                document.querySelector('.ShowMsg').innerHTML = result;
                $('#commentBut').addClass('nobutton');
                $('#c_name').addClass('nobutton');
                $('#c_content').addClass('nobutton');
            }
        })
        .catch(error=>{
            console.log(error);
        })
      }
      
      function closeComments () {
        document.getElementById("PostComent").style.display = "none";
      }

      </script>
      <script src="js/lib/jquery.js"></script>
      <script src="js/lib/materialize.min.js"></script>
      <script src="js/lib/moment.js"></script>
      <script src="js/functions.js"></script>
		
  </body>
</html>