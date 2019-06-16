$('#login-form').submit(function(event){
		event.preventDefault();

        showCover('Logging in. Please wait');

        login($(this));

});

function login (form){
    $.ajax({
            url: form.attr('action'),
            data: form.serialize(),
            type: form.attr('method')
        }).done(function(response) {

            console.log(response);

            hideCover();

            response = JSON.parse(response);


            if(response.environment==='development'){
                console.log(response);
            }

            if(response.success){
                showResponse('success',response.message,'#login-message');
                showCover('Redirecting...');
                window.location="../notifications/";
            }
            else if(response.success=="error"){
                alert(response.message);
            }
            else{
                showResponse('danger',response.message,'#login-message');
            }
    });
}
