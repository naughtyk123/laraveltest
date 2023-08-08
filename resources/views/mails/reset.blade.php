

<html>
<style>

#verfied {
  background: linear-gradient(45deg, #227ad2, #227ad2) !important;
}
.verfiedbox {
  /* background: "{{url('assets/app-assets/img/back.jpg')}}" !important; */
  background-color: #FFFFFF;
    background-size: auto;
  background-position-x: 0%;
  background-position-y: 0%;
  background-size: auto;
  padding: 25px;
  background-size: cover !important;
  background-position: center center;
  box-shadow: rgba(76, 78, 100, 0.22) 0px 2px 10px 0px;
  width: 54%;
  margin: 0 auto;
    margin-top: 0px;
  text-align: center;
  margin-top: 105px;
}
.verfiedimg img {
  width: 15%;
  margin: 0 auto;
  text-align: center;
  display: block;
}
.verfiedcontent h3 {
  font-size: 26px;
  font-family: 'Roboto', sans-serif;
}
.verfiedcontent p {
  font-family: 'Roboto', sans-serif;
}
.v-link {
  font-family: 'Roboto', sans-serif;
  margin-top: 25px;
}
.verfiebutton {
  margin-top: 23px;
}
.verfiebutton a {
  background: linear-gradient(45deg, #227ad2, #227ad2) !important;
  padding: 12px 28px;
  color: white;
  border-radius: 50px;
  display: inline-block;
  text-align: center;
  text-decoration: none;
  font-family: 'Roboto', sans-serif;
}
.verfiebutton a:hover {
  background: linear-gradient(45deg, #0d549b, #227ad2) !important;
  color: white;
}
</style>
<body id="verfied" data-col="1-column" class=" 1-column  blank-page blank-page">
    <div class="wrapper">
    <div class="row verfiedscreen">
   
        <div class="col-md-12">
            <div class="card">
            <div class="verfiedbox">
                <div class="verfiedimg"><img src="{{url('assets/app-assets/img/912023.png')}}"></div>
                <div class="verfiedcontent">
                <h3>Reset password</h3>
                <p>Hi {{$data['name']}} lets reset your password. please click link below</p>

                <div class="verfiebutton"><a href="{{url('change-password-view')}}/{{$data['token']}}">Reset</a></div>
                <div class="v-link">https://nebp.gov.lk</div>

                <p class="vernote">This link will be expired within 24hrs</p>
                </div>

                </div>
                            
            </div>
        </div>
    </div>

</body>

</html>