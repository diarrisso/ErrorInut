$(document).ready(function ($) {
    const mainDiv = $('div[name=mainDiv]');

    let errorDisplay = function showError(forminput) {

        forminput.removeClass('is-invalid');
        let invalidElement = [];
        

        forminput.each(function () {

            if (this.checkValidity() === false) {
                let inputName = $(this).attr('name');
                $(this).addClass('is-invalid');
                invalidElement.push($(this).attr('name'));
                $(this).next().html( inputName + ' ist eine Pflichtfelder, oder die Daten sind nicht Valid');

            }

        });

        return invalidElement.length === 0;
    }
    
   

    $('#save').click(function($){

        const formElement = mainDiv.find('div[name=carrierForm]').find('input, select');
        const file = document.querySelector('input[type=file]').files;
        // var file = document.querySelector('input[type=file]')['files'][0];
        let fileContent = '';
        
        console.log(file);
    
        if (!errorDisplay (formElement )) {
            return;
        }

        if ( file.length > 0 ) {

            const fileReader = new FileReader();

              fileReader.readAsDataURL(file[0]);

            fileReader.onload = (e) => {

                fileContent = e.target.result.replace("data:", "").replace(/^.+,/, "");
                console.log( ' premier fileContent ' + fileContent);
            }

            console.log(file[0].size);
            console.log( ' => deuxienne  fileContent ' + fileContent);
            
            setTimeout(() => { console.log( ' => troisienne   fileContent ' + fileContent); }, 1000);
        }

        setTimeout(() => { console.log( ' => quatrienne fileContent ' + fileContent); }, 5000);
        console.log(' fileContent => ' + fileContent );
        $.ajax({
            url: 'http://localhost:8045/ajax.php',
            method: "POST",
            data: fileContent,
            dataType:'json',
            beforeSend: function() {
                console.log(formData);
            },
            success: function (data) {
                
                console.log(data);
                
            },
            error: function (request, status, error) {
                console.log(request.responseText);
                console.log(error);
                console.log(status);
            }
        });
        
    });


    



 
    // if (errorDisplay(formElement) === false) {
    //     return '';

    // }
    // showError(formElement);
    // $( this ).next('.invalid-feedback').html('Bitte das eine Pflichtfelder, '  + id + '  ist nicht valid' );



    console.log('load-> index.html');

});




