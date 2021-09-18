$("document").ready(function () {
    $("#togglePassoword").click(function () {
        $("#togglePassoword").toggleClass(
            "fa-eye fa-eye-slash text-blue-400 text-red-400"
        );
        if ($("#password").prop("type") == "password") {
            $("#password").prop("type", "text");
        } else {
            $("#password").prop("type", "password");
        }
    });

    $(".btnDelete").each(function () {
        $(this).click(function () {
            data=new FormData();
            data.append('user', $(this).prop("id").substring(1))
            $.ajax({
                url: "/api/users/delete",
                type: "PUT",
                data: data,
                processData: false,
                contentType: false,
            }).then((result) => {
                console.log(result)
            }).catch((err) => {
                console.log(err)
            });;
            console.log();
        });
    });
    $("#photoPicker").change(function () {
        file = $("#photoPicker")[0].files[0];
        data = new FormData();
        data.append("file", file);
        $.ajax({
            url: "/api/upload",
            data: data,
            type: 'POST',
            processData: false,
            contentType: false,
           
        }).then((result) => {
            result=result.replaceAll('\\','/');
            $('#preview').css('background-image', 'url(/images/' + result + ')')
            $('#photo').val(result);
            $('#img').val(result);
            console.log(result)
        }).catch((err) => {
            console.log(err)
        });;
    });

    $('input[name="r"]').each(function(){
        $(this).change(function(){
           $('form').submit();
        });
    });

    $('#rowLeft').click(function(){
        $('#lateral').toggle('',false);
    });
    
});
