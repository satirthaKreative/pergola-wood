<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
	</head>
	<body style="max-width: 760px; margin: 0 auto;">
		<table style="width: 100%;">
			<tr>
				<td style="background: #7a9739; padding: 20px;"><a href="#" style="display: table;width: 100%;text-align: center;
				"><img src="http://pergola.previewforclient.com//frontend/images/logo.png" alt=""></a></td>
			</tr>
			<tr>
				<td>
					<table style="width: 100%;margin: 45px 0;">
						<tr>
							<td style="vertical-align: top;"><label for="" style="font-family: 'Open Sans', sans-serif;">Name</label></td>
							<td><input type="text" style="width: 100%;
								padding: 0;
								height: 40px;
								text-indent: 15px;
								color: #333;
								margin-bottom: 20px;
								border-radius: 0;
							border: 1px solid #999;" id="send-form-name-id"></td>
						</tr>
						<tr>
							<td style="vertical-align: top;"><label for="" style="font-family: 'Open Sans', sans-serif;">Email</label></td>
							<td><input type="text" style="width: 100%;
								padding: 0;
								height: 40px;
								text-indent: 15px;
								color: #333;
								margin-bottom: 20px;
								border-radius: 0;
							border: 1px solid #999;" id="send-form-email-id"></td>
						</tr>
						<tr>
							<td style="vertical-align: top;"><label for="" style="font-family: 'Open Sans', sans-serif;">Comment</label></td>
							<td><textarea name="" id="send-form-comment-id" style="width: 100%;
								padding: 0;
								height: 80px;
								text-indent: 15px;
								color: #333;
								margin-bottom: 20px;
								border-radius: 0;
							border: 1px solid #999;"></textarea></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="button" onclick="submit_Send_mail_fx()" value="Submit" style="    background: #7a9739;
								border: none;
								text-transform: uppercase;
								color: #fff;
								font-size: 15px;
							padding: 12px 35px; font-family: 'Open Sans', sans-serif;" ></textarea></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="background-color: #555555; padding: 0;"><p style="color: #fff;font-family: 'Open Sans', sans-serif; text-align: center;">© COPYRIGHT 2021 PERGOLA BUILDER</p></td>
			</tr>
		</table>
        <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            function submit_Send_mail_fx()
            {
                var uname = $("#send-form-name-id").val();
                var uemail = $("#send-form-email-id").val();
                var ucomment = $("#send-form-comment-id").val();

                if(uname == "")
                {
                    error_pass_alert_show_msg("Please enter a name");
                }
                else if(uemail == "")
                {
                    error_pass_alert_show_msg("Please enter a email");
                }
                else if(ucomment == "")
                {
                    error_pass_alert_show_msg("Please enter a comment");
                }
                else
                {
                    $.ajax({
                        url: "{{ route('satirtha.send-my-mail') }}",
                        type: "GET",
                        data: {uname: uname, uemail: uemail, ucomment: ucomment},
                        dataType: "json",
                        success: function(event)
                        {
                            if(event == "success"){
                                success_pass_alert_show_msg("Successfully send mail");
                            }else if(event == "error"){
                                error_pass_alert_show_msg("Someting wrong ! try again later");
                            }
                        }
                    })
                }
            }

            
                // success msg on sweet alert
                function success_pass_alert_show_msg(alert_main_msg)
                {
                    swal({
                    title: "Successful!",
                    text: alert_main_msg,
                    icon: "success",
                    button: false,
                    timer: 3000
                    });
                }

                // error msg on sweet alert
                function error_pass_alert_show_msg(alert_main_msg)
                {
                    swal({
                    title: "Error!",
                    text: alert_main_msg,
                    icon: "error",
                    button: false,
                    timer: 3000
                    });
                }
        </script>
	</body>
</html>