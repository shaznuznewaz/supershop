<div class="container">
    <div class="row justify content center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90 p-4">
                <div class="card-body">
                    <h4>Set a new password </h4>
                    <hr>
                    <br/>
                    <label>Enter Your Password</label>
                    <input id="password" placeholder="Your Password" class="form-control" type="password" />
                    <label>Re-Type Password</label>
                    <input id="passwordConfirmation" placeholder="Confirm Password" class="form-control" type="password" />
                    
                    <br/>
                    <button onclick="resetPassword()" class="btn bg-gradient-primary w-100" >Reset</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')

    <script>

        async function resetPassword(){
            console.log('hello world')
            let password=document.getElementById('password').value
            let passwordConfirmation=document.getElementById('passwordConfirmation').value

            if(password.length==0){
                errorToast('password is required')
            }
            else if(password!==passwordConfirmation){
                errorToast('Password Mismatch')
            }
            else{
                try{
                    showLoader()
                    let res=await axios.post('/backend/reset/password',{
                        password:password,
                        password_confirmation:passwordConfirmation
                    })
                    hideLoader()
                    if(res.status===201 && res.data.status===true){
                        successToast(res.data.message)
                        setTimeout(function(){
                            window.location.href='/login'
                        },1000)
                    }
                    else if(res.reponse.status=422){
                        let errors=res.response.data.errors

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
                    }
                    else{
                        errorToast('Something went wrong')
                    }
                }
            }

        }

    </script>    

@endpush