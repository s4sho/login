$(document).ready(function(){
    
    $(':text').click(function(){
        current_input_val = $(this).val();
        $(this).select();
    // If someone deletes the value and goes out of the field,
    //the field gets the value back (it does not stay empty)
    }).focusout(function(){
        if ($(this).val() == ''){
            $(this).val(current_input_val);
        }  
    });
    
    $(':password').focusin(function(){
        if ($(this).attr('placeholder') !== undefined){
            $(this).removeAttr('placeholder')
        }
    });

    $(':password.password').focusout(function(){
        $(this).attr('placeholder', 'Password');
    })
    
    $(':password.password_conf').focusout(function(){
        $(this).attr('placeholder', 'Confirm Password');
    })
    
});