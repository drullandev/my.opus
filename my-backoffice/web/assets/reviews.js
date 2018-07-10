<script type="text/javascript">
    $(document).ready(function () {
        
        $("#import_success").hide();
        
        $("#submitForm").click(function(){
            $("#import_form").submit();
        });

        $("#import_form").on('submit', function(e) {
            $("#import_success").hide();
        
            var question = confirm('¿Do you want to override the existing reviews?');

            if (question) {
                $("#import_override").val(1);
            } else {
                $("#import_override").val(0);     
            }

            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
                success: function(data)  
                {
                    $("#import_success").html(data.msg);
                    $("#import_success").show();
                }
            }, 'JSON');
        });
    });
</script>