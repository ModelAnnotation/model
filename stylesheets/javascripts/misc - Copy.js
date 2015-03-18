        function email(name, domain, extension1, extension2)
        {
           if (!document.write) return false;
            if (document.write)
            {
                var name; var domain; var extension1; var extension2;
                document.write('<a href="' + 'mailto:' + name + '@' + domain + '.' + extension1 + '.' + extension2 + '"><img src="stylesheets/images/email.png" alt="email" width="32" height="32"/></a>');
            }
        }

        $(function()
            { $( "#top_menu" ).menu(); } 
         );

        function register()
        {
            window.location.href='index.php/auth/register'
        }

        function forgot_pwd()
        {
            window.location.href='index.php/auth/forgot_password'
        }
