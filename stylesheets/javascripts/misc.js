        function email(name1, name2, domain, extension1)
        {
           if (!document.write) return false;
            if (document.write)
            {
                var name1; var name2; var domain; var extension1;
                document.write('<a href="' + 'mailto:' + name1 + '.' + name2 + '@' + domain + '.' + extension1 + '"><img src="stylesheets/images/email.png" alt="email" width="32" height="32"/></a>');
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
