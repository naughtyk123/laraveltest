<!DOCTYPE html>
<html lang="en" class="loading">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="PROCONS">
    <title>Forgot Your Password - nebp</title>

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">



</head>
<style>

#login {
  background: linear-gradient(45deg, #fdfdfd, #c8ddf2) !important;
  background-repeat: no-repeat;
  height: 100vh;
}
#login .container-fluid {
  width: 1350px;
  margin: 0 auto;
}
#login .col-xl-6.col-lg-6.col-md-6.col-12 {
  width: 48%;
  float: left;
}
.loginform.ff .logbackground img {
  width: 31%;
  margin: 0 auto;
  text-align: center;
  display: block;
  padding-top: 218px;
  padding-bottom: 41px;
}
.col-xl-6.col-lg-6.col-md-6.col-12.formsection {
  background:url('assets/app-assets/img/back.jpg');
    background-position-x: 0%;
    background-position-y: 0%;
    background-size: auto;
  background-position-x: 0%;
  background-position-y: 0%;
  background-size: auto;
  padding: 25px;
  background-size: cover;
  background-position: center center;
  box-shadow: rgba(76, 78, 100, 0.22) 0px 2px 10px 0px;
  height: 597px;
}
#login .row.full-height-vh {
    padding-top: 98px;
}
.col-xl-6.col-lg-6.col-md-6.col-12.leftsidebackground {
  background:  "{{url('assets/app-assets/img/blueback.jpg')}}" !important;
    background-position-x: 0%;
    background-position-y: 0%;
    background-size: auto;
  background-position: center !important;
  background-size: cover !important;
  height: 648px;
}
.logo {
  font-size: 43px;
  color: #227ad2;
  font-weight: 700;
  text-align: center;
}
.loginform h4 {
  font-size: 34px;
  text-align: left;
  margin-top: 4px;
  font-family: 'Roboto', sans-serif;
  margin-bottom: 0px;
}
.loginform p {
  font-family: 'Roboto', sans-serif;
}
#inputEmail {
  border: 1px solid #A6A9AE;
  color: #75787D;
  width: 90%;
  padding: 9px;
  border-radius: 14px;
  margin-bottom: 18px;
  margin-top: 18px;
}
#inputPass {
  border: 1px solid #A6A9AE;
  color: #75787D;
  width: 90%;
  padding: 9px;
  border-radius: 14px;
  margin-bottom: 18px;
  margin-top: 18px;
}
.loginform {
  padding: 95px 59px;
}
.custom-control.custom-checkbox.mb-2.mr-sm-2.mb-sm-0.ml-5 {
  margin-bottom: 24px;
  font-family: 'Roboto', sans-serif;
}
.loginform label {
  font-family: 'Roboto', sans-serif;
  margin-bottom: 13px;
}
.btn.btn-danger.px-4.py-2.text-uppercase.white.font-small-4.box-shadow-2.border-0 {
  background: linear-gradient(45deg, #227ad2, #227ad2) !important;
  padding: 9px 27px;
  color: white;
  border-radius: 50px;
  display: inline-block;
  text-align: center;
  border: 0;
  font-size: 17px;
}
.btn.btn-danger.px-4.py-2.text-uppercase.white.font-small-4.box-shadow-2.border-0:hover{
    background: linear-gradient(45deg, #0d549b, #227ad2) !important;
color: white;
}
.logbackground img {
  width: 64%;
  margin: 0 auto;
  text-align: center;
  display: block;
  padding-top: 103px;
  padding-bottom: 41px;
}
.textimg {
  text-align: center;
  font-size: 34px;
  color: white;
  margin-bottom: 32px;
}
.loginform.ff h4 {
  margin-bottom: 28px;
}
</style>
<body id="login" data-col="1-column" class=" 1-column  blank-page blank-page">
<div class="container-fluid">


<div class="row full-height-vh">
            <div class="col-xl-6 col-lg-6 col-md-6 col-12 formsection">
                <div class="loginform ff">
                    <div class="logo">NEBP</div>
                    <h4>Forgot Your Password</h4>
                    

                    <form method="POST">
                                       
                                        <div class="form-group">
                                            <div class="formfild">
                                            <label >Email <span class="required" style="color: red">*</span> </label>
                                                <input type="email" class="form-control form-control-lg" name="email" id="inputEmail" placeholder="Email Address" required email>
                                            </div>
                                        </div>
                                        

                                        <div class="form-group">
                                            
                                                <div class="formfild">
                                                    <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0 ml-5">
                                                        <input type="checkbox" class="custom-control-input" checked id="rememberme">
                                                        <label class="custom-control-label float-left" for="rememberme">Remember Me</label>
                                                    </div>
                                                </div>
                                           
                                        </div>

                                        <div class="form-group">
                                            <div class="text-center col-md-12">
                                                <button type="submit" class="btn btn-danger px-4 py-2 white font-small-4 box-shadow-2 border-0"><i class="ft-thumbs-up position-right"></i> Submit</button>
                                            </div>
                                        </div>
                                    </form>




                </div>
            </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-12 leftsidebackground">
            <div class="logbackground"><img src="{{url('assets/app-assets/img/6195699.png')}}"></div>
          <div class="textimg">
            </div>
        </div>
    </div>


</body>

</html>