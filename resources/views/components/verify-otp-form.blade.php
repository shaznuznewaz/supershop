<div class="container">
    <div class="row justify content center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90 p-4">
                <div class="card-body">
                    <h4>Enter your otp code </h4>
                    <hr>
                    <br/>
                    <label>6 digit code here</label>
                    <input id="otp" placeholder="code" class="form-control" type="text" />
                    <br/>
                    <button onclick="verifyOtp()" class="btn bg-gradient-primary w-100">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>
    
@push('script')

    <script>
        async function verifyOtp(){
            let otp=document.getElementById('otp').value

        if(otp.length==0){
            errorToast('OTP is required')
        }

        else{
            
            try{
                showLoader()
                let res=await axios.post('/backend/reset/password/verify/otp',{
                     'otp':otp,
                    email:sessionStorage.getItem('email')
                })
                hideLoader()

                if(res.status==201 && res.data.status==true){
                    successToast(res.data.message)
                    sessionStorage.clear()
                    setTimeout(function(){
                        window.location.href='/reset-password'
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

