<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>Sign Up</h4>    
                    <hr>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control" type="email"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Name</label>
                                <input id="name" placeholder="Full Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Phone Number</label>
                                <input id="phone" placeholder="Your Phone" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Passowrd</label>
                                <input id="password" placeholder="Your Password" class="form-control" type="password"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Confirm Password</label>
                                <input id="passwordConfirmation" placeholder="Re-Type Password" class="form-control" type="password"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Address</label>
                                <textarea id="address" placeholder="Your Address" class="form-control"></textarea>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Avatar</label>
                                <input id="avatar" placeholder="Your Image" class="form-control" type="file"/>
                            </div>
                            
                                <!--<label>Role</label>-->
                                <input id="role" value="customer"  type="hidden">
                                
                        </div> 
                        
                        <div class="row m-0 p-0">
                                <div class="col-md-4 p-2">
                                    <button onclick="onRegistration()" class="btn w-100 mt-3 bg-gradient-primary" type="button">Complete</button>
                                </div>    
                        </div>

                    </div>
                </div>    
            </div>    
        </div>    
    </div>    
</div>

@push('script')

    <script>

        async function onRegistration(){

            let email=document.getElementById('email').value
            let fullname=document.getElementById('name').value
            let phone=document.getElementById('phone').value
            let password=document.getElementById('password').value
            let passwordConfirmation=document.getElementById('passwordConfirmation').value
            let role=document.getElementById('role').value
            let address=document.getElementById('address').value
            let avatarFile=document.getElementById('avatar').files[0]

            if(email.length==0){
                errorToast('Email is required')
            }
            else if(fullname.length==0){
                errorToast('Name is required')
            }
            else if(phone.length==0){
                errorToast('Phone is required')
            }
            else if(password.length==0){
                errorToast('Password is required')
            }
            else if(password!==passwordConfirmation){
                errorToast('password Mismatch')
            }
            else if(address.length==0){
                errorToast('Address is required')
            }
            else if(!avatarFile){
                errorToast('Avatar is required')
            }
            else if(role.length==0){
                errorToast("Suspicious activity detected")
            }

            else{
                let formData= new FormData()
                formData.append('email',email)
                formData.append('name',fullname)
                formData.append('phone',phone)
                formData.append('password',password)
                formData.append('password_confirmation',passwordConfirmation)
                formData.append('address',address)
                formData.append('avatar',avatarFile)

                showLoader()
                try{
                    let res= await axios.post("/backend/register", formData, {
                        headers:{
                            'content-type' : 'multipart/form-data'
                        }
                    })

                    hideLoader()
                    console.log(res)
                    if(res.status===201 && res.data.status===true){
                        successToast(res.data.message)
                        setTimeout(function(){
                            window.location.href="/login"
                        },2000)
                    }
                    else if(res.response.status===422){
                        let errors=res.response.data.errors
                        for(let field in errors){
                            if(errors.hasOwnProperty(field)){
                                errorToast(errors[field][0])
                            }
                        }
                    }
                    else{
                        console.log(res.data)
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
                            for(let field in errors)
                            if(errors.hasOwnProperty(field)){
                                errorToast(errors[field][0])
                            }
                        }
                    }
                    else{
                        errorToast("Something went wrong")
                    }
                }
            }

        }

    </script>



@endpush