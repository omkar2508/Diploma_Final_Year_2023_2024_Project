<!DOCTYPE html>
<html lang="en">
<head>
    <title>CodeWaveCommnunity</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="home.css">
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/4aeb584d0b.js" crossorigin="anonymous"></script>
    <style>
  .card-container {
    top:100px;
    display: flex;
    overflow: hidden;
    width: 100%;
    height: 400px;
    margin: 20px 0;
    padding: 10px;
    position: relative;
  }

  .card {
    flex: 0 0 auto;
    width: 350px; /* Increased width */
    margin-right: 20px;
    padding: 20px;
    box-sizing: border-box;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 8px;
    animation: scrollCards 25s linear infinite;
  }

  .card img {
    width: 100%;
    border-radius: 8px;
  }

  @keyframes scrollCards {
    0% {
      transform: translateX(480%);
    }
    100% {
      transform: translateX(-500%);
    }
  }
</style>

</head>
<body>
   
    
    <nav class="navbar navbar-expand-lg navbar-light custom-bg-color fixed-top">
        <a class="navbar-brand" href="#">
            <img src="logo1.png" alt="Your Logo" width="60" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item1 active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item2">
                    <a class="nav-link" href="http://localhost/codewavecommunity/logout.php">Logout</a>
                </li>
               
                <li class="nav-item4">
                    <a class="nav-link" href="http://localhost/codewavecommunity/about.html">About</a>
                </li>
                <li class="nav-item5">
                    <a class="btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                        <i class="fa-solid fa-bars fa-xl"></i>
                      </a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="wrapper">
        <div class="static-txt">Welcome To </div>
        <ul class="dynamic-txt">
            <li><span>CodeWaveCommnunity</span></li>
        </ul>
    </div>
    

    <div class="container3">
        <div class="box3">
            <div class="content3">
                <p><b>Welcome to CodeWaveCommunity - Your Hub for Coding Excellence</b><br>
                    Are you ready to embark on an exciting coding journey, connect with fellow enthusiasts, and empower yourself with the knowledge and resources to excel in the world of programming? Look no further! CodeWaveCommunity is your digital haven, a thriving ecosystem that's more than just a platform; it's a community, a resource center, and a launchpad for your coding aspirations.
                   At CodeWaveCommunity, we understand the value of community. It's where ideas are shared, problems are solved, and friendships are forged. Whether you're a student taking your first coding steps or a seasoned programmer seeking new challenges, you'll find a welcoming community of individuals who share your passion and are eager to learn, grow, and share knowledge together.
                    While our unique features, such as asking doubts, troubleshooting assistance, code reviews, job listings, mentorship opportunities, and an extensive programming resource library, are designed to empower you, we're more than the sum of these parts. We're about your growth as a coder and your journey toward achieving your goals.
                </p>
            </div>
        </div>

        <div class="card-container" onmouseenter="pauseAnimation()" onmouseleave="resumeAnimation()">
  <div class="card">
    <img src="o1.gif" alt="Coding GIF">
    <h2>Code Effectively</h2>
    <p>Explore and share codes</p>
  </div>
  <div class="card">
    <img src="o2.gif" alt="Coding GIF">
    <h2>Play Quiz</h2>
  </div>
  <div class="card">
    <img src="o3.gif" alt="Coding GIF">
    <h2>Work Collaboratively</h2>
    <p>Work with community members</p>
  </div>
  <div class="card">
    <img src="web2.gif" alt="Coding GIF">
    <h2>Develop Skills</h2>
    <p>Develop skills with community</p>
  </div>
</div>





        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Main Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-group">
            <li class="list-group-item"><a href="http://localhost/codewavecommunity/doubt.html" class="btn btn-light">Ask Doubt</a></li>
            <li class="list-group-item"><a href="http://localhost/codewavecommunity/chatapp/users.php" class="btn btn-light">ThreadChat</a></li>
            <li class="list-group-item"><a href="http://localhost/codewavecommunity/class/tors.php" class="btn btn-light">Classrooms</a></li>
            <li class="list-group-item"><a href="http://localhost/codewavecommunity/job_search.php" class="btn btn-light">Find Jobs</a></li>
            <li class="list-group-item"><a href="http://localhost/codewavecommunity/Resume/1/index.html" class="btn btn-light">Build Resume</a></li>
            <li class="list-group-item"><a href="http://localhost/codewavecommunity/Resume/1/letter.html" class="btn btn-light">Compose Letter</a></li> 
            <li class="list-group-item"><a href="http://localhost/codewavecommunity/resource.php" class="btn btn-light">Resources</a></li>
            <li class="list-group-item"><a href="http://localhost/codewavecommunity/credit.php" class="btn btn-light">MY Credits</a></li>
            <li class="list-group-item"><a href="http://localhost/codewavecommunity/games/Quiz/q/index.html" class="btn btn-light">Quiz</a></li>
            <li class="list-group-item"><a href="http://localhost/codewavecommunity/game.html" class="btn btn-light">Games</a></li>
            <li class="list-group-item"><a href="http://localhost/codewavecommunity/profile.php" class="btn btn-light">Your Profile</a></li>
        </ul>
    </div>
</div>

        </div>


        






   <div class="container">
    <div class="box">
        <div class="icon"><i class="fa-solid fa-question fa-xs"></i></div>
        <div class="content">
            <a href="http://localhost/codewavecommunity/doubt.html"><h5>Ask Doubts</h5></a>
            <p>Ask your doubt to community and get specific
                answer from them. The experts on community will
                provide you answer to your question.
            </p>
        </div>
    </div>
    <div class="box">
        <div class="icon"><i class="fa-solid fa-file"></i></div>
        <div class="content">
            <a href="http://localhost/codewavecommunity/Resume/1/index.html"><h5>Buile Resume</h5></a>
            <p>Build your own resume in a better way , with already
                available templates, making your work easier.
            </p>
        </div>
    </div>
    <div class="box">
        <div class="icon"><i class="fa-solid fa-gamepad"></i></div>
        <div class="content">
            <a href="#"><h5>Play Games</h5></a>
            <p>Explore multiple games and play the games for free,
                 for entertainment.
            </p>
        </div>
    </div>
   </div>





   <div class="container2">
    <div class="box">
        <div class="icon"><i class="fa-solid fa-chalkboard-user"></i></div>
        <div class="content">
            <a href="http://localhost/codewavecommunity/chatapp/users.php"><h5>ThreadChat</h5></a>
            <p>Chat with peoples on community and interact with
                them to gain knowladge and make friends.
            </p>
        </div>
    </div>
    <div class="box">
        <div class="icon"><i class="fa-solid fa-magnifying-glass"></i></div>
        <div class="content">
            <a href="http://localhost/codewavecommunity/job_search.php"><h5>Find Jobs</h5></a>
            <p>Find the jobs in your area or other areas.
                You can easily find your interested job.
            </p>
        </div>
    </div>
    <div class="box">
        <div class="icon"><i class="fa-solid fa-trophy"></i></div>
        <div class="content">
            <a href="http://localhost/codewavecommunity/games/Quiz/q/index.html"><h5>Quiz</h5></a>
            <p>Play quiz and gain knowladge with having fun and 
                gaining programming knowladge.
            </p>
        </div>
    </div>
   </div> 

   <script>
  function pauseAnimation() {
    var cards = document.querySelectorAll('.card');
    cards.forEach(function(card) {
      card.style.animationPlayState = 'paused';
    });
  }

  function resumeAnimation() {
    var cards = document.querySelectorAll('.card');
    cards.forEach(function(card) {
      card.style.animationPlayState = 'running';
    });
  }
</script>
</body>
</html>