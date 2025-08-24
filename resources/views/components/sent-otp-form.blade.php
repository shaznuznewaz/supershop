<div class="container">
    <div class="row justify content center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90 p-4">
                <div class="card-body">
                    <h4>Send otp to your Email </h4>
                    <hr>
                    <br/>
                    <label>Enter Your Email Address</label>
                    <input id="email" placeholder="User Email" class="form-control" type="email" />
                    <br/>
                    <button onclick="verifyEmail()" class="btn bg-gradient-primary w-100" >Send</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')

    <script>
        async function verifyEmail(){
            console.log('hello world')
            let email=document.getElementById('email').value

        if(email.length==0){
            errorToast('Email is required')
        }

        else{
            
            try{
                showLoader()
                let res=await axios.post('/backend/reset/password/sent/otp',{
                    'email':email
                })
                hideLoader()

                if(res.status==201 && res.data.status==true){
                    successToast(res.data.message)
                    sessionStorage.setItem('email',email)
                    setTimeout(function(){
                        window.location.href='/verify-otp'
                    })
                }

                else if(res.response.status==422){
                    let errors = res.response.data.errors
                    for(let field in errors){
                        if(errors.hasOwnProperty(field)){
                            errorToast(errors[field][0])
                        }
                    }
                }

                else{
                    errorToast(res.data.message)
                }
            }catch(err){
                hideLoader()
                if(err.response){
                    let errors=err.response.data.errors
                    if(Array.isArray(errors)){
                        errors.forEach(msg=>errorToast(msg))
                    }
                    else{
                        for(let field in errors){
                            if(errors.hasOwnProperty(field)){
                                errorToast(errors[field][0])
                            }
                        }
                    }
                }else{
                    errorToast('something went wrong')
                }
            }
        }
        }
        
    </script>    


@endpush