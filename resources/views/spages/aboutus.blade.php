<!Doctype html>
<html>
<head>
  <title>
    What we do?
  </title>
  @include( 'layouts.navmenu' )
  <style>
#outermost{
    width:100%;
    font-size: 1.2vw;
  }
  #txt{
    text-align: justify;
    padding: 1%;
  }
#one{
    width:100%;
    padding: 0% 10% 10% 10%;
    text-align: justify;
  }
  #who{
    font-size: 3vw;
    letter-spacing: 2px;
    font-weight: 200;
    padding: 0% 0% 3% 0%;
  }
  #vis1{
    font-size: 20px;
    font-weight: 200;
  }
  #list{
    margin-bottom: 0%;
  }
  @media screen and (max-width: 700px){
    #who{
      font-size: 5vw;
    }
    #li1{
      font-size:22px;
    }
  }
  @media screen and (max-width: 500px){
    #who{
      font-size: 6vw;
    }

  }
  @media screen and (max-width: 350px){
    #who{
      font-size: 7vw;
    }
    #li1{
      font-size:19px;
    }
  }
  </style>
</head>
<body>
<section style="margin-top:80px;margin-bottom:60px;" id="one">
		<div id="who"><center>About Us</center>
		</div>
			<div id="abtus">
				<p id="txt">
          Created in the year 2017, Samyog is a portal aimed at creating a dynamic nexus of projects and volunteers working for providing free education to underprivileged children.
          Many educational and other institutes in India are taking a lead in educating such children with the support of passionate volunteers. Though working for an immensely noble cause, these programs often come across tough challenges such as shortage of volunteers and difficulty in reaching out to the masses. Volunteer too, don’t even have any means to easily locate all these projects let alone getting involved in the cumbersome application process.
        <br><b>Samyog, with its powerful features aims to counter exactly such challenges, making interaction among the involved parties both simple and meaningful.</b>

				</p>
			</div>
			<div id="who"><center>New to Samyog?Let us help you!</center>
			</div>
			<div id="OUR VISION">
				<ul id="list">
				<div id="vis1"><li id="li1">I’m an Organization/Project.</li>
				</div>
				<p id="txt">
          We, at Samyog, understand how transformative your work is, why not let others know about it too! Samyog helps you share about your path breaking endeavors with the world, enabling you to connect with talented and dedicated volunteers, who feel for your cause and would like to contribute through their diverse strengths.
				</p>
        <ul>
          <li style="font-size:15px;padding:5px">Just create your profile on the portal in few simple steps and you are good to go!
          <ul>
          <li>Visit the organization <a href="/register">Sign Up</a> page.</li>
          <li>Fill in the Sign Up details.</li>
          <li>Verify your account via verification e-mail.</li>
        </ul>
      </li>
          Voila! Welcome to Samyog!
          <li style="font-size:15px;padding:5px">This profile lets you:-
            <ul>
          <li>Tell readers about your project work.</li>
          <li>Manage volunteer application.</li>
          <li>Respond to volunteer applications.</li>

          </ul></li>
        </ul>
        <div id="vis1"><li id="li1">I’m a Volunteer.</li>
        </div>
        <p id="txt">
        Firstly, we, at Samyog, would like to applaud your enthusiasm to make a difference. One of the fundamental aims of Samyog is to get volunteers quickly attached with programs of their choice through simple and hassle free application process.
        </p>
        <ul>
          <li style="font-size:15px;padding:5px">The portal provides following features to volunteers:
            <ul>
          <li>Cumulative list of all programs and projects.</li>
          <li>Detailed information about each project.</li>
          <li>Search facility to look for projects in vicinity.</li>
          <li>Common application form for all projects.</li>
          </ul></li>
        </ul>
      </ul>
			</div>
	</section>
          @include( 'layouts.footer' )
</body>
</html>
